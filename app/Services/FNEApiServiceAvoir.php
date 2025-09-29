<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FNEApiServiceAvoir
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.fne.base_url'), '/');
        $this->token   = config('services.fne.token'); // on charge le token depuis .env
    }

    public function refundInvoice(string $invoiceId, array $items)
    {
        
        $url = "{$this->baseUrl}/external/invoices/{$invoiceId}/refund";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token, // ✅ même header que Postman
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post($url, [
            'items' => $items,
        ]);

        return $response;
    }
}
