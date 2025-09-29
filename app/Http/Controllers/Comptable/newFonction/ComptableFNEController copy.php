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
    //
        // public function certifierFactureFNE($id, FNEApiService $fne)
        // {
        //     // dd("Mettre en ligne pour les facture de vente FNE");

        //     $devis = Clientdevis::with(['client', 'clientdevisprods.produit', 'clientdevisprods.clientdevisremise'])->findOrFail($id);

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
        //         Facturefne::create([
        //             'clientdevis_id' => $devis->id,
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
        // }
    //
    
    public function certifierFactureFNE($id, FNEApiService $fne)
    {
        // dd("Mettre en ligne pour les facture de vente FNE");

        $devis = Clientdevis::with(['client', 'clientdevisprods.produit', 'clientdevisprods.clientdevisremise'])->findOrFail($id);

        // Définir le modèle : B2B ou B2C
            $template = $devis->client->TC ? "B2C" : "B2B";
            // $pointOfSale = "GROUPE CLIS";
            // $etablissement = "GROUPE CLIS";

            $pointOfSale = "Point de vente 1";
            $etablissement = "GROUPE CHALLENGE LOGISTIQUE INTERNATIONAL SERVICES";
        //

        // Construire les lignes de produits
            $items = [];

            if($devis->TDF == null) {
                foreach ($devis->clientdevisprods as $clientdevisprod) {
                    $remise = 0;
                    if($clientdevisprod->clientdevisremise) {
                        $remise = $clientdevisprod->prix_unitaire * ($clientdevisprod->clientdevisremise->remise / 100);
                    }
                    $items[] = [
                        "taxes" => ["TVA"],
                        "reference" => $clientdevisprod->produit->reference ?? '',
                        "description" => $clientdevisprod->produit->nom ?? '',
                        "quantity" => $clientdevisprod->quantite,
                        "amount" => $clientdevisprod->prix_unitaire,
                        "discount" => $clientdevisprod->clientdevisremise->remise ?? 0,
                        "measurementUnit" => $clientdevisprod->produit->unite ?? 'unité',
                    ];
                }
            }
            if($devis->TDF == 1) {
                foreach ($devis->clientdevisprods as $clientdevisprod) {
                    $remise = 0;
                    if($clientdevisprod->clientdevisremise) {
                        $remise = $clientdevisprod->prix_unitaire * ($clientdevisprod->clientdevisremise->remise / 100);
                    }
                    $quantite = $clientdevisprod->quantite * $clientdevisprod->nbre_jour ;
                    $items[] = [
                        "taxes" => ["TVA"],
                        "reference" => $clientdevisprod->produit->reference ?? '',
                        "description" => $clientdevisprod->produit->nom ?? '',
                        "quantity" => $quantite,
                        "amount" => $clientdevisprod->prix_unitaire,
                        "discount" => $clientdevisprod->clientdevisremise->remise ?? 0,
                        "measurementUnit" => $clientdevisprod->produit->unite ?? 'unité',
                    ];
                }
            }
            else {
                foreach ($devis->clientdevisprestations as $clientdevisprestation) {
                    $items[] = [
                        "taxes" => ["TVA"],
                        "reference" => $designation->reference ?? '',
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

            if ($devis->timbre) {
                $customTaxes[] = [
                    "name" => "TIMBRE",
                    "amount" => floatval($devis->timbre)  // convertir en nombre
                ];
            }
        //

        // Préparer les données pour l’API FNE
        // $data = [
        //     "invoiceType" => "sale",
        //     "paymentMethod" => "mobile-money",
        //     "template" => $template,
        //     "clientNcc" => $template === 'B2B' ? $devis->client->NCC : '',
        //     "clientCompanyName" => $devis->client->nom ?? 'Client Particulier',
        //     "clientPhone" => $devis->client->contact,
        //     "clientEmail" => $devis->client->email,
        //     "clientSellerName" => null,
        //     "pointOfSale" => $pointOfSale,
        //     "establishment" => $etablissement,
        //     "commercialMessage" => "Merci de votre visite",
        //     "footer" => "À bientôt !",
        //     "foreignCurrency" => "",
        //     "foreignCurrencyRate" => 0,
        //     "items" => $items,
        //     "customTaxes" => $customTaxes,
        //     "discount" => 0
        // ];
        $data = [
            "invoiceType" => "sale",
            "paymentMethod" => "mobile-money",
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
        // dd("Mettre en ligne pour les facture d'avoir FNE");

        // $facturefne = Facturefne::findOrFail($clientdevisavoir);
        // $clientdevisavoir = Facturefne::findOrFail($clientdevisavoir);
        $facturefne = $clientdevisavoir->clientdevis->facturefne;
        if (!$facturefne) {
            return back()->with('error', 'ID de facture introuvable.');
        }
        // dd($clientdevisavoir->clientdevis->facturefne);

        $raw = json_decode($facturefne->raw_response, true);
        $invoiceId = $raw['invoice']['id'] ?? null;
        // dd($invoiceId);


        if (!$invoiceId) {
            return back()->with('error', 'ID de facture introuvable.');
        }

        // Charger tous les produits d'avoir liés à cette facture
        $produitsAvoir = $clientdevisavoir->clientdevisavoirprods;
        // dd($produitsAvoir->all());
        // $produitsAvoir = Clientdevisavoirprod::where('facturefne_id', $facturefneId)->get();

        // Liste des produits FNE
        $produitsFNE = collect($raw['invoice']['items']);
        // dd($produitsFNE);


        // Construire la liste des items à rembourser
        $items = [];

        foreach ($produitsAvoir as $prodAvoir) {
        // dd($prodAvoir->quantite);

            // On suppose que tu peux faire correspondre par description ou autre clé
            $produitFNE = $produitsFNE->firstWhere('description', $prodAvoir->clientdevisprod->produit->nom); // ou autre critère
            // $produitFNE = $produitsFNE->firstWhere('reference', $prodAvoir->reference); // ou autre critère

            $quantity = (int)$prodAvoir->quantite;

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
            // $facturefne->update([
            //     'reponse_avoir' => $response->body(),
            // ]);
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
        }
    }
}