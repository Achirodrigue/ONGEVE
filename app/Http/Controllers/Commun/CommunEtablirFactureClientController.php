<?php

namespace App\Http\Controllers\Commun;

use App\Models\Produit;
use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Models\Clientdevisprod;
use App\Models\Clientdevisremise;
use App\Http\Controllers\Controller;
use App\Models\Clientdevisprestation;
use App\Models\Clientdevisfraisdetail;
use Illuminate\Support\Facades\Schema;

class CommunEtablirFactureClientController extends Controller
{
    //facture client
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

                $timbre_montant = $clientdevis->MP == "Espèce" ? MontantTimbre($total_ttc) : null ;

                $tva = null;
                if($clientdevis->apptva)
                {
                    $tva = round($total_ttc * (18/100));
                }

                $total_payer = $tva + $clientdevis->frais + $total_ttc - $clientdevis->timbre_montant + $timbre_montant;
            //

            //plafond
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
            //

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
                    
                        // if($clientdevisprod->clientdevisremise)
                        // {
                        //     $this->validate($request, [
                        //         'remise'   => 'required|min:1|max:100',
                        //     ]);

                        //     $prix = $clientdevisprod->clientdevisremise->prix_remise;
                        // }
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

                $tva = null;
                if($clientdevisprod->clientdevis->apptva)
                {
                    $tva = round($total_ttc * (18/100));
                }

                $timbre_montant = $clientdevisprod->clientdevis->MP == "Espèce" ? MontantTimbre($total_ttc) : null ;

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
                    ]); 
                }
            }
                
            return back()->with('success', "Quantité du produit $noms modifié avec succès");
        }
        
        public function factureProduitDestroy(Clientdevisprod $clientdevisprod)
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
            
            $clientdevisprod->clientdevis->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
                'total_payer' => $total_payer ,
                'timbre_montant' => $timbre_montant,
            ]);

            $clientdevisprod->delete();

            return back()->with('success', "Produit $produit retiré avec succès");
        }

        //survole pfafond d'achat
            public function ClientdevisSurvolePlafondAchat(Clientdevis $clientdevis)
            {
                $clientdevis->update([
                    'survolepf' => !$clientdevis->survolepf,
                ]);

                $etat = "activé";
                if($clientdevis->survolepf)
                {
                    $etat = "désactivé";
                }
                
                return back()->with('success', "Plafond $etat avec succès.");
            }
        //

        //prestation
            public function clientdevisPrestationStore(Request $request, Clientdevis $clientdevis)
            {
                //validate
                    $this->validate($request, [
                        'designation'   => 'required|min:1',
                        'unite'   => 'nullable|min:1',
                        'nbre_passage'   => 'required|numeric|min:1',
                        // 'quantite'   => 'required|min:1',
                        'prix_unitaire'   => 'required|min:1',
                    ]);
                //

                // dd(5);
                
                //données
                    $prix_unitaire = $request->prix_unitaire;

                    $prix_totals = $request->nbre_passage * $prix_unitaire;
                    $prix_total = round($prix_totals);
                    $total_ttc = $clientdevis->total_ttc + $prix_total;

                    $tva = null;
                    if($clientdevis->apptva)
                    {
                        $tva = round($total_ttc * (18/100));
                    }

                    $timbre_montant = $clientdevis->MP == "Espèce" ? MontantTimbre($total_ttc) : null ;

                    $total_payer = $tva + $clientdevis->frais + $total_ttc - $clientdevis->timbre_montant + $timbre_montant;
                //

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
                //Enlevement de dechets biomedicaux

                // dd($prix_total, $total_ttc, $clientdevis->total_ttc);

                $clientdevisprestation = Clientdevisprestation::create([
                    'designation' => $request->designation ,
                    'unite' => $request->unite ,
                    'nbre_passage' => $request->nbre_passage ,
                    'quantite' => null, //$request->quantite ,
                    'prix_unitaire' => $prix_unitaire ,
                    'prix_total' => $prix_total,
                    'clientdevis_id' => $clientdevis->id,
                ]);

                $clientdevis->update([
                    'total_ttc' => $total_ttc ,
                    'tva' => $tva ,
                    'total_payer' => $total_payer ,
                    'timbre_montant' => $timbre_montant,
                ]);

                $noms = $clientdevis->client->nom ;

                return back()->with('success', "Produit $clientdevisprestation->designation Ajouté à $noms avec succès");
            }
            public function clientdevisPrestationUpdate(Request $request, Clientdevisprestation $clientdevisprestation)
            {
                //validate
                    $this->validate($request, [
                        'designation'   => 'required|min:1',
                        'unite'   => 'nullable|min:1',
                        'nbre_passage'   => 'required|numeric|min:1',
                        // 'quantite'   => 'required|min:1',
                        'prix_unitaire'   => 'required|min:1',
                    ]);
                //

                //données
                    $noms = $clientdevisprestation->designation;
                    $prix_unitaire = $request->prix_unitaire;

                    $prix_totals = $request->nbre_passage * $prix_unitaire;
                    $prix_total = round($prix_totals);
                    $total_ttc = $clientdevisprestation->clientdevis->total_ttc + $prix_total - $clientdevisprestation->prix_total;
                    
                    $tva = null;
                    if($clientdevisprestation->clientdevis->apptva)
                    {
                        $tva = round($total_ttc * (18/100));
                    }

                    $timbre_montant = $clientdevisprestation->clientdevis->MP == "Espèce" ? MontantTimbre($total_ttc) : null ;

                    $total_payer = $tva + $clientdevisprestation->clientdevis->frais + $total_ttc - $clientdevisprestation->clientdevis->timbre_montant + $timbre_montant;
                //

                if(!$clientdevisprestation->clientdevis->survolepf)
                {
                    if($clientdevisprestation->clientdevis->client->Pachat)
                    {
                        $clientdevisTTC = ClientCommandeImpaye($clientdevisprestation->clientdevis->client);
                        if (($prix_total + $clientdevisTTC - $clientdevisprestation->prix_total) > $clientdevisprestation->clientdevis->client->Pachat) {
                            return back()->with('error', "Ce client dépasse son plafond d'achat autorisé.");
                        }
                    }
                }

                $clientdevisprestation->update([
                    'designation' => $request->designation ,
                    'unite' => $request->unite ,
                    'nbre_passage' => $request->nbre_passage ,
                    'quantite' => null, //$request->quantite ,
                    'prix_unitaire' => $prix_unitaire ,
                    'prix_total' => $prix_total,
                ]);

                $clientdevisprestation->clientdevis->update([
                    'total_ttc' => $total_ttc ,
                    'tva' => $tva ,
                    'total_payer' => $total_payer ,
                    'timbre_montant' => $timbre_montant,
                ]);
                    
                return back()->with('success', "Quantité du produit $noms modifié avec succès");
            }
            public function clientdevisPrestationDestroy(Clientdevisprestation $clientdevisprestation)
            {
                //données
                    $noms = $clientdevisprestation->designation ;
                    $total_ttc = $clientdevisprestation->clientdevis->total_ttc - $clientdevisprestation->prix_total;

                    $tva = null;
                    if($clientdevisprestation->clientdevis->apptva)
                    {
                        $tva = round($total_ttc * (18/100));
                    }

                    $timbre_montant = $clientdevisprestation->clientdevis->MP == "Espèce" ? MontantTimbre($total_ttc) : null ;

                    $total_payer = $tva + $clientdevisprestation->clientdevis->frais + $total_ttc - $clientdevisprestation->clientdevis->timbre_montant + $timbre_montant;;
                //
                
                $clientdevisprestation->clientdevis->update([
                    'total_ttc' => $total_ttc ,
                    'tva' => $tva ,
                    'total_payer' => $total_payer ,
                ]);

                $clientdevisprestation->delete();

                return back()->with('success', "Prestation : $noms retiré avec succès");
            }
        //
        
        //prestation de frais detail
            public function clientDevisFraisDetailStore(Request $request, Clientdevis $clientdevis)
            {
                //validate
                    $this->validate($request, [
                        'nom'   => 'required|min:1',
                        'montant'   => 'required|min:1',
                    ]);
                //

                //frais
                    $Mdetailfrais = null;
                    if($clientdevis->clientdevisfraisdetails && $clientdevis->clientdevisfraisdetails->count() > 0)
                    {
                        foreach($clientdevis->clientdevisfraisdetails as $clientdevisfraisdetail)
                        {
                            $Mdetailfrais += $clientdevisfraisdetail->montant;
                        }
                    }
                    if(($Mdetailfrais + $request->montant) > $clientdevis->frais)
                    {
                        return back()->with('error', "Désolé! le total des frais est superieur au frais de la facture");
                    }
                //

                $clientdevisfraisdetail = Clientdevisfraisdetail::create([
                    'nom' => $request->nom ,
                    'montant' => $request->montant ,
                    'clientdevis_id' => $clientdevis->id,
                ]);

                return back()->with('success', "$clientdevisfraisdetail->nom Ajouté avec succès");
            }
            public function clientDevisFraisDetailUpdate(Request $request, Clientdevisfraisdetail $clientdevisfraisdetail)
            {
                //validate
                    $this->validate($request, [
                        'nom'   => 'required|min:1',
                        'montant'   => 'required|min:1',
                    ]);
                //

                $clientdevis = $clientdevisfraisdetail->clientdevis->get();

                //frais
                    $Mdetailfrais = null;
                    if($clientdevis->clientdevisfraisdetails && $clientdevis->clientdevisfraisdetails->count() > 0)
                    {
                        foreach($clientdevis->clientdevisfraisdetails as $clientdevisfraisdetails)
                        {
                            $Mdetailfrais += $clientdevisfraisdetails->montant;
                        }
                    }
                    if(($Mdetailfrais - $clientdevisfraisdetail->montant + $request->montant) > $clientdevis->frais)
                    {
                        return back()->with('error', "Désolé! le total des frais est superieur au frais de la facture");
                    }
                //

                //données
                    $noms = $clientdevisfraisdetail->nom ;
                //
                
                $clientdevisfraisdetail->update($request->post());
                    
                return back()->with('success', "Quantité du produit $noms modifié avec succès");
            }
            public function clientDevisFraisDetailDestroy(Clientdevisfraisdetail $clientdevisfraisdetail)
            {
                //données
                    $noms = $clientdevisfraisdetail->nom ;
                //
                
                $clientdevisfraisdetail->delete();

                return back()->with('success', "Prestation : $noms supprimé avec succès");
            }
        //

        //archive
            public function archiveClientdevis(Clientdevis $clientdevis)
            {
                if(!auth()->user()->role) 
                {
                    return redirect()->route('comptable.home')->with('error',"Désolé! vous n'êtes pas un responsable comptable pour effectuer cette opération");
                } 
                
                $clientdevis->update([
                    'isvalide' => !$clientdevis->archive,
                ]);

                $nom = "retiré des archives";
                $etat = "retiré des archives";
                if($clientdevis->archive)
                {
                    $etat = "archivé";
                }
                
                return back()->with('success', "Facture client de $clientdevis->client->nom $clientdevis->prenom $etat avec succès.");
            }
        //

        //convertir facture en vente, location ou prestation
            public function factureClientConvertir(Request $request, Clientdevis $clientdevis)
            {
                // dd($clientdevis->type);
                if($clientdevis->TDF == null)
                {
                    return redirect()->route('vente.create', ['clientdevis' => $clientdevis->id]);
                }
                elseif($clientdevis->TDF == 1)
                {
                    return redirect()->route('location.create', ['clientdevis' => $clientdevis->id]);
                }
                elseif($clientdevis->TDF == 2)
                {
                    return redirect()->route('prestation.create', ['clientdevis' => $clientdevis->id]);
                }
                else
                {
                    return back()->with('error', "Désolé! le type de cette facture n'est pas défini.");
                }
            }
        //

    //
}
