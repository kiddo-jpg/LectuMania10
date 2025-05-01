<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Usuarios; // Usar el modelo Usuarios

class SocialiteController extends Controller
{
    /**
     * Redirige al usuario al proveedor de autenticación.
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        // Validar que el proveedor sea válido (google o facebook)
        if (!in_array($provider, ['google', 'github'])) {
            abort(404, 'Proveedor no soportado.');
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Maneja el callback del proveedor de autenticación.
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
{
    try {
        // Obtener los datos del usuario desde Google
        $socialUser = Socialite::driver($provider)->stateless()->user();

        // Verificar si el correo electrónico existe
        if (!$socialUser->getEmail()) {
            return redirect()->route('login')->withErrors(['error' => 'No se pudo obtener el correo electrónico del usuario.']);
        }

        // Buscar o crear el usuario en la base de datos
        $user = Usuarios::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'nombre' => $socialUser->getName(),
                'usuario' => $socialUser->getNickname() ?? $socialUser->getName(),
                'password' => bcrypt('password_generica'), // Contraseña genérica
                'foto' => $socialUser->getAvatar(), // Guardar la URL de la foto
                'estado' => 1, // Activo por defecto
            ]
        );

        // Iniciar sesión al usuario
        Auth::login($user);

        return redirect()->route('libros.index')->with('success', 'Inicio de sesión exitoso.');
    } catch (\Exception $e) {
        // Manejar errores y redirigir al login con un mensaje de error
        return redirect()->route('login')->withErrors(['error' => 'Error al autenticar con Google: ' . $e->getMessage()]);
    }
}
}