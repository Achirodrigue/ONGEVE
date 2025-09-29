<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response; // important

class FNEApiService
{
    public function certifierFacture(array $data): Response|null
    {
        $url = rtrim(config('services.fne.base_url'), '/') . '/invoices/sign';
        // $url = rtrim("https://www.services.fne.dgi.gouv.ci/ws", '/') . '/invoices/sign';
        $token = config('services.fne.token');

        // ✅ SIMULATION SI MODE TEST
        if (env('FNE_MODE') === 'test' || app()->environment('local')) {
            Log::info('MODE TEST FNE - Simulation d\'une réponse');

            return new \Illuminate\Http\Client\Response(
                new \GuzzleHttp\Psr7\Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    json_encode([
                        'reference' => 'TEST-FNE-REF-001',
                        'token' => 'TEST-FNE-TOKEN-001',
                        'ncc' => 'TEST-NCC',
                        'balance_sticker' => 12,
                        'invoice' => ['status' => 'certified'],
                        'mode' => 'simulation'
                    ])
                )
            );

        }

        // ✅ APPEL REEL API
        try {
            $response = Http::withToken($token)
                ->acceptJson()
                ->post($url, $data);

            Log::info('Réponse FNE réelle', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            return $response;
        } catch (\Exception $e) {
            Log::error('Erreur appel API FNE : ' . $e->getMessage());
            return null;
        }
    }
}
