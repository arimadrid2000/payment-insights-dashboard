<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\PaymentApiService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentApiService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        // Obtenemos las últimas transacciones y el estado de la API
        $transactions = Transaction::latest()->take(10)->get();
        $apiHealth = $this->paymentService->getHealth();

        return view('dashboard', compact('transactions', 'apiHealth'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'email' => 'required|email',
            'cardNumber' => 'required|string|size:16',
            'cvv' => 'required|string|size:3',
        ]);

        $payload = [
            'amount'     => (float) $request->amount,
            'currency'   => 'USD',
            'email'      => $request->email,
            'cardNumber' => $request->cardNumber,
            'cvv'        => $request->cvv,
        ];

        // Llamamos a la API de Node.js en Render
        $response = $this->paymentService->processPayment($payload);

        if ($response && $response->successful()) {
            $data = $response->json();

            // Guardamos en nuestra DB local
            Transaction::create([
                'external_id' => $data['id'],
                'amount' => $request->amount,
                'currency' => 'USD',
                'email' => $request->email,
                'status' => 'approved',
                'card_brand' => $data['brand'] ?? 'VISA',
            ]);

            return back()->with('success', '¡Pago procesado con éxito!');
        }

        // Si la API rechazó el pago (ej. Luhn falló o fondos insuficientes)
        return back()->withErrors(['api_error' => $response->json()['message'] ?? 'Error en el procesador de pagos']);
    }
}
