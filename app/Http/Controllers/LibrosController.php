<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Termwind\Components\Li;
use App\Models\Libros; // Asegúrate de importar el modelo Libros
use Illuminate\Support\Facades\Storage; 

class LibrosController extends Controller
{
    public function index()
    {
        $libros = Libros::all(); // Obtener todos los libros de la base de datos
        return view('libros.index', compact('libros')); // Pasar los libros a la vista
    }

    public function create()
    {
        return view('libros.create'); // Retorna una vista con el formulario para agregar un libro
    }

    public function edit($id)
    {
        $libro = Libros::findOrFail($id); // Busca el libro por ID
        return view('libros.edit', compact('libro')); // Retorna una vista con el formulario para editar
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editorial' => 'required|string|max:255',
            'anio' => 'required|integer|min:1000|max:' . date('Y'),
            'genero' => 'required|string|max:255',
            'portada' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
            'isbn' => 'required|string|unique:libros,isbn', // Validar el ISBN
            'paginas' => 'required|integer', // Validar el número de páginas
            'idioma' => 'required|string|max:255', // Validar el idioma
            'numeroEjemplares' => 'required|integer', // Validar el número de ejemplares
            'precio' => 'required|numeric', // Validar el precio
        ]);

        // Manejar la subida de la imagen
        if ($request->hasFile('portada')) {
            $file = $request->file('portada');
            $path = $file->store('portadas', 'public'); // Guardar en storage/app/public/portadas
            $validatedData['portada'] = $path; // Guardar la ruta en la base de datos
        }

        // Crear un nuevo libro en la base de datos
        Libros::create($validatedData);

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('libros.index')->with('success', 'Libro creado exitosamente.');
    }   
    public function update(Request $request, $id)
{
    // Validar los datos del formulario
    $validatedData = $request->validate([
        'titulo' => 'required|string|max:255',
        'autor' => 'required|string|max:255',
        'editorial' => 'required|string|max:255',
        'anio' => 'required|integer|min:1000|max:' . date('Y'),
        'genero' => 'required|string|max:255',
        'isbn' => 'required|string|unique:libros,isbn,' . $id, // Validar el ISBN, ignorando el libro actual
        'paginas' => 'required|integer', // Validar el número de páginas
        'idioma' => 'required|string|max:255', // Validar el idioma
        'numeroEjemplares' => 'required|integer', // Validar el número de ejemplares
        'precio' => 'required|numeric', // Validar el precio
        'portada' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la portada
    ]);

    // Buscar el libro por ID
    $libro = Libros::findOrFail($id);

    // Variable para almacenar la ruta de la portada anterior
    $portadaAnterior = $libro->portada;

    // Manejar la portada si se sube un nuevo archivo
    if ($request->hasFile('portada')) {
        // Guardar la nueva portada
        $path = $request->file('portada')->store('portadas', 'public');
        $validatedData['portada'] = $path; // Guardar la ruta de la nueva portada en los datos validados
    }

    // Actualizar los datos del libro
    $libro->update($validatedData);

    // Eliminar la portada anterior si existe y si se subió una nueva portada
    if ($portadaAnterior && $request->hasFile('portada') && Storage::exists('public/' . $portadaAnterior)) {
        Storage::delete('public/' . $portadaAnterior);
    }

    // Redirigir al índice con un mensaje de éxito
    return redirect()->route('libros.index')->with('success', 'Libro actualizado exitosamente.');
}
    public function destroy($id)
    {
        // Buscar el libro por ID
        $libro = Libros::findOrFail($id);

        // Eliminar la portada del almacenamiento si existe
        if ($libro->portada && Storage::exists($libro->portada)) {
            Storage::delete($libro->portada);
        }

        // Eliminar el libro de la base de datos
        $libro->delete();

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('libros.index')->with('success', 'Libro y su portada eliminados exitosamente.');
    }
}
