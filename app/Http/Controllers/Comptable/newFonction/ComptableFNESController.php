<?php

namespace App\Http\Controllers\Comptable\newFonction;

use App\Models\Facturefne;
use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Models\Facturefneavoir;
use App\Services\FNEApiService;
use App\Models\Clientdevisavoir;
use App\Http\Controllers\Controller;
use App\Models\Clientdevisavoirprod;
use App\Services\FNEApiServiceAvoir;

class ComptableFNEController extends Controller
{
    public function certifierFactureFNE($id, FNEApiService $fne)
    {
        dd("Mettre en ligne pour les facture de vente FNE");

        $devis = Clientdevis::with(['client', 'clientdevisprods.produit', 'clientdevisprods.clientdevisremise'])->findOrFail($id);

        // Définir le modèle : B2B ou B2C
            $template = $devis->client->TC ? "B2C" : "B2B";
            $pointOfSale = "GROUPE CLIS";
            $etablissement = "GROUPE CLIS";
        //

        // Construire les lignes de produits
            $items = [];

            foreach ($devis->clientdevisprods as $clientdevisprod) {
                $items[] = [
                    "taxes" => ["TVA"],
                    "reference" => $clientdevisprod->produit->reference ?? '',
                    "description" => $clientdevisprod->produit->description ?? '',
                    "quantity" => $clientdevisprod->quantite,
                    "amount" => $clientdevisprod->prix_unitaire,
                    "discount" => $clientdevisprod->clientdevisremise->remise ?? 0,
                    "measurementUnit" => "unité"
                ];
            }
        //
        // Taxes personnalisées (AIRSI, TIMBRE)
            $customTaxes = [];

            if ($devis->airsi) {
                $customTaxes[] = [
                    "name" => "AIRSI",
                    "amount" => $devis->airsi
                ];
            }

            if ($devis->timbre) {
                $customTaxes[] = [
                    "name" => "TIMBRE",
                    "amount" => $devis->timbre
                ];
            }
        //

        // Préparer les données pour l’API FNE
        $data = [
            "invoiceType" => "sale",
            "paymentMethod" => "mobile-money",
            "template" => $template,
            "clientNcc" => $template === 'B2B' ? $devis->client->NCC : '',
            "clientCompanyName" => $devis->client->nom ?? 'Client Particulier',
            "clientPhone" => $devis->client->contact,
            "clientEmail" => $devis->client->email,
            "clientSellerName" => null,
            "pointOfSale" => $pointOfSale,
            "establishment" => $etablissement,
            "commercialMessage" => "Merci de votre visite",
            "footer" => "À bientôt !",
            "foreignCurrency" => "",
            "foreignCurrencyRate" => 0,
            "items" => $items,
            "customTaxes" => $customTaxes,
            "discount" => 0
        ];

        // Appel à l'API FNE
        $reponse = $fne->certifierFacture($data);
        
        //erreur verification
            // Toutes ces conditions viennent juste ici, sans sauter de ligne ni de code entre elles
            if (!$reponse) {
                return response()->json(['message' => 'Aucune réponse de la plateforme FNE.'], 500);
            }

            if ($reponse->status() === 401) {
                return response()->json(['message' => 'Token API invalide ou expiré.'], 401);
            }

            if ($reponse->status() === 422) {
                return response()->json([
                    'message' => 'Erreur de validation côté FNE',
                    'errors' => $reponse->json('errors', [])
                ], 422);
            }

            if (!$reponse->successful()) {
                return response()->json([
                    'message' => 'Erreur inconnue lors de la certification',
                    'details' => $reponse->json()
                ], $reponse->status());
            }
        //

        if (!$reponse) {
            return response()->json([
                'message' => 'Erreur : aucune réponse reçue de la plateforme FNE.',
            ], 500);
        }

        $body = $reponse->json();

        if ($reponse->successful() && isset($body['invoice'])) {
            Facturefne::create([
                'clientdevis_id' => $devis->id,
                'reference' => $body['reference'] ?? null,
                'token' => $body['token'] ?? null,
                'ncc' => $body['ncc'] ?? null,
                'balance_sticker' => $body['balance_sticker'] ?? null,
                'status' => $body['invoice']['status'] ?? 'inconnu',
                'raw_response' => $body
            ]);

            return response()->json([
                'message' => 'Facture certifiée avec succès',
                'data' => $body
            ], 200);
        }

        return response()->json([
            'message' => 'Erreur lors de la certification',
            'data' => $body
        ], $reponse->status());
    }

