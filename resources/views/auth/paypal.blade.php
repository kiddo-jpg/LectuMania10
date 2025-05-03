@extends('layouts.app')


@section('content')

</div>
</nav>
<main>
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6 dark:bg-gray-800">
    <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-5">Pago con PayPal</h1>

    <!-- Mensajes de éxito -->
    @if ($message = Session::get('success'))
        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <!-- Mensajes de error -->
    @if ($message = Session::get('error'))
        <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <!-- Botón de pago -->
    <div class="flex justify-center">
        <a href="{{ route('paypal.payment') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
            Pagar con PayPal
        </a>
    </div>
</div>

</main>

@endsection