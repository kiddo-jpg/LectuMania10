<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios; // Asegúrate de importar el modelo Usuarios
use App\Models\Libros; // Asegúrate de importar el modelo Libros
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Importar la clase Log para registrar eventos


class UsuariosController extends Controller
{
    public function index()
    {
        return view('usuarios.index'); // Retorna una vista con el formulario para ingresar usuarios
    }

    public function tabla()
    {
        $usuarios = Usuarios::all(); // Obtener todos los usuarios de la base de datos
        return view('usuarios.tablausuarios', compact('usuarios')); // Pasar los usuarios a la vista
    }

    public function edit($id)
    {
        $usuario = Usuarios::findOrFail($id); // Buscar el usuario por ID
        return view('usuarios.edit', compact('usuario')); // Pasar el usuario a la vista
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function update(Request $request, $id)
    {
        // Buscar el usuario por ID
        $usuario = Usuarios::findOrFail($id);

        // Validar los datos enviados
        $request->validate([
            'nombre'   => 'required|min:2',
            'usuario'  => 'required|min:2',
            'email'    => 'required|email|unique:usuarios,email,' . $usuario->id,
            'telefono' => 'nullable|numeric',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'estado'   => 'required|boolean', // Validar que el estado sea booleano
            'rol'      => 'required|in:master,middle,basic,usuario', // Validar que el rol sea válido
            'password' => [
                'nullable',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};\'":\\|,.<>\/?]).+$/'
            ],
        ]);

        // Actualizar los datos del usuario
        $usuario->nombre = $request->nombre;
        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;
        $usuario->estado = $request->estado;
        $usuario->rol = $request->rol; // Actualizar el rol

        // Si se sube una nueva foto, reemplazar la existente
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('fotos', 'public');
            $usuario->foto = $path;
        }

        // Si se envía una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        // Guardar los cambios
        $usuario->save();

        // Redirigir a la tabla de usuarios con un mensaje de éxito
        return redirect()->route('usuarios.tablausuarios')->with('success', 'Usuario actualizado correctamente.');
    }
    public function destroy($id)
    {
        // Buscar el usuario por ID
        $usuario = Usuarios::findOrFail($id);

        // Eliminar el usuario
        $usuario->delete();

        // Redirigir a la tabla de usuarios con un mensaje de éxito
        return redirect()->route('usuarios.tablausuarios')->with('success', 'Usuario eliminado correctamente.');
    }
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre'   => 'required|min:2',
            'usuario'  => 'required|min:2',
            'email'    => 'required|email|unique:usuarios,email',
            'telefono' => 'nullable|numeric',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};\'":\\|,.<>\/?]).+$/'
            ],
        ]);

        // Crear el usuario y asignar el rol por defecto si no se envía
        $usuario = Usuarios::create([
            'nombre'   => $request->nombre,
            'usuario'  => $request->usuario,
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'foto'     => $request->file('foto') ? $request->file('foto')->store('fotos', 'public') : null, // Guardar la ruta de la foto
            'password' => Hash::make($request->password), // Encriptar la contraseña
            'rol'      => $request->rol ?? 'usuario', // Asignar "usuario" si no se envía un rol
        ]);

        // Redirige al formulario de login con un mensaje de éxito
        return redirect()->route('login')->with('success', 'Usuario registrado exitosamente. Por favor, inicia sesión.');
    }
}
