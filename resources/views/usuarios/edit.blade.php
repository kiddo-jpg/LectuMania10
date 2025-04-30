@extends('layouts.app')

@section('content')

</nav>
</div>

<section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
        <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-5">Editar Usuario</h2>
                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                
                    <!-- Nombre -->
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $usuario->nombre) }}" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                
                    <!-- Usuario -->
                    <div class="mb-4">
                        <label for="usuario" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Usuario</label>
                        <input type="text" name="usuario" id="usuario" value="{{ old('usuario', $usuario->usuario) }}" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                
                    <!-- Teléfono -->
                    <div class="mb-4">
                        <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $usuario->telefono) }}" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                
                    <!-- Rol -->
                    <div class="mb-4">
                        <label for="rol" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rol</label>
                        <select name="rol" id="rol" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="admin" {{ $usuario->rol === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="usuario" {{ $usuario->rol === 'usuario' ? 'selected' : '' }}>Usuario</option>
                        </select>
                    </div>
                
                    <!-- Estado -->
                    <div class="mb-4">
                        <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                        <select name="estado" id="estado" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="1" {{ $usuario->estado === 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ $usuario->estado === 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                
                    <!-- Contraseña -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nueva Contraseña</label>
                        <input type="password" name="password" id="password" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Dejar en blanco para no cambiar">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Debe tener al menos 8 caracteres, incluir una letra mayúscula y un carácter especial.</p>
                    </div>
                
                    <!-- Foto -->
                    <div class="mb-4">
                        <label for="foto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Foto</label>
                        <input type="file" name="foto" id="foto" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        @if ($usuario->foto)
                            <img src="{{ asset('storage/' . $usuario->foto) }}" alt="Foto actual" class="w-20 h-20 mt-2 rounded-full">
                        @endif
                    </div>
                
                    <!-- Botones -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('usuarios.tablausuarios') }}" class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-800">Cancelar</a>
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<main>
</main>

@endsection