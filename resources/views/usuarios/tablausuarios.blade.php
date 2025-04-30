@extends('layouts.app')



@section('content')

<div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
    <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
      <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->foto ? asset('storage/' . auth()->user()->foto) : '/default-avatar.png' }}" alt="Foto del usuario">
    </button>
    <!-- Dropdown menu -->
    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
            <span class="block text-sm text-gray-900 dark:text-white">
                {{ auth()->user()->usuario ?? 'Invitado' }} <!-- Muestra el nombre del usuario autenticado -->
            </span>
            <span class="block text-sm text-gray-500 truncate dark:text-gray-400">
                {{ auth()->user()->email ?? 'Sin correo' }} <!-- Muestra el correo del usuario autenticado -->
            </span>
        </div>
      <ul class="py-2" aria-labelledby="user-menu-button">
        <li>
            <a href="{{ route('perfil') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Perfil</a>
        </li>
        
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white cursor-pointer">
                    Cerrar Sesión
                </button>
            </form>
        </li>
      </ul>
    </div>
    <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
      </svg>
  </button>
</div>
<div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
  <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
    <li>
      <a href="{{ route('libros.index') }}" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Almacén</a>
    </li>
    <li>
        <a href="{{ route('carrito.index') }}" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Carrito</a>
    </li>
    @if (auth()->user()->rol === 'admin')
    <li>
        <a href="{{ route('usuarios.tablausuarios') }}" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Usuarios</a>
    </li>
    <li>
      <a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Pricing</a>
    </li>
    <li>
      <a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
    </li>
    @endif
  </ul>
</div>
</div>  

</nav>
</div>

<section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
        <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
            <div class="flex justify-between items-center p-4">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white">Lista de Usuarios</h2>
                <!-- Botón para agregar usuario -->
                <a href="{{ route('usuarios.create') }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                    Agregar Usuario
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">ID</th>
                            <th scope="col" class="px-4 py-3">Nombre</th>
                            <th scope="col" class="px-4 py-3">Usuario</th>
                            <th scope="col" class="px-4 py-3">Email</th>
                            <th scope="col" class="px-4 py-3">Teléfono</th>
                            <th scope="col" class="px-4 py-3">Rol</th>
                            <th scope="col" class="px-4 py-3">Estado</th>
                            <th scope="col" class="px-4 py-3">Foto</th>
                            <th scope="col" class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-3">{{ $usuario->id }}</td>
                                <td class="px-4 py-3">{{ $usuario->nombre }}</td>
                                <td class="px-4 py-3">{{ $usuario->usuario }}</td>
                                <td class="px-4 py-3">{{ $usuario->email }}</td>
                                <td class="px-4 py-3">{{ $usuario->telefono ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ ucfirst($usuario->rol) }}</td>
                                <td class="px-4 py-3">
                                    @if ($usuario->estado === 1)
                                        <span class="text-green-600 font-medium">Activo</span>
                                    @else
                                        <span class="text-red-600 font-medium">Inactivo</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if ($usuario->foto)
                                        <img src="{{ asset('storage/' . $usuario->foto) }}" alt="Foto de {{ $usuario->nombre }}" class="w-10 h-10 rounded-full">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex space-x-2">
                                        <!-- Botón para editar -->
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Editar</a>
                                        
                                        <!-- Botón para eliminar -->
                                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<main>
</main>
@endsection