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
        
        <!-- Botón para iniciar sesión con GitHub -->
        <a href="{{ route('socialite.redirect', 'github') }}" class="flex items-center justify-center bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-900 cursor-pointer">
            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.438 9.8 8.205 11.385.6.11.82-.26.82-.577v-2.234c-3.338.726-4.042-1.61-4.042-1.61-.546-1.387-1.333-1.756-1.333-1.756-1.09-.745.083-.73.083-.73 1.205.084 1.84 1.237 1.84 1.237 1.07 1.835 2.807 1.305 3.492.997.108-.775.418-1.305.762-1.605-2.665-.305-5.467-1.332-5.467-5.93 0-1.31.468-2.38 1.235-3.22-.123-.303-.535-1.523.117-3.176 0 0 1.007-.322 3.3 1.23a11.52 11.52 0 013.003-.404c1.02.005 2.045.138 3.003.404 2.29-1.552 3.297-1.23 3.297-1.23.653 1.653.241 2.873.118 3.176.77.84 1.235 1.91 1.235 3.22 0 4.61-2.807 5.62-5.478 5.92.43.37.823 1.102.823 2.22v3.293c0 .32.22.694.825.576C20.565 21.8 24 17.3 24 12 24 5.37 18.63 0 12 0z"/>
            </svg>
            Iniciar sesión con GitHub
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