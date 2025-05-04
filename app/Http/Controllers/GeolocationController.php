<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeolocationController extends Controller
{
    /**
     * Obtiene las coordenadas de una dirección.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCoordinates(Request $request)
    {
        $address = $request->input('address');

        if (!$address) {
            return response()->json(['error' => 'La dirección es requerida.'], 400);
        }

        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $response = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
            'address' => $address,
            'key' => $apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['results'][0])) {
                $location = $data['results'][0]['geometry']['location'];
                return response()->json([
                    'lat' => $location['lat'],
                    'lng' => $location['lng'],
                ]);
            }

            return response()->json(['error' => 'No se encontraron resultados para la dirección proporcionada.'], 404);
        }

        return response()->json(['error' => 'Error al comunicarse con la API de Google Maps.'], 500);
    }
}