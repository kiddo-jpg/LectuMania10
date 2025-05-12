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
      <a href="{{ route('libros.index') }}" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Almacén</a>
    </li>
    <li>
        <a href="{{ route('carrito.index') }}" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Carrito</a>
    </li>
    @if (auth()->user()->rol === 'master' || auth()->user()->rol === 'middle' || auth()->user()->rol === 'basic')
    <li>
        <a href="{{ route('usuarios.tablausuarios') }}" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Usuarios</a>
    </li>
    @endif
  </ul>
</div>
</div>   

</div>
</nav>



<section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
    <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
        <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
            <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-between md:space-y-0 md:space-x-3">
                    @if (auth()->user()->rol === 'master')
                    <a href="{{ route('libros.create') }}" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Añadir Nuevo Libro
                    </a>
                    @endif
                
                    <!-- Botón para agregar todo -->
                    @if (auth()->user()->rol === 'master' || auth()->user()->rol === 'middle' || auth()->user()->rol === 'basic' || auth()->user()->rol === 'usuario')
                    <button id="agregarTodo" class="ml-auto flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 rounded-lg focus:outline-none dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800 cursor-pointer">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" />
                        </svg>
                        Agregar Todo
                    </button>
                     @endif
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">
                                {{--
                                <div class="flex items-center">
                                     <input id="checkbox-all" type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    
                                    <label for="checkbox-all" class="sr-only">checkbox</label>
                                </div>
                                --}}
                            </th>
                            <th scope="col" class="px-4 py-3">Título</th>
                            <th scope="col" class="px-4 py-3">Autor</th>
                            <th scope="col" class="px-4 py-3">Editorial</th>
                            <th scope="col" class="px-4 py-3">ISBN</th>
                            <th scope="col" class="px-4 py-3">Año</th>
                            <th scope="col" class="px-4 py-3">Páginas</th>
                            <th scope="col" class="px-4 py-3">Género</th>
                            <th scope="col" class="px-4 py-3">Idioma</th>
                            <th scope="col" class="px-4 py-3">Número de Ejemplares</th>
                            <th scope="col" class="px-4 py-3">Precio</th>
                            <th scope="col" class="px-4 py-3">Estado</th>
                            <th scope="col" class="px-4 py-3">Portada</th>
                            @if (auth()->user()->rol === 'master' || auth()->user()->rol === 'middle')
                                <th scope="col" class="px-4 py-3">Acciones</th>
                            @endif
                            <th scope="col" class="px-4 py-3">Agregar al Carrito</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($libros as $libro)
                        <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="w-4 px-4 py-3">

                                {{--
                                <div class="flex items-center">
                                    <input id="checkbox-table-search-1" type="checkbox" onclick="event.stopPropagation()" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                </div>
                                --}}
                            </td>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                
                                {{ $libro->titulo }}
                            </th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$libro->autor}}
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center">
                                    {{ $libro->editorial }}
                                </div>
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$libro->isbn}}</td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$libro->anio}}</td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $libro->paginas }}
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $libro->genero }}
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $libro->idioma }}
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $libro->numeroEjemplares }}
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $libro->precio }}
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $libro->estado}}
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @if ($libro->portada)
                            <img src="{{ asset('storage/' . $libro->portada) }}" alt="Portada" width="50">
                                @else
                                    N/A
                                @endif
                            </td>
                            @if (auth()->user()->rol === 'master' || auth()->user()->rol === 'middle')
                            <td>
                                <div class="flex flex-col space-y-2">
                                    <!-- Botón para editar -->
                                    <a href="{{ route('libros.edit', $libro->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full">Editar</a>
                                    
                                    <!-- Botón para eliminar -->
                                    <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 w-full cursor-pointer" onclick="return confirm('¿Estás seguro de que deseas eliminar este libro?')">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                            @endif
                            <td>
                                <form action="{{ route('carrito.agregar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="libro_id" value="{{ $libro->id }}">
                                    <input type="number" name="cantidad" value="1" min="1" max="{{ $libro->numeroEjemplares }}" class="w-16 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">Agregar</button>
                                </form>
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{--  
            <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Showing
                    <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                    of
                    <span class="font-semibold text-gray-900 dark:text-white">1000</span>
                </span>
                <ul class="inline-flex items-stretch -space-x-px">
                    <li>
                        <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Previous</span>
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                    </li>
                    <li>
                        <a href="#" aria-current="page" class="z-10 flex items-center justify-center px-3 py-2 text-sm leading-tight border text-primary-600 bg-primary-50 border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Next</span>
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
            --}}
        </div>
    </div>
  </section>

@if ($errors->any())
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif


@if (session('success'))
    <div id="successMessage" class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
        {{ session('success') }}
    </div>
@endif

<script>
    // Ocultar el mensaje de éxito después de 5 segundos
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000); // 5000 ms = 5 segundos
        }
    });
</script>

<script>
    document.getElementById('agregarTodo').addEventListener('click', function () {
        // Crear un objeto para almacenar los datos de los libros
        const libros = {};

        // Recorrer todos los inputs de cantidad
        document.querySelectorAll('input[name="cantidad"]').forEach(input => {
            const libroId = input.closest('form').querySelector('input[name="libro_id"]').value;
            const cantidad = parseInt(input.value);

            // Solo agregar si la cantidad es mayor a 0
            if (cantidad > 0) {
                libros[libroId] = cantidad;
            }
        });

        // Verificar si hay libros seleccionados
        if (Object.keys(libros).length === 0) {
            alert('Por favor, selecciona al menos un libro para agregar al carrito.');
            return;
        }

        // Enviar los datos al servidor mediante una solicitud POST
        fetch("{{ route('carrito.agregarTodo') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ libros })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Los libros seleccionados han sido agregados al carrito.');
                location.reload(); // Recargar la página para reflejar los cambios
            } else {
                alert('Ocurrió un error al agregar los libros al carrito.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al procesar la solicitud.');
        });
    });
</script>

  <main>
</main>
@endsection