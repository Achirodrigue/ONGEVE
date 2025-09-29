<?php

namespace App\Http\Controllers\Comptable\newFonction;

use App\Models\Client;
use App\Models\Produit;
use App\Models\Produitse;
use App\Models\Clientinfo;
use App\Models\Clientdevis;
use App\Models\Particulier;
use App\Models\Clientremise;
use Illuminate\Http\Request;
use App\Models\Clientdevisbon;
use App\Models\Clientdevisinfo;
use App\Models\Clientdevisprod;
use App\Models\Particulierdevis;
use App\Models\Clientdevisremise;
use App\Models\Particulierremise;
use App\Http\Controllers\Controller;
use App\Models\Particulierdevisprod;
use Illuminate\Support\Facades\Storage;

class ComptableEtablirFactureClientController extends Controller
{
    //devis client
        public function factureClientCreate()
        {
            return view('dashboard.comptable.facture-client.add-facture-client');
        }
        public function factureClientStore(Request $request)
        {
            $this->validate($request, [
                'client' => 'required|min:1',
                'TD' => 'required|min:1',

                // 'date_expiration' => 'required|min:2',
                // 'condition_validite' => 'required|min:2',
                // 'mode_paiement' => 'required|min:2',
                // 'delai_livraison' => 'required|min:2',
                // 'note_condition' => 'required|min:2',
                // 'frais' => 'required|min:2',
                'objet' => 'required|min:2',
            ]);
            // dd($request->client, $request->clients);

            //données initiales
                $numero_facture = null;
                $total_ttc = 0;
                $tva = 0; //18%
                $delai_livraison = null;
                $frais = null;

                $airsi = null;
                $airsi_montant = null;
                $timbre = null;
                $date_emission = null;
                $daterecfacture = null;
                $delai_paiement = $request->delai_paiement;
                $moyen_paiement = $request->MP;

                if($request->TD == 0) {$TDF = null;} elseif($request->TD == 1) {$TDF = 1;} else {$TDF = 2;}
            //

            //creation ou selection de client
                if($request->client === "Nouveau")
                {
                    $this->validate($request, [
                        'nom' => 'required|min:2',
                        'adresse_postale' => 'nullable|min:2',
                        'Pachat' => 'nullable|min:2',
                        'contact' => 'required|unique:clients|min:8|max:12',
                        'email' => 'nullable|email|unique:clients|min:8',
                        'NCC' => 'nullable|unique:clients|min:3|max:30',
                        'reference' => 'nullable|unique:clients|min:1|max:30',
                        
                        'forme_juridique' => 'nullable|min:2',
                        'numero_identifie' => 'nullable|min:2',
                        'domaine' => 'nullable|min:2',
                        'siege_social' => 'nullable|min:2',
                        'genre' => 'nullable|min:4',
                        'naissance' => 'nullable|min:8',
                    ]);
                    
                    $client = Client::create([
                        'nom' => $request->nom,
                        'email' => $request->email ,
                        'contact' => $request->contact ,
                        'NCC' => $request->NCC ,
                        'Pachat' => $request->Pachat,
                        'adresse_postale' => $request->adresse_postale,
                        'TC' => $request->TC,
                        'reference' => $request->reference,
                    ]);

                    $clientinfo = Clientinfo::create([
                        'genre' => $request->genre,
                        'naissance' => $request->naissance,
                        'forme_juridique' => $request->forme_juridique,
                        'numero_identifie' => $request->numero_identifie,
                        'domaine' => $request->domaine,
                        'siege_social' => $request->siege_social,
                        'client_id' => $client->id,
                    ]);
                }
                else
                {
                    $this->validate($request, [
                        'clients' => 'required|min:1',
                    ]);
                    
                    $client = Client::findOrfail($request->clients);
                    // dd($client->id);

                    $clientdevis = $client->clientdevis()->whereHas('clientdevisinfo')->get();

                    $restePayer = 0;
                    foreach($clientdevis as $clientdevis)
                    {
                        $restePayer += ($clientdevis->total_payer - $clientdevis->versement);
                    }   

                    if($restePayer >= $client->Pachat)
                    {
                        return back()->with('error', "Desolé! Ce client a atteint son plafond de credit.");
                    }
                }
            //

            // Génération du numero de devis
                $nom = strtoupper(substr(removeAccents($client->nom), 0, 3));
                $contact = strtoupper(substr(removeAccents($client->contact), 0, 3));
                $lastClientdevis = Clientdevis::orderBy('id', 'desc')->first();
                $lastNumber = $lastClientdevis ? $lastClientdevis->id : 0;
                $numero_devis = "{$nom}-{$contact}-{$lastNumber}";
            //

            //calcul
                $total_payer = $tva + $frais + $total_ttc;
            //

            // dd($tva);
            $clientdevis = Clientdevis::create([
                'numero_devis' => $numero_devis ,
                'numero_facture' => $numero_facture ,

                'tva' => $tva ,
                'frais' => $request->frais,
                'total_ttc' => $total_ttc ,
                'delai_livraison' => $request->delai_livraison,

                // 'TD' => $request->TD ,
                'TDF' => $TDF ,
                'archive' => 0 ,

                'statut' => null ,
                'versement' => null ,
                'total_payer' => $total_payer ,

                'airsi' => $airsi ,
                'airsi_montant' => $airsi_montant ,
                'timbre' => $timbre ,
                'date_emission' => $date_emission ,
                'daterecfacture' => $daterecfacture ,
                'delai_paiement' => $delai_paiement ,
                'MP' => $moyen_paiement , 

                'objet' => $request->objet ,
                'chantier' => $request->chantier ,
                
                'client_id' => $client->id ,
            ]);

            if($request->TD === "0")
            {
                $clientdevisinfo = Clientdevisinfo::create([
                    'isvalide' => 1,
                    'livraison' => 0,
                    'livraison_retour' => 0,

                    'magasinier' => 0,
                    'etat' => null,
                    'motif_rejet' => null,

                    'debut' => null,
                    'fin' => null,
                    'clientdevis_id' => $clientdevis->id,
                ]);
            }else{
                $this->validate($request, [
                    'debut' => 'required|min:4',
                    'fin' => 'required|min:4',
                ]);

                $clientdevisinfo = Clientdevisinfo::create([
                    'isvalide' => 1,
                    'livraison' => 0,
                    'livraison_retour' => 0,

                    'magasinier' => 0,
                    'etat' => null,
                    'motif_rejet' => null,

                    'debut' => $request->debut,
                    'fin' => $request->fin,
                    'clientdevis_id' => $clientdevis->id,
                ]);
            }

            $noms = $client->nom ;
                
            if($request->TD == "2")
            {
                return redirect()->route('comptable.facture.client.create.prestation', compact('clientdevis'))->with('success', "$noms : facture ajouté avec succès");
            }
            return redirect()->route('comptable.facture.client.create.deux', compact('clientdevis'))->with('success', "$noms : facture ajouté avec succès");
        }
        public function factureClientCreateDeux(Clientdevis $clientdevis)
        {
            // dd(1);
            return view('dashboard.comptable.facture-client.add-facture-client-deux', compact('clientdevis'));
        }
        public function produitPrixUpdate(Request $request, Produit $produit)
        {
            if(empty($request->prix) && empty($request->qtyStock))
            {
                return back()->with('success', "Desolé! Veillez remplir l'un des deux champs du formulaire");
            }

            $this->validate($request, [
                'prix' => 'nullable|min:1',
                'qtyStock' => 'nullable|min:1',
            ]);

            $produit->update([
                'prix' => $request->prix,
                'qtyStock' => $request->qtyStock,
            ]);

            //cal
                $cal = ($request->qtyStock * 25) / 100 ;
                $SM = floor($cal);
                
                $entree = $request->qtyStock - $produit->qtyStock ;
                $entreT = $entree + $produit->produitstat->entree;
                // $quantite = $entree + $produit->prodse->quantite;
            //

            $produit->produitstat->update([
                'stock_min' => $SM,
                'entree' => $entreT
            ]);

            if($entree > 0)
            {
                Produitse::create([
                    'quantite' => $entree,
                    'entree_sortie' => 1,
                    'produit_id' => $produit->id,
                ]);
            }

            $noms = $produit->nom;
            return back()->with('success', "$noms : prix modifié avec succès");
        }

        //prestation
            public function factureClientCreatePrestation(Clientdevis $clientdevis)
            {
                return view('dashboard.comptable.facture-client.add-facture-client-prestation', compact('clientdevis'));
            }
        //
    //
}
