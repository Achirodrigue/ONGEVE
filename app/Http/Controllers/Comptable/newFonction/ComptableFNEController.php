<?php

namespace App\Http\Controllers\Comptable\newFonction;

use App\Models\Facturefne;
use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Models\Facturefneavoir;
use App\Services\FNEApiService;
use App\Models\Clientdevisavoir;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Clientdevisavoirprod;
use App\Services\FNEApiServiceAvoir;

class ComptableFNEController extends Controller
{
    public function certifierFactureFNE($id, FNEApiService $fne)
    {
        // dd("Mettre en ligne pour les facture de vente FNE");

        $devis = Clientdevis::with(['client', 'clientdevisprods.produit', 'clientdevisprods.clientdevisremise'])->findOrFail($id);

        // Définir le modèle : B2B ou B2C
            $template = $devis->client->TC ? "B2C" : "B2B";
            $pointOfSale = "GROUPE CLIS";
            $etablissement = "GROUPE CLIS";

            // $pointOfSale = "Point de vente 1";
            // $etablissement = "GROUPE CHALLENGE LOGISTIQUE INTERNATIONAL SERVICES";
        //

        // Construire les lignes de produits
            // Définir les taxes selon TVA
            $taxes = $devis->apptva ? ["TVA"] : [];

            // Construire les lignes de produits/prestations
            $items = [];

            if ($devis->TDF === null || $devis->TDF == 1) {
                foreach ($devis->clientdevisprods as $clientdevisprod) {
                    // calcul remise
                    $remise = 0;
                    if ($clientdevisprod->clientdevisremise) {
                        $remise = $clientdevisprod->prix_unitaire * ($clientdevisprod->clientdevisremise->remise / 100);
                    }

                    // quantité (si TDF == 1, inclure nbre_jour)
                    $quantite = $devis->TDF == 1
                        ? $clientdevisprod->quantite * $clientdevisprod->nbre_jour
                        : $clientdevisprod->quantite;

                    $items[] = [
                        "taxes" => $taxes,
                        "reference" => $clientdevisprod->produit->reference ?? '',
                        "description" => $clientdevisprod->produit->nom ?? '',
                        "quantity" => $quantite,
                        "amount" => $clientdevisprod->prix_unitaire,
                        "discount" => (float) ($clientdevisprod->clientdevisremise->remise ?? 0),
                        "measurementUnit" => $clientdevisprod->produit->unite ?? 'unité',
                    ];
                }
            } else {
                foreach ($devis->clientdevisprestations as $clientdevisprestation) {
                    $items[] = [
                        "taxes" => $taxes,
                        "reference" => $clientdevisprestation->reference ?? '',
                        "description" => $clientdevisprestation->designation ?? '',
                        "quantity" => $clientdevisprestation->nbre_passage ?? '',
                        "amount" => $clientdevisprestation->prix_unitaire ?? '',
                        "discount" => 0,
                        "measurementUnit" => $clientdevisprestation->unite ?? '',
                    ];
                }
            }
        //
        // Taxes personnalisées (AIRSI, TIMBRE)
            $customTaxes = [];

            if ($devis->airsi) {
                $customTaxes[] = [
                    "name" => "AIRSI",
                    "amount" => floatval($devis->airsi)  // convertir en nombre
                ];
            }

            // if ($devis->timbre) {
            //     $customTaxes[] = [
            //         "name" => "TIMBRE",
            //         "amount" => floatval($devis->timbre)  // convertir en nombre
            //     ];
            // }
        //
        
        $paymentMethod = strtolower(str_replace(' ', '-', $devis->MP ?? 'mobile-money'));

        $data = [
            "invoiceType" => "sale",
            // "taxes" => $taxes,
            "paymentMethod" => $paymentMethod,
            "template" => $template,
            "clientNcc" => $template === 'B2B' ? strval($devis->client->NCC ?? '') : '',
            "clientCompanyName" => $devis->client->nom ?? 'Client Particulier',
            "clientPhone" => $devis->client->contact,
            "clientEmail" => $devis->client->email ?? '',
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

        $body = $reponse->json();

        if ($reponse->successful() && isset($body['invoice'])) {
            Facturefne::create([
                'clientdevis_id' => $devis->id,
                'reference' => strval($body['reference'] ?? ''),           // cast en string
                'token' => strval($body['token'] ?? ''),                   // cast en string
                'ncc' => strval($body['ncc'] ?? ''),                       // cast en string
                'balance_sticker' => strval($body['balance_sticker'] ?? ''), // cast en string
                'status' => strval($body['invoice']['status'] ?? 'inconnu'),
                'raw_response' => json_encode($body),                      // convertir en JSON
            ]);

            // return response()->json([
            //     'message' => 'Facture certifiée avec succès',
            //     'data' => $body
            // ], 200);
            $noms = $devis->client->nom;
            return back()->with('success', "Facture de $noms envoyé avec succès à la FNE");
        }

        return response()->json([
            'message' => 'Erreur lors de la certification',
            'data' => $body
        ], $reponse->status());
    }


    public function certifierFactureAvoirFNE(Clientdevisavoir $clientdevisavoir, FNEApiServiceAvoir $fneApiService)
    {
        $facturefne = $clientdevisavoir->clientdevis->facturefne;
        // dd($clientdevisavoir);

        if (!$facturefne) {
            return back()->with('error', 'ID de facture introuvable.');
        }
        // dd(3);

        $raw = json_decode($facturefne->raw_response, true);
        $invoiceId = $raw['invoice']['id'] ?? null;

        if (!$invoiceId) {
            return back()->with('error', 'ID de facture introuvable.');
        }
        // dd(5);
        
        // Charger tous les produits d'avoir liés à cette facture
        if($clientdevisavoir->clientdevis->TDF != 2) {
            $produitsAvoir = $clientdevisavoir->clientdevisavoirprods;
        }
        else {
            $produitsAvoir = $clientdevisavoir->clientdevisavoirprestations;
        }

        // Liste des produits FNE
        $produitsFNE = collect($raw['invoice']['items']);

        // Construire la liste des items à rembourser
        $items = [];

        foreach ($produitsAvoir as $prodAvoir) {
        // dd($prodAvoir->quantite);
            // On suppose que tu peux faire correspondre par description ou autre clé
            if($clientdevisavoir->clientdevis->TDF != 2) {
                $produitFNE = $produitsFNE->firstWhere('description', $prodAvoir->clientdevisprod->produit->nom); // ou autre critère
            }
            else {
                $produitFNE = $produitsFNE->firstWhere('description', $prodAvoir->clientdevisprestation->designation); // ou autre critère
            }
            // $produitFNE = $produitsFNE->firstWhere('reference', $prodAvoir->reference); // ou autre critère

            // $quantity = (int)$prodAvoir->quantite;
            $quantity = max(1, (int)$prodAvoir->quantite);

            if ($produitFNE) {
                $items[] = [
                    'id' => $produitFNE['id'],
                    'quantity' => $quantity
                ];
            }
        }

        if (empty($items)) {
            return back()->with('error', 'Aucun produit correspondant trouvé pour la FNE.');
        }

        // Envoi à la FNE
        $response = $fneApiService->refundInvoice($invoiceId, $items);

        $body = $response->json();
        // dd($body);

        if ($response->successful()) {
            Facturefneavoir::create([
                'clientdevisavoir_id' => $clientdevisavoir->id,
                'reference' => strval($body['reference'] ?? ''),           // cast en string
                'token' => strval($body['token'] ?? ''),                   // cast en string
                'ncc' => strval($body['ncc'] ?? ''),                       // cast en string
                // 'balance_sticker' => strval($body['balance_sticker'] ?? ''), // cast en string
                'status' => strval($body['invoice']['status'] ?? 'inconnu'),
                'raw_response' => json_encode($body),                      // convertir en JSON
            ]);

            return back()->with('success', 'Avoir envoyé avec succès à la FNE.');
        } else {
            return back()->with('error', 'Erreur FNE: ' . $response->body());
            Log::error('Erreur FNE refund', [
                'invoiceId' => $invoiceId,
                'items' => $items,
                'response' => $response->body()
            ]);
        }
    }
}