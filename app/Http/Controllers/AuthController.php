<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuarios; 

class AuthController extends Controller
{
    public function perfil()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('perfil', compact('user')); // Retornar la vista del perfil con los datos del usuario
    }

    public function showLoginForm()
    {
        return view('auth.login'); // Asegúrate de tener una vista en resources/views/auth/login.blade.php
    }
    public function login(Request $request)
    {
        // Validar las credenciales
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
    
        //dd($credentials); // Detener la ejecución y mostrar los datos enviados

        // Verificar si el usuario existe y está inactivo
        $user = Usuarios::where('email', $request->email)->first();
        if ($user && $user->estado === 0) {
            return back()->withErrors([
                'email' => 'Tu cuenta está inactiva. Por favor, contacta al administrador.',
            ]);
        }

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerar la sesión para evitar ataques de fijación de sesión
            return redirect()->intended('libros'); // Redirigir al índice de libros
        }

        // Si la autenticación falla, redirigir de vuelta con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Has cerrado sesión exitosamente.');
    }

    public function updatePerfil(Request $request)
    {
        $user = Auth::user(); // Obtener el usuario autenticado

        // Validar los datos enviados
        $request->validate([
            'nombre'   => 'required|min:2',
            'usuario'  => 'required|min:2',
            'email'    => 'required|email|unique:usuarios,email,' . $user->id,
            'telefono' => 'required|numeric',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Actualizar los datos del usuario
        $user->update([
            'nombre'   => $request->nombre,
            'usuario'  => $request->usuario,
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'foto'     => $request->file('foto') ? $request->file('foto')->store('fotos', 'public') : $user->foto,
        ]);

        return redirect()->route('libros.index')->with('success', 'Perfil actualizado exitosamente.');
    }

    public function eliminarCuenta(Request $request)
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        $user->delete(); // Eliminar el usuario de la base de datos
        Auth::logout(); // Cerrar sesión
        return redirect('/ingresar')->with('success', 'Cuenta eliminada exitosamente.');
    }
}