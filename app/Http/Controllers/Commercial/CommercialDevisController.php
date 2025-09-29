<?php

namespace App\Http\Controllers\Commercial;

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
use Illuminate\Support\Facades\Storage;

use App\Models\Clientdevisprestation;
use App\Models\Clientdevisfraisdetail;

class CommercialDevisController extends Controller
{
    //devis et facture client
        public function devisClientCreate()
        {
            return view('dashboard.commercial.client-facture.add-facture-client');
        }
        public function devisClientStore(Request $request)
        {
            $this->validate($request, [
                'client' => 'required|min:1',
                'TD' => 'required|min:1',
                'apptva' => 'required|numeric|in:1,0',
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
                $tva = null; //18%
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
                        'commercial_id' => auth()->user()->id,
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
                'apptva' => $request->apptva ,
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
                'commercial_id' => auth()->user()->id,
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
                return redirect()->route('commercial.devis.client.create.deux.prestation', compact('clientdevis'))->with('success', "$noms : $commande ajouté avec succès");
            }
            return redirect()->route('commercial.devis.client.create.deux', compact('clientdevis'))->with('success', "$noms : $commande ajouté avec succès");
        }
        public function devisClientCreateDeux(Clientdevis $clientdevis)
        {
            // dd(date('d/m/Y H:i'));
            return view('dashboard.commercial.client-facture.add-facture-client-deux', compact('clientdevis'));
        }
        public function devisClientCreateDeuxPrestation(Clientdevis $clientdevis)
        {
            return view('dashboard.commercial.client-facture.add-facture-client-prestation', compact('clientdevis'));
        }

        public function devisClientStoreDeux(Request $request, Clientdevis $clientdevis, Produit $produit)
        {
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
                        
                    $prixRemise = (int)(round($request->quantite * ($request->remise * ($produit->prix/100))));
                    if(!auth()->user()->role)
                    {
                        if(auth()->user()->premise < $prixRemise)
                        {
                            return back()->with('success', "Desolé! Votre plafond de remise est inferieur à la remise appliquée sur ce produit.");
                        }
                    }
                }

                $prix_total = $request->quantite * $prix * $NJC;
                $total_ttc = $clientdevis->total_ttc + $prix_total;

                $timbre_montant = $clientdevis->MP == "Espèce" ? MontantTimbre($total_ttc) : null ;

                $tva = null;
                if($clientdevis->apptva)
                {
                    $tva = round($total_ttc * (18/100));
                }

                $total_payer = $tva + $clientdevis->frais + $total_ttc - $clientdevis->timbre_montant + $timbre_montant;
            //

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
            
            $noms = $clientdevis->client->nom ;               
            return back()->with('success', "Produit $produit->nom Ajouté à $noms avec succès");
        }

        public function devisProduitQtyUpdate(Request $request, Clientdevisprod $clientdevisprod)
        {
            //validate
                $this->validate($request, [
                    'quantite'   => 'required|min:1',
                ]);

                $nbre_jour = null;
                $NJC = 1;
                if($clientdevisprod->produit->TP)
                {
                    $this->validate($request, [
                        'nbre_jour'   => 'required|min:1',
                    ]);
                    
                    $nbre_jour = $request->nbre_jour;
                    $NJC = $request->nbre_jour;
                }
            //

            //données
                $noms = $clientdevisprod->produit->nom;

                $prix = $clientdevisprod->prix_unitaire;

                if(!empty($request->remise))
                {
                    $request->validate([
                        'remise' => ['nullable', 'numeric'], 
                    ], [
                        'remise.numeric'  => 'La remise doit être un nombre entier ou décimal valide.',
                    ]);

                    // Ici : remise peut être null ou un nombre (int/float)
                    $remise = $request->input('remise'); 
                    
                    //données
                        $date = date('d/m/Y H:i');
                        $prixNA = $clientdevisprod->produit->prix - ($remise * ($clientdevisprod->produit->prix/100));
                        $prixR = round($prixNA);
                        $prix = (int)($prixR);
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
                
                $tva = null;
                if($clientdevisprod->clientdevis->apptva)
                {
                    $tva = round($total_ttc * (18/100));
                }

                $timbre_montant = $clientdevisprod->clientdevis->MP == "Espèce" ? MontantTimbre($total_ttc) : null ;

                $total_payer = $tva + $clientdevisprod->clientdevis->frais + $total_ttc - $clientdevisprod->clientdevis->timbre_montant + $timbre_montant;
            //

            $clientdevisprod->update([
                'quantite' => $request->quantite ,
                'nbre_jour' => $nbre_jour ,
                'prix_unitaire' => $clientdevisprod->prix_unitaire ,
                'prix_total' => $prix_total,
            ]);

            $clientdevisprod->clientdevis->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
                'total_payer' => $total_payer ,
                'timbre_montant' => $timbre_montant,
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
        public function devisProduitDestroy(Clientdevisprod $clientdevisprod)
        {
            //données
                $produit = $clientdevisprod->produit->nom ;
                $total_ttc = $clientdevisprod->clientdevis->total_ttc - $clientdevisprod->prix_total;

                $tva = null;
                if($clientdevisprod->clientdevis->apptva)
                {
                    $tva = round($total_ttc * (18/100));
                }

                $timbre_montant = $clientdevisprod->clientdevis->MP == "Espèce" ? MontantTimbre($total_ttc) : null ;

                $total_payer = $tva + $clientdevisprod->clientdevis->frais + $total_ttc - $clientdevisprod->clientdevis->timbre_montant + $timbre_montant;
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
    
    //devis client
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
        public function factureClientStoreDeux(Request $request, Clientdevis $clientdevis, Produit $produit)
        {
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

            // dd(auth()->user()->id);
            // dd(5);
            
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
                    // dd(auth()->user()->non);

                    if (auth()->user()->connexion == "commercial") 
                    {
                        // dd('error');

                        if(!auth()->user()->role)
                        {
                            $prixRemise = (int)(round($request->quantite * ($request->remise * ($produit->prix/100))));
                            if(auth()->user()->premise < $prixRemise)
                            {
                                return back()->with('success', "Desolé! Votre plafond de remise est inferieur à la remise appliquée sur ce produit.");
                            }
                        }
                    }

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
                $commercial = null;
                if (auth()->user()->connexion == "commercial") {
                    $commercial = auth()->user()->id ;
                }

                $clientdevisremise = Clientdevisremise::create([
                    'date' => $date ,
                    'remise' => $request->remise,
                    'prix_remise' => $prix ,
                    'TR' => 1 ,
                    'clientdevis_id' => null,
                    'clientdevisprod_id' => $clientdevisprod->id,
                    'commercial_id' => $commercial ,
                ]);

                if (auth()->user()->connexion == "commercial") {
                    if(!auth()->user()->role)
                    {
                        $premiseR = auth()->user()->premise - $prixRemise;
                        auth()->user()->update([
                            'premise' => $premiseR ,
                        ]);
                    }
                }
            }

            $noms = $clientdevis->client->nom ;               
            return back()->with('success', "Produit $produit->nom Ajouté à $noms avec succès");
        }

        public function factureProduitQtyUpdate(Request $request, Clientdevisprod $clientdevisprod)
        {
            //validate
                $this->validate($request, [
                    'quantite'   => 'required|min:1',
                ]);

                $nbre_jour = null;
                $NJC = 1;
                if($clientdevisprod->produit->TP)
                {
                    $this->validate($request, [
                        'nbre_jour'   => 'required|min:1',
                    ]);
                    
                    $nbre_jour = $request->nbre_jour;
                    $NJC = $request->nbre_jour;
                }
            //

            //données
                $noms = $clientdevisprod->produit->nom;

                $prix = $clientdevisprod->prix_unitaire;

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
                        $prixNA = $clientdevisprod->produit->prix - ($remise * ($clientdevisprod->produit->prix/100));
                        $prix = round($prixNA);
                    //
                    
                    if (auth()->user()->connexion == "commercial") {
                        if(!auth()->user()->role)
                        {
                            $prixRemise = (int)(round($request->quantite * ($request->remise * ($clientdevisprod->produit->prix/100))));
                            if(auth()->user()->premise < $prixRemise)
                            {
                                return back()->with('success', "Desolé! Votre plafond de remise est inferieur à la remise appliquée sur ce produit.");
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
                    }
                }

                // dd($prix,$request->remise, ($request->remise * $clientdevisprod->produit->prix) , (($request->remise * $clientdevisprod->produit->prix)/100) , ($clientdevisprod->produit->prix - (($request->remise * $clientdevisprod->produit->prix)/100)));

                // if($clientdevisprod->clientdevisremise)
                // {
                //     $this->validate($request, [
                //         'remise'   => 'required|min:1|max:100',
                //     ]);

                //     $prix = $clientdevisprod->clientdevisremise->prix_remise;
                // }

                // dd($prix);

                $prix_total = $request->quantite * $prix * $NJC;
                $total_ttc = $clientdevisprod->clientdevis->total_ttc + $prix_total - $clientdevisprod->prix_total;
                $tva = (int)($total_ttc * (18/100));

                $timbre_montant = MontantTimbre($total_ttc) ;

                $total_payer = $tva + $clientdevisprod->clientdevis->frais + $total_ttc - $clientdevisprod->clientdevis->timbre_montant + $timbre_montant;
            //

            if(!$clientdevisprod->clientdevis->survolepf)
            {
                if($clientdevisprod->clientdevis->client->Pachat)
                {
                    $clientdevisTTC = ClientCommandeImpaye($clientdevisprod->clientdevis->client);
                    if (($prix_total + $clientdevisTTC - $clientdevisprod->prix_total) > $clientdevisprod->clientdevis->client->Pachat) {
                        return back()->with('error', "Ce client dépasse son plafond d'achat autorisé.");
                    }
                }
            }

            $clientdevisprod->update([
                'quantite' => $request->quantite ,
                'nbre_jour' => $nbre_jour ,
                'prix_unitaire' => $clientdevisprod->prix_unitaire ,
                'prix_total' => $prix_total,
            ]);

            $clientdevisprod->clientdevis->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
                'total_payer' => $total_payer ,
                'timbre_montant' => $timbre_montant,
            ]);
            
            if($clientdevisprod->clientdevisremise)
            {
                if($clientdevisprod->clientdevisremise->TR)
                {
                    $clientdevisprod->clientdevisremise->update([
                        'date' => $date ,
                        'remise' => $request->remise,
                        'prix_remise' => $prix ,
                        // 'commercial_id' => auth()->user()->id ,
                    ]);

                    if (auth()->user()->connexion == "commercial") {
                        if(!auth()->user()->role)
                        {
                            $premiseR = $authUserRemise - $prixRemise;
                            auth()->user()->update([
                                'premise' => $premiseR ,
                            ]);
                        }
                    }
                }
            }
            else
            {
                if(!empty($request->remise))
                { 
                    $commercial = null;
                    if (auth()->user()->connexion == "commercial") {
                        $commercial = auth()->user()->id ;
                    }

                    $clientdevisremise = Clientdevisremise::create([
                        'date' => $date ,
                        'remise' => $request->remise,
                        'prix_remise' => $prix ,
                        'TR' => 1 ,
                        'clientdevis_id' => null,
                        'clientdevisprod_id' => $clientdevisprod->id,
                        'commercial_id' => $commercial ,
                    ]); 

                    if (auth()->user()->connexion == "commercial") {
                        if(!auth()->user()->role)
                        {
                            $premiseR = auth()->user()->premise - $prixRemise;
                            auth()->user()->update([
                                'premise' => $premiseR ,
                            ]);
                        }
                    }
                }
            }
                
            return back()->with('success', "Quantité du produit $noms modifié avec succès");
        }

        public function factureProduitDestroy(Clientdevisprod $clientdevisprod)
        {
            //données
                $produit = $clientdevisprod->produit->nom ;
                $total_ttc = $clientdevisprod->clientdevis->total_ttc - $clientdevisprod->prix_total;
                $tva = (int)($total_ttc * (18/100));

                $timbre_montant = MontantTimbre($total_ttc) ;

                $total_payer = $tva + $clientdevisprod->clientdevis->frais + $total_ttc - $clientdevisprod->clientdevis->timbre_montant + $timbre_montant;
            //

            if (auth()->user()->connexion == "commercial") {
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
            }
            
            $clientdevisprod->clientdevis->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
                'total_payer' => $total_payer ,
                'timbre_montant' => $timbre_montant,
            ]);

            $clientdevisprod->delete();

            return back()->with('success', "Produit $produit retiré avec succès");
        }
    //

    //historique
        //client
            public function devisClientEncours()
            {
                // dd(5);
                if(auth()->user()->role)
                {
                    $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                        $query->where('isvalide', 0);
                    })->orderBy('updated_at','desc')->get();
                }
                else
                {
                    $clientdevis = Clientdevis::where('commercial_id', auth()->id())
                        ->whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 0);
                        })->orderBy('updated_at', 'desc')->get();
                }

                return view('dashboard.commercial.devis.historique.client.devis-encours', compact('clientdevis'));
            }
            public function devisClientFinalite(Clientdevis $clientdevis)
            {
                return view('dashboard.commercial.devis.historique.client.devis-detail', compact(('clientdevis')));
            }
            public function devisClientUpdate(Request $request, Clientdevis $clientdevis)
            {
                //données
                    $noms = $clientdevis->numero_devis ;
                //

                $this->validate($request, [
                    'delai_livraison' => 'nullable|min:2',
                    'frais' => 'nullable|min:2',
                    'fichier' => 'nullable|mimes:pdf,jpg,jpeg,png',
                ]);

                //calcul à faire
                    $total_payer = $clientdevis->total_payer - $clientdevis->frais + $request->frais;
                //

                $clientdevis->update([
                    'frais' => $request->frais,
                    'delai_livraison' => $request->delai_livraison,
                    'total_payer' => $total_payer ,
                ]);

                //bon de commande
                    if(!empty($request->fichier))
                    {
                        if($clientdevis->clientdevisbon)
                        {
                            Storage::disk('public')->delete($clientdevis->clientdevisbon->bon);
                            $bon = storeImage($request->file('fichier'), "ClientDevisBon");
                            
                            $clientdevis->clientdevisbon->update([
                                'bon' => $bon,
                            ]);
                        }
                        else
                        {
                            $bon = storeImage($request->file('fichier'), "ClientDevisBon");
                            
                            Clientdevisbon::create([
                                'bon' => $bon,
                                'note' => null,
                                'etat' => 1,
                                'clientdevis_id' => $clientdevis->id,
                            ]);
                        }
                    }
                //
                
                return back()->with('success', "$noms modifié avec succès");
            }
            public function devisClientDestroy(Clientdevis $clientdevis)
            {
                $noms = $clientdevis->client->nom." ".$clientdevis->client->prenom;
                $clientdevis->delete();
                return back()->with('success', "$noms : devis supprimé avec succès");
            }
            public function devisClientConvertirUpdate(Clientdevis $clientdevis)
            {
                $clientdevis->clientdevisinfo->update([
                    'isvalide' => !$clientdevis->clientdevisinfo->isvalide,
                ]);

                $noms = $clientdevis->client->nom ;

                $message = "Devis retiré des commandes avec succes" ;
                if($clientdevis->clientdevisinfo->isvalide)
                {
                    $message = "Devis converti en commande avec succes" ;
                }
                return back()->with('success', "$noms : $message");
            }
        //
    //
}