    public function certifierFactureAvoirFNE($facturefneId, FNEApiServiceAvoir $fneApiService)
    {
        dd("Mettre en ligne pour les facture d'avoir FNE");

        $facturefne = Facturefne::findOrFail($facturefneId);
        $raw = json_decode($facturefne->raw_reponse, true);
        $invoiceId = $raw['invoice']['id'] ?? null;

        if (!$invoiceId) {
            return back()->with('error', 'ID de facture introuvable.');
        }

        // Charger tous les produits d'avoir liés à cette facture
        $produitsAvoir = Clientdevisavoirprod::where('facturefne_id', $facturefneId)->get();

        // Liste des produits FNE
        $produitsFNE = collect($raw['invoice']['items']);

        // Construire la liste des items à rembourser
        $items = [];

        foreach ($produitsAvoir as $prodAvoir) {
            // On suppose que tu peux faire correspondre par description ou autre clé
            $produitFNE = $produitsFNE->firstWhere('description', $prodAvoir->description); // ou autre critère
            // $produitFNE = $produitsFNE->firstWhere('reference', $prodAvoir->reference); // ou autre critère

            if ($produitFNE) {
                $items[] = [
                    'id' => $produitFNE['id'],
                    'quantity' => $prodAvoir->quantite
                ];
            }
        }

        if (empty($items)) {
            return back()->with('error', 'Aucun produit correspondant trouvé pour la FNE.');
        }

        // Envoi à la FNE
        $response = $fneApiService->refundInvoice($invoiceId, $items);

        if ($response->successful()) {
            $facturefne->update([
                'reponse_avoir' => $response->body(),
            ]);

            return back()->with('success', 'Avoir envoyé avec succès à la FNE.');
        } else {
            return back()->with('error', 'Erreur FNE: ' . $response->body());
        }


        // $facturefne = Facturefne::findOrFail($facturefneId);

        // // On suppose que `raw_reponse` contient la réponse FNE JSON déjà certifiée
        // $raw = json_decode($facturefne->raw_reponse, true);

        // // Récupération de l'id de la facture à rembourser
        // $invoiceId = $raw['invoice']['id'] ?? null;

        // if (!$invoiceId) {
        //     return back()->with('error', 'ID de facture introuvable.');
        // }

        // // Tu peux ajuster la quantité ici
        // $items = collect($raw['invoice']['items'])->map(function ($item) {
        //     return [
        //         'id' => $item['id'],
        //         'quantity' => 1 // Mets ici la quantité à rembourser
        //     ];
        // })->toArray();

        // // Appel à la FNE
        // $response = $fneApiService->refundInvoice($invoiceId, $items);

        // if ($response->successful()) {
        //     // Tu peux stocker la réponse dans la base ou l'afficher
        //     $facturefne->update([
        //         'reponse_avoir' => $response->body(), // Ajoute cette colonne dans ta migration si besoin
        //     ]);

        //     return back()->with('success', 'Avoir envoyé avec succès.');
        // } else {
        //     return back()->with('error', 'Erreur FNE: ' . $response->body());
        // }








        // {
        //     "items": [
        //         {
        //             "id": "ee76d51a-5771-4df3-bc0b-1fbd313db9be",
        //             "quantity": 1
        //         }
        //     ]
        // }

    //     dd("Mettre en ligne pour les facture d'avoir FNE");

    //     $devis = Clientdevisavoir::with(['client', 'clientdevisprods.produit', 'clientdevisprods.clientdevisremise'])->findOrFail($id);

    //     // Définir le modèle : B2B ou B2C
    //         $template = $devis->client->TC ? "B2C" : "B2B";
    //         $pointOfSale = "GROUPE CLIS";
    //         $etablissement = "GROUPE CLIS";
    //     //

    //     // Construire les lignes de produits
    //         $items = [];

    //         foreach ($devis->clientdevisprods as $clientdevisprod) {
    //             $items[] = [
    //                 "taxes" => ["TVA"],
    //                 "reference" => $clientdevisprod->produit->reference ?? '',
    //                 "description" => $clientdevisprod->produit->description ?? '',
    //                 "quantity" => $clientdevisprod->quantite,
    //                 "amount" => $clientdevisprod->prix_unitaire,
    //                 "discount" => $clientdevisprod->clientdevisremise->remise ?? 0,
    //                 "measurementUnit" => "unité"
    //             ];
    //         }
    //     //
    //     // Taxes personnalisées (AIRSI, TIMBRE)
    //         $customTaxes = [];

    //         if ($devis->airsi) {
    //             $customTaxes[] = [
    //                 "name" => "AIRSI",
    //                 "amount" => $devis->airsi
    //             ];
    //         }

    //         if ($devis->timbre) {
    //             $customTaxes[] = [
    //                 "name" => "TIMBRE",
    //                 "amount" => $devis->timbre
    //             ];
    //         }
    //     //

    //     // Préparer les données pour l’API FNE
    //     $data = [
    //         "invoiceType" => "sale",
    //         "paymentMethod" => "mobile-money",
    //         "template" => $template,
    //         "clientNcc" => $template === 'B2B' ? $devis->client->NCC : '',
    //         "clientCompanyName" => $devis->client->nom ?? 'Client Particulier',
    //         "clientPhone" => $devis->client->contact,
    //         "clientEmail" => $devis->client->email,
    //         "clientSellerName" => null,
    //         "pointOfSale" => $pointOfSale,
    //         "establishment" => $etablissement,
    //         "commercialMessage" => "Merci de votre visite",
    //         "footer" => "À bientôt !",
    //         "foreignCurrency" => "",
    //         "foreignCurrencyRate" => 0,
    //         "items" => $items,
    //         "customTaxes" => $customTaxes,
    //         "discount" => 0
    //     ];

    //     // Appel à l'API FNE
    //     $reponse = $fne->certifierFacture($data);
        
    //     //erreur verification
    //         // Toutes ces conditions viennent juste ici, sans sauter de ligne ni de code entre elles
    //         if (!$reponse) {
    //             return response()->json(['message' => 'Aucune réponse de la plateforme FNE.'], 500);
    //         }

    //         if ($reponse->status() === 401) {
    //             return response()->json(['message' => 'Token API invalide ou expiré.'], 401);
    //         }

    //         if ($reponse->status() === 422) {
    //             return response()->json([
    //                 'message' => 'Erreur de validation côté FNE',
    //                 'errors' => $reponse->json('errors', [])
    //             ], 422);
    //         }

    //         if (!$reponse->successful()) {
    //             return response()->json([
    //                 'message' => 'Erreur inconnue lors de la certification',
    //                 'details' => $reponse->json()
    //             ], $reponse->status());
    //         }
    //     //

    //     if (!$reponse) {
    //         return response()->json([
    //             'message' => 'Erreur : aucune réponse reçue de la plateforme FNE.',
    //         ], 500);
    //     }

    //     $body = $reponse->json();

    //     if ($reponse->successful() && isset($body['invoice'])) {
    //         Facturefneavoir::create([
    //             'clientdevisavoir_id' => $devis->id,
    //             'reference' => $body['reference'] ?? null,
    //             'token' => $body['token'] ?? null,
    //             'ncc' => $body['ncc'] ?? null,
    //             'balance_sticker' => $body['balance_sticker'] ?? null,
    //             'status' => $body['invoice']['status'] ?? 'inconnu',
    //             'raw_response' => $body
    //         ]);

    //         return response()->json([
    //             'message' => 'Facture certifiée avec succès',
    //             'data' => $body
    //         ], 200);
    //     }

    //     return response()->json([
    //         'message' => 'Erreur lors de la certification',
    //         'data' => $body
    //     ], $reponse->status());
    }
}