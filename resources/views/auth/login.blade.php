@extends('layouts.app')

@section('content')

</div>
</nav>


<div class="max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold text-center mb-5 text-white">Iniciar Sesión</h1>
    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
            <input type="email" name="email" id="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input type="password" name="password" id="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="flex justify-between">
            <!-- Botón para iniciar sesión -->
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 cursor-pointer">Iniciar Sesión</button>
        
            <!-- Botón para ingresar usuario -->
            <a href="{{ route('usuarios.index') }}" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 cursor-pointer text-center ml-2">Ingresar Usuario</a>
        </div>
        <a href="{{ route('socialite.redirect', 'google') }}" class="btn btn-google">
            Iniciar sesión con Google
        </a>
        <a href="{{ route('socialite.redirect', 'facebook') }}" class="btn btn-facebook">
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