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
        <a href="{{ route('carrito.index') }}" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Carrito</a>
    </li>
    @if (auth()->user()->rol === 'admin')
    <li>
        <a href="{{ route('usuarios.tablausuarios') }}" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Usuarios</a>
    </li>
    
    @endif
  </ul>
</div>
</div>  

</div>
</nav>

<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-2xl font-bold text-center mb-5 text-gray-800 dark:text-white">Carrito de Compras</h1>

    @if ($carrito && $carrito->items->count() > 0)
        <div class="bg-white shadow-md rounded-lg overflow-hidden dark:bg-gray-800">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">Producto</th>
                        <th scope="col" class="px-4 py-3">Cantidad</th>
                        <th scope="col" class="px-4 py-3">Precio</th>
                        <th scope="col" class="px-4 py-3">Total</th>
                        <th scope="col" class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carrito->items as $item)
                        <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-4 py-3">{{ $item->libro->titulo }}</td>
                            <td class="px-4 py-3">{{ $item->cantidad }}</td>
                            <td class="px-4 py-3">${{ number_format($item->precio, 2) }}</td>
                            <td class="px-4 py-3">${{ number_format($item->cantidad * $item->precio, 2) }}</td>
                            <td class="px-4 py-3">
                                <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Resumen del carrito -->
        <div class="mt-5 bg-gray-100 p-4 rounded-lg shadow-md dark:bg-gray-800">
            <div class="flex justify-between items-center">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total de libros:</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $carrito->items->sum('cantidad') }}</p>
            </div>
            <div class="flex justify-between items-center mt-2">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total a pagar:</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white">${{ number_format($carrito->items->sum(fn($item) => $item->cantidad * $item->precio), 2) }}</p>
            </div>
        </div>

        <div class="flex justify-between items-center mt-5">
            <a href="{{ route('libros.index') }}" class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-800">Seguir Comprando</a>
            <a href="{{ route('paypal') }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Finalizar Compra</a>
        </div>
    @else
        <p class="text-center text-gray-500 dark:text-gray-400">Tu carrito está vacío.</p>
        <div class="flex justify-center mt-5">
            <a href="{{ route('libros.index') }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Ir al Catálogo</a>
        </div>
    @endif
</div>

<main>
</main>


@endsection