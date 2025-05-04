@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6 dark:bg-gray-800">
    <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-5">Geolocalización</h1>

    <form id="geolocationForm" class="mb-5">
        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección</label>
        <input type="text" id="address" name="address" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ingresa una dirección" required>
        <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">Obtener Coordenadas</button>
    </form>

    <div id="result" class="text-gray-800 dark:text-white"></div>
</div>

<script>
    document.getElementById('geolocationForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const address = document.getElementById('address').value;

        fetch(`{{ route('geolocation') }}?address=${encodeURIComponent(address)}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('result').innerHTML = `<p class="text-red-500">${data.error}</p>`;
                } else {
                    document.getElementById('result').innerHTML = `
                        <p><strong>Latitud:</strong> ${data.lat}</p>
                        <p><strong>Longitud:</strong> ${data.lng}</p>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('result').innerHTML = `<p class="text-red-500">Ocurrió un error al procesar la solicitud.</p>`;
            });
    });
</script>
@endsection