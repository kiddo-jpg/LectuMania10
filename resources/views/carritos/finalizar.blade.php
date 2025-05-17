@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center">
    <svg class="mx-auto mb-4 w-16 h-16 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
    </svg>
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">¡Compra realizada con éxito!</h1>
    <p class="text-gray-600 dark:text-gray-300 mb-6">
        Tu pedido ha sido registrado y está siendo procesado.<br>
        Pronto recibirás una notificación con los detalles.
    </p>
    <a href="{{ route('libros.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg px-5 py-2.5">
        Volver al catálogo
    </a>
</div>
@endsection