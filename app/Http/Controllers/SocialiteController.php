<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Usuarios; // Usar el modelo Usuarios

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            // Buscar o crear el usuario en la base de datos
            $user = Usuarios::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'nombre' => $socialUser->getName(),
                    'usuario' => $socialUser->getNickname() ?? $socialUser->getName(),
                    'password' => bcrypt('password_generica'), // Contraseña genérica
                    'foto' => $socialUser->getAvatar(),
                    'estado' => 1, // Activo por defecto
                ]
            );

            // Iniciar sesión al usuario
            Auth::login($user);

            return redirect()->route('libros.index')->with('success', 'Inicio de sesión exitoso.');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Error al autenticar con ' . $provider]);
        }
    }
}