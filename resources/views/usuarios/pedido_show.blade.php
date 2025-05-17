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
    @if (auth()->user()->rol === 'master' || auth()->user()->rol === 'middle' || auth()->user()->rol === 'basic')
    <li>
        <a href="{{ route('usuarios.tablausuarios') }}" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Usuarios</a>
    </li>
    <li>
        <a href="{{ route('pedidos.index') }}" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Pedidos</a>
    </li>
    @endif
  </ul>
  
</div>
</div> 

<div class="max-w-2xl mx-auto mt-10 bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Detalle del Pedido #{{ $pedido->id }}</h1>
    <div class="mb-4">
        <span class="font-semibold text-gray-700 dark:text-gray-300">Cliente:</span>
        <span class="text-gray-900 dark:text-white">{{ $pedido->usuario->nombre ?? 'N/A' }}</span>
    </div>
    <div class="mb-4">
        <span class="font-semibold text-gray-700 dark:text-gray-300">Libro:</span>
        <span class="text-gray-900 dark:text-white">{{ $pedido->libro->titulo ?? 'N/A' }}</span>
    </div>
    <div class="mb-4">
        <span class="font-semibold text-gray-700 dark:text-gray-300">Cantidad:</span>
        <span class="text-gray-900 dark:text-white">{{ $pedido->cantidad }}</span>
    </div>
    <div class="mb-4">
        <span class="font-semibold text-gray-700 dark:text-gray-300">Estado:</span>
        @if($pedido->estado === 'pendiente')
            <span class="text-yellow-600 font-medium">Pendiente</span>
        @elseif($pedido->estado === 'completado')
            <span class="text-green-600 font-medium">Completado</span>
        @else
            <span class="text-gray-600 font-medium">{{ ucfirst($pedido->estado) }}</span>
        @endif
    </div>
    <div class="mb-4">
        <span class="font-semibold text-gray-700 dark:text-gray-300">Fecha de creación:</span>
        <span class="text-gray-900 dark:text-white">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
    </div>
    <a href="{{ route('pedidos.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg px-5 py-2.5 mt-4">
        Volver a la lista de pedidos
    </a>
</div>

<main>
</main>
@endsection