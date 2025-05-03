@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6 dark:bg-gray-800">
    <h1 class="text-2xl font-bold text-center text-red-600 dark:text-red-400">Transacción Cancelada</h1>
    <p class="mt-4 text-center text-gray-700 dark:text-gray-300">
        Has cancelado la transacción. Si esto fue un error, puedes intentar nuevamente haciendo clic en el botón de abajo.
    </p>
    <div class="mt-6 flex justify-center">
        <a href="{{ route('paypal') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
            Volver a Intentar
        </a>
    </div>
</div>
@endsection