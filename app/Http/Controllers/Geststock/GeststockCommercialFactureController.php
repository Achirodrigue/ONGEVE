<?php

namespace App\Http\Controllers\Geststock;

use App\Models\Commercial;

use App\Models\Client;
use App\Models\Produit;
use App\Models\Clientinfo;
use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Models\Clientdevisbon;
use App\Models\Clientdevisinfo;
use App\Models\Clientdevisprod;
use App\Models\Clientdevisremise;
use App\Http\Controllers\Controller;

use App\Models\Clientdevisprestation;
use App\Models\Clientdevisfraisdetail;
use Illuminate\Support\Facades\Storage;

class GeststockCommercialFactureController extends Controller
{
    //commercial
        public function allCommercial()
        {
            $commercials = Commercial::orderBy('updated_at','desc')->get();
            return view('dashboard.geststock.commercial.all-commercial', compact('commercials'));
        }
    //

    //devis et facture client
        public function geststockFactureClientCreate( Commercial $commercial)
        {
            return view('dashboard.geststock.commercial.facture.add-facture-client', compact('commercial'));
        }
        public function geststockFactureClientStore(Request $request, Commercial $commercial)
        {
            $this->validate($request, [
                'client' => 'required|min:1',
                'TD' => 'required|min:1',
                'objet' => 'required|min:2',
            ]);

            if($request->TD != "0")
            {
                $this->validate($request, [
                    'debut' => 'required|min:4',
                    'fin' => 'required|min:4',
                ]);
            }

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

                if($request->DF == 0) {$commande = "Devis";} else {$commande = "Facture";}
            //

            //creation ou selection de client
                if($request->client === "ChoisirClient")
                {
                    $this->validate($request, [
                        'nom' => 'required|min:2',
                        'adresse_postale' => 'nullable|min:2',
                        'Pachat' => 'nullable|min:2',
                        'contact' => 'required|unique:clients|min:8|max:12',
                        'email' => 'nullable|email|unique:clients|min:8',
                        'NCC' => 'nullable|unique:clients|min:3|max:30',
                        'reference' => 'nullable|unique:clients|min:1|max:30',
                        
                        'interlocuteur' => 'nullable|min:2',
                        'forme_juridique' => 'nullable|min:2',
                        'numero_identifie' => 'nullable|min:2',
                        'domaine' => 'nullable|min:2',
                        'siege_social' => 'nullable|min:2',
                        'genre' => 'nullable|min:4',
                        'naissance' => 'nullable|min:8',
                    ]);
                    
                    
                    // Génération de la référence
                        $nom = $request->nom;
                        $nomFormater = strtoupper(substr(removeAccents($nom), 0, 3));
                        $reference = "411{$nomFormater}";
                    //

                    $client = Client::create([
                        'nom' => $request->nom,
                        'email' => $request->email ,
                        'contact' => $request->contact ,
                        'NCC' => $request->NCC ,
                        'Pachat' => $request->Pachat,
                        'adresse_postale' => $request->adresse_postale,
                        'TC' => $request->TC,
                        'reference' => $reference,
                        'commercial_id' => $commercial->id,
                    ]);

                    $clientinfo = Clientinfo::create([
                        'genre' => $request->genre,
                        'naissance' => $request->naissance,
                        'interlocuteur' => $request->interlocuteur,
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

                    if($client->Pachat)
                    {
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
                'MP' => $request->MP,

                'objet' => $request->objet ,
                'chantier' => $request->chantier ,
                
                'client_id' => $client->id ,
                'commercial_id' => $commercial->id,
                'rgeststock_id' => auth()->user()->id,
            ]);

            $clientdevisinfo = Clientdevisinfo::create([
                'isvalide' => $request->DF,
                'livraison' => 0,
                'livraison_retour' => 0,

                'magasinier' => 0,
                'etat' => null,
                'motif_rejet' => null,

                'debut' => null,
                'fin' => null,
                'clientdevis_id' => $clientdevis->id,
            ]);

            if($request->TD != "0")
            {
                $clientdevisinfo->update([
                    'debut' => $request->debut,
                    'fin' => $request->fin,
                ]);
            }

            $noms = $client->nom ;
                
            if($request->TD == "2")
            {
                return redirect()->route('geststock.commercial.facture.client.prestation.deux', compact('clientdevis'))->with('success', "$noms : $commande ajouté avec succès");
            }
            return redirect()->route('geststock.commercial.facture.client.create.deux', compact('clientdevis'))->with('success', "$noms : $commande ajouté avec succès");
        }
        public function geststockFactureClientCreateDeux(Clientdevis $clientdevis)
        {
            return view('dashboard.geststock.commercial.facture.add-facture-client-deux', compact('clientdevis'));
        }
        public function geststockFactureClientPrestationDeux(Clientdevis $clientdevis)
        {
            return view('dashboard.geststock.commercial.facture.add-facture-client-prestation', compact('clientdevis'));
        }


        public function geststockFactureClientStoreDeux(Request $request, Clientdevis $clientdevis, Produit $produit)
        {
            dd(1);
            foreach($clientdevis->clientdevisprods as $clientdevisprod)
            {
                if($clientdevisprod->produit->id == $produit->id)
                {
                    return back()->with('success', "Le produit $produit->nom à déjà été ajouté à cet devis");
                }
            }
            
            if($request->quantite > $produit->qtyStock)
            {                    
                return back()->with('success', "Desolé! La quantité choisi est superieur au stock restant du produit $produit->nom");
                // dd($request->qtyStock);
            }

            //validate
                $this->validate($request, [
                    'quantite'   => 'required|min:1',
                ]);

                $nbre_jour = null;
                $NJC = 1;
                if($produit->TP)
                {
                    $this->validate($request, [
                        'nbre_jour'   => 'required|min:1',
                    ]);
                    
                    $nbre_jour = $request->nbre_jour;
                    $NJC = $request->nbre_jour;
                }
            //
            
            //données
                $prix = $produit->prix;

                if(!empty($request->remise))
                {
                    // $this->validate($request, [
                    //     'remise'   => 'required|min:1|max:100',
                    // ]);

                    $request->validate([
                        'remise' => ['nullable', 'numeric'], 
                    ], [
                        'remise.numeric'  => 'La remise doit être un nombre entier ou décimal valide.',
                    ]);

                    // Ici : remise peut être null ou un nombre (int/float)
                    $remise = $request->input('remise'); 
                    
                    //données
                        $date = date('d/m/Y H:i');
                        $prixNA = $produit->prix - ($remise * ($produit->prix/100));
                        $prixR = round($prixNA);
                        $prix = (int)($prixR);
                    //
                }

                $prix_total = $request->quantite * $prix * $NJC;
                $total_ttc = $clientdevis->total_ttc + $prix_total;

                $timbre_montant = MontantTimbre($total_ttc) ;

                $tva = (int)($total_ttc * (18/100));

                $total_payer = $tva + $clientdevis->frais + $total_ttc - $clientdevis->timbre_montant + $timbre_montant;
            //

            // dd($prix_total, $total_ttc, $clientdevis->total_ttc);
            // dd($prix_total, $total_ttc, $clientdevis->total_ttc);

            if(!$clientdevis->survolepf)
            {
                if($clientdevis->client->Pachat)
                {
                    $clientdevisTTC = ClientCommandeImpaye($clientdevis->client);
                    if (($prix_total + $clientdevisTTC) > $clientdevis->client->Pachat) {
                        return back()->with('error', "Ce client dépasse son plafond d'achat autorisé.");
                    }
                }
            }

            $clientdevisprod = Clientdevisprod::create([
                'quantite' => $request->quantite ,
                'nbre_jour' => $nbre_jour ,
                'prix_unitaire' => $produit->prix ,
                'prix_total' => $prix_total,
                'clientdevis_id' => $clientdevis->id,
                'produit_id' => $produit->id ,
            ]);

            $clientdevis->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
                'total_payer' => $total_payer ,
                'timbre_montant' => $timbre_montant,
            ]);

            if(!empty($request->remise))
            {
                $clientdevisremise = Clientdevisremise::create([
                    'date' => $date ,
                    'remise' => $request->remise,
                    'prix_remise' => $prix ,
                    'TR' => 1 ,
                    'clientdevis_id' => null,
                    'clientdevisprod_id' => $clientdevisprod->id,
                ]);
            }

            $noms = $clientdevis->client->nom ;               
            return back()->with('success', "Produit $produit->nom Ajouté à $noms avec succès");
        }

