<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        if (auth()->user()->rol === 'usuario') {
            return redirect()->back()->with('error', 'No tienes autorización para acceder a esta página.');
        }

        $pedidos = Pedido::with(['usuario', 'libro'])->get();
        return view('usuarios.pedidos', compact('pedidos'));
    }
    public function show($id)
    {
        $pedido = \App\Models\Pedido::with(['usuario', 'libro'])->findOrFail($id);

        // Solo permitir acceso a roles distintos de 'usuario'
        if (auth()->user()->rol === 'usuario') {
            return redirect()->route('pedidos.index')->with('error', 'No tienes autorización para ver este pedido.');
        }

        return view('usuarios.pedido_show', compact('pedido'));
    }

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);

        // Solo master puede eliminar
        if (auth()->user()->rol !== 'master') {
            return redirect()->route('pedidos.index')->with('error', 'No tienes autorización para eliminar pedidos.');
        }

        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado correctamente.');
    }
}