<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentApiService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.payment_gateway.url');
    }

    public function processPayment(array $data)
    {
        try {
            $response = Http::timeout(10)->post("{$this->baseUrl}/api/v1/payments", $data);
            return $response;
        } catch (\Exception $e) {
            Log::error("Error conectando con la API de Pagos: " . $e->getMessage());
            return null;
        }
    }

    public function getHealth()
    {
        return Http::get("{$this->baseUrl}/api/v1/payments/health")->json();
    }
}
