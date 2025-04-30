@extends('layouts.app')

@section('content')

</div>
</nav>

<div class="max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold text-center mb-5 text-gray-800 dark:text-white">Perfil de Usuario</h1>

    <!-- Formulario para guardar cambios -->
    <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ $user->nombre }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="usuario" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Usuario</label>
            <input type="text" name="usuario" id="usuario" value="{{ $user->usuario }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Correo Electrónico</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Teléfono</label>
            <input type="tel" name="telefono" id="telefono" value="{{ $user->telefono }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="foto" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Foto</label>
            <input type="file" name="foto" id="foto" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @if ($user->foto)
                <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto del usuario" class="mt-2 w-20 h-20 rounded-full">
            @endif
        </div>
        <div class="flex flex-col space-y-3 mt-4">
            <a href="{{ route('libros.index') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">Cancelar</a>
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800 cursor-pointer">Guardar</button>
        </div>
    </form>

    <!-- Formulario para eliminar cuenta -->
    <form action="{{ route('perfil.eliminar') }}" method="POST" class="mt-4" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 cursor-pointer">Eliminar Cuenta</button>
    </form>
</div>

<main>
</main>

@endsection