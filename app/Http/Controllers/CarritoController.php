<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Importar el facade DB
use App\Models\Libros; // Importar el modelo Libro
use App\Models\Usuarios; // Asegúrate de importar el modelo Usuarios
use App\Models\Carrito;
use App\Models\CarritoItem; // Asegúrate de importar el modelo CarritoItem
use App\Models\Pedido;

class CarritoController extends Controller
{
    public function index()
    {
        // Obtener el carrito del usuario autenticado con sus items y libros
        $carrito = Carrito::with('items.libro')->where('usuario_id', Auth::id())->first();

        return view('carritos.index', compact('carrito'));
    }

    public function agregar(Request $request)
    {
        // Validar los datos enviados
        $request->validate([
            'libro_id' => 'required|exists:libros,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        // Buscar el libro en la base de datos
        $libro = Libros::findOrFail($request->libro_id);

        // Verificar si hay suficientes ejemplares disponibles
        if ($libro->numeroEjemplares < $request->cantidad) {
            return back()->withErrors(['error' => 'No hay suficientes ejemplares disponibles.']);
        }

        // Obtener o crear el carrito del usuario autenticado
        $carrito = Carrito::firstOrCreate(['usuario_id' => Auth::id()]);

        // Agregar o actualizar el libro en carrito_items
        $item = CarritoItem::updateOrCreate(
            ['carrito_id' => $carrito->id, 'libro_id' => $libro->id],
            ['cantidad' => DB::raw('cantidad + ' . $request->cantidad), 'precio' => $libro->precio]
        );

        // Disminuir el número de ejemplares disponibles
        $libro->numeroEjemplares -= $request->cantidad;
        $libro->save();

        return back()->with('success', 'Libro agregado al carrito correctamente.');
    }
    public function eliminar($id)
    {
        $item = CarritoItem::findOrFail($id);

        // Restaurar los ejemplares al eliminar del carrito
        $libro = Libros::findOrFail($item->libro_id);
        $libro->numeroEjemplares += $item->cantidad;
        $libro->save();

        // Eliminar el item del carrito
        $item->delete();

        return back()->with('success', 'Libro eliminado del carrito correctamente.');
    }

    public function agregarTodo(Request $request)
    {
        // Validar que se envíen libros con cantidades válidas
        $request->validate([
            'libros' => 'required|array',
            'libros.*' => 'integer|min:1', // Cada libro debe tener una cantidad mínima de 1
        ]);

        // Obtener o crear el carrito del usuario autenticado
        $carrito = Carrito::firstOrCreate(['usuario_id' => Auth::id()]);

        foreach ($request->libros as $libroId => $cantidad) {
            // Buscar el libro en la base de datos
            $libro = Libros::findOrFail($libroId);

            // Verificar si hay suficientes ejemplares disponibles
            if ($libro->numeroEjemplares < $cantidad) {
                return response()->json(['success' => false, 'message' => "No hay suficientes ejemplares disponibles para el libro: {$libro->titulo}."]);
            }

            // Agregar o actualizar el libro en carrito_items
            CarritoItem::updateOrCreate(
                ['carrito_id' => $carrito->id, 'libro_id' => $libro->id],
                ['cantidad' => DB::raw('cantidad + ' . $cantidad), 'precio' => $libro->precio]
            );

            // Disminuir el número de ejemplares disponibles
            $libro->numeroEjemplares -= $cantidad;
            $libro->save();
        }

        return response()->json(['success' => true]);
    }

    public function finalizarCompra(Request $request)
    {
        $carrito = Carrito::with('items.libro')->where('usuario_id', Auth::id())->first();

        if (!$carrito || $carrito->items->isEmpty()) {
            return back()->with('error', 'Tu carrito está vacío.');
        }

        foreach ($carrito->items as $item) {
            Pedido::create([
                'usuario_id' => Auth::id(),
                'libro_id'   => $item->libro_id,
                'cantidad'   => $item->cantidad,
                'estado'     => 'pendiente',
            ]);
        }

        // Vaciar el carrito después de crear los pedidos
        $carrito->items()->delete();

        return back()->with('success', '¡Pedido realizado correctamente!');
    }
}