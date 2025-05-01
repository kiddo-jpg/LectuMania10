@extends('layouts.app')

@section('content')

</div>
</nav>

<div class="max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold text-center mb-5 text-white">Iniciar Sesión</h1>
    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-white">Correo Electrónico</label>
            <input type="email" name="email" id="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-white">Contraseña</label>
            <input type="password" name="password" id="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="flex justify-between">
            <!-- Botón para iniciar sesión -->
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 cursor-pointer">Iniciar Sesión</button>
        
            <!-- Botón para ingresar usuario -->
            <a href="{{ route('usuarios.index') }}" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 cursor-pointer text-center ml-2">Ingresar Usuario</a>
        </div>

        <!-- Botón para iniciar sesión con Google -->
        <a href="{{ route('socialite.redirect', 'google') }}" class="flex items-center justify-center bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 cursor-pointer mb-2 mt-4">
            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                <path fill="#EA4335" d="M24 9.5c3.5 0 6.6 1.2 9.1 3.6l6.8-6.8C35.7 2.5 30.2 0 24 0 14.8 0 6.9 5.8 3.2 14.2l7.9 6.2C13.2 13.2 18.1 9.5 24 9.5z"/>
                <path fill="#4285F4" d="M46.5 24c0-1.5-.1-3-.4-4.4H24v8.4h12.7c-1.1 3.6-3.5 6.6-6.7 8.6l7.9 6.2c4.6-4.2 7.6-10.4 7.6-18.8z"/>
                <path fill="#FBBC05" d="M10.9 28.4c-1.1-3.6-1.1-7.4 0-11l-7.9-6.2C.7 15.2 0 19.5 0 24s.7 8.8 2.9 12.8l7.9-6.4z"/>
                <path fill="#34A853" d="M24 48c6.5 0 12-2.1 16-5.8l-7.9-6.2c-2.3 1.5-5.3 2.4-8.1 2.4-5.9 0-10.8-3.7-12.6-8.8l-7.9 6.2C6.9 42.2 14.8 48 24 48z"/>
                <path fill="none" d="M0 0h48v48H0z"/>
            </svg>
            Iniciar sesión con Google
        </a>
        
        <!-- Botón para iniciar sesión con Facebook -->
        <a href="{{ route('socialite.redirect', 'facebook') }}" class="flex items-center justify-center bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 cursor-pointer">
            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="#FFFFFF" d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24h11.495v-9.294H9.691v-3.622h3.129V8.413c0-3.1 1.893-4.788 4.658-4.788 1.325 0 2.464.099 2.795.143v3.24h-1.918c-1.504 0-1.796.715-1.796 1.763v2.31h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.324-.593 1.324-1.324V1.325C24 .593 23.407 0 22.675 0z"/>
            </svg>
            Iniciar sesión con Facebook
        </a>
    </form>
</div>

<main>
</main>

<!-- Ventana emergente para errores -->
@if ($errors->any())
    <div id="errorModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
            <h2 class="text-lg font-bold text-red-600 mb-4">Error</h2>
            <ul class="text-sm text-gray-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <div class="mt-4 flex justify-end">
                <button id="closeModal" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Cerrar</button>
            </div>
        </div>
    </div>
@endif

<script>
    // Cerrar la ventana emergente
    document.addEventListener('DOMContentLoaded', function () {
        const closeModal = document.getElementById('closeModal');
        const errorModal = document.getElementById('errorModal');

        if (closeModal && errorModal) {
            closeModal.addEventListener('click', function () {
                errorModal.style.display = 'none';
            });
        }
        setTimeout(function () {
            if (errorModal) {
                errorModal.style.display = 'none';
            }
        }, 5000); // Se cierra automáticamente después de 5 segundos
    });
</script>

@endsection