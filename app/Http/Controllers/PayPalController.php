<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;

class PayPalController extends Controller
{
    /**
     * Muestra la vista principal de PayPal.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('auth.paypal');
    }

    /**
     * Crea un pedido en PayPal y redirige al usuario para aprobarlo.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success'),
                "cancel_url" => route('paypal.payment.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "100.00",
                    ],
                ],
            ],
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()
            ->route('paypal')
            ->with('error', $response['message'] ?? 'No se pudo crear el pedido en PayPal.');
    }

    /**
     * Maneja la cancelación del pago por parte del usuario.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function paymentCancel()
    {
        return redirect()
            ->route('paypal')
            ->with('error', 'Has cancelado la transacción.');
    }

    /**
     * Captura el pago aprobado por el usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->query('token'));

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('paypal')
                ->with('success', 'Transacción completada con éxito.');
        }

        return redirect()
            ->route('paypal')
            ->with('error', $response['message'] ?? 'No se pudo completar la transacción.');
    }
}