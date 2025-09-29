<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FNEApiService
{

    public function certifierFacture(array $data)
    {
        $url = rtrim(config('services.fne.base_url'), '/') . '/external/invoices/sign';
        $token = config('services.fne.token');

        try {
            Log::info('Envoi de facture à FNE', ['url' => $url, 'data' => $data]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($url, $data);

            Log::info('Réponse de la FNE', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            return $response;
        } catch (\Exception $e) {
            Log::error('Erreur lors de l’appel à la FNE : ' . $e->getMessage());
            return null;
        }
    }
}