        public function geststockFactureClientProduitQtyUpdate(Request $request, Clientdevisprod $clientdevisprod)
        {
            $this->validate($request, [
                'quantite'   => 'required|min:1',
            ]);

            //données
                $noms = $clientdevisprod->produit->nom;

                $prix = $clientdevisprod->prix_unitaire;

                if(!empty($request->remise))
                {
                    $this->validate($request, [
                        'remise'   => 'required|min:1|max:100',
                    ]);

                    //données
                        $date = date('d/m/Y H:i');
                        $prixNA = $clientdevisprod->produit->prix - ($request->remise * ($clientdevisprod->produit->prix/100));
                        $prix = round($prixNA);
                    //

                    $prixRemise = (int)(round($request->quantite * ($request->remise * ($clientdevisprod->produit->prix/100))));
                    if(!auth()->user()->role)
                    {
                        if(auth()->user()->premise < $prixRemise)
                        {
                            return back()->with('success', "Desolé! Votre plafond de remise est inferieur à la remise appliquée sur ce produit.");
                        }
                    }
                }

                if($clientdevisprod->clientdevisremise)
                {
                    $this->validate($request, [
                        'remise'   => 'required|min:1|max:100',
                    ]);

                    $prix = $clientdevisprod->clientdevisremise->prix_remise;

                    $prixRemise = (int)(round($request->quantite * ($request->remise * ($prix/100))));
                    if(!auth()->user()->role)
                    {
                        $prixRemiseAncien = (int)(round($clientdevisprod->clientdevisremise->prix_remise / (1 - ($clientdevisprod->clientdevisremise->remise))));
                        $authUserRemise = (int)(round(auth()->user()->premise + $prixRemiseAncien));
                        if($authUserRemise < $prixRemise)
                        {
                            return back()->with('success', "Desolé! Votre plafond de remise est inferieur à la remise appliquée sur ce produit.");
                        }
                    }
                }

                // dd($prix);

                $prix_total = $request->quantite * $prix;
                $total_ttc = $clientdevisprod->clientdevis->total_ttc + $prix_total - $clientdevisprod->prix_total;
                $tva = (int)($total_ttc * (18/100));

                $total_payer = $tva + $clientdevisprod->clientdevis->frais + $total_ttc;
            //

            $clientdevisprod->update([
                'quantite' => $request->quantite ,
                'prix_unitaire' => $prix ,
                'prix_total' => $prix_total,
            ]);

            $clientdevisprod->clientdevis->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
                'total_payer' => $total_payer ,
            ]);
            
            if($clientdevisprod->clientdevisremise)
            {
                if($clientdevisprod->clientdevisremise->TR)
                {
                    $clientdevisprod->clientdevisremise->update([
                        'date' => $date ,
                        'remise' => $request->remise,
                        'prix_remise' => $prix ,
                        'commercial_id' => auth()->user()->id ,
                    ]);

                    if(!auth()->user()->role)
                    {
                        $premiseR = $authUserRemise - $prixRemise;
                        auth()->user()->update([
                            'premise' => $premiseR ,
                        ]);
                    }
                }
            }
            else
            {
                if(!empty($request->remise))
                {
                    $clientdevisremise = Clientdevisremise::create([
                        'date' => $date ,
                        'remise' => $request->remise,
                        'prix_remise' => $prix ,
                        'TR' => 1 ,
                        'clientdevis_id' => null,
                        'clientdevisprod_id' => $clientdevisprod->id,
                        'commercial_id' => auth()->user()->id ,
                    ]); 

                    if(!auth()->user()->role)
                    {
                        $premiseR = auth()->user()->premise - $prixRemise;
                        auth()->user()->update([
                            'premise' => $premiseR ,
                        ]);
                    }
                }
            }
                
            return back()->with('success', "Quantité du produit $noms modifié avec succès");
        }
        public function geststockFactureClientProduitDestroy(Clientdevisprod $clientdevisprod)
        {
            //données
                $produit = $clientdevisprod->produit->nom ;
                $total_ttc = $clientdevisprod->clientdevis->total_ttc - $clientdevisprod->prix_total;
                $tva = (int)($total_ttc * (18/100));

                $total_payer = $tva + $clientdevisprod->clientdevis->frais + $total_ttc;
            //

            //
                if($clientdevisprod->clientdevisremise)
                {
                    if(!auth()->user()->role)
                    {
                        $prixRemiseAncien = (int)(round($clientdevisprod->clientdevisremise->prix_remise / (1 - ($clientdevisprod->clientdevisremise->remise))));
                        $authUserRemise = (int)(round(auth()->user()->premise + $prixRemiseAncien));
                        auth()->user()->update([
                            'premise' => $authUserRemise ,
                        ]);
                    }
                }
            //
            
            $clientdevisprod->clientdevis->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
                'total_payer' => $total_payer ,
            ]);

            $clientdevisprod->delete();

            return back()->with('success', "Produit $produit retiré avec succès");
        }
    //

    //historique
        //client
            public function geststockFactureClientEtablie(Commercial $commercial)
            {
                // $clientdevis = Clientdevis::where('commercial_id', auth()->id())
                //     ->whereHas('clientdevisinfo', function ($query) {
                //         $query->where('isvalide', 0);
                // })->orderBy('updated_at', 'desc')->get();

                $clientdevis = auth()->user()->clientdevis->where('commercial_id', $commercial->id)->orderBy('updated_at', 'desc')->get();

                return view('dashboard.geststock.commercial.facture.etablie.facture-commercial', compact('clientdevis','commercial'));
            }
            public function geststockFactureClientEtablieGenerale()
            {
                // dd(1);
                $clientdevis = auth()->user()->clientdevis()->orderBy('updated_at', 'desc')->get();

                return view('dashboard.geststock.commercial.etablie.facture-generale', compact('clientdevis'));
            }
        //
    //

}
