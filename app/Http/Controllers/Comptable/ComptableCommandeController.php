<?php

namespace App\Http\Controllers\Comptable;

use App\Models\Client;
use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Models\Clientdevisavoir;
use App\Models\Particulierdevis;
use App\Http\Controllers\Controller;
use App\Models\Clientdevisavoirprod;
use App\Models\Clientdevistransaction;
use Illuminate\Support\Facades\Storage;
use App\Models\Clientdevisavoirprestation;

class ComptableCommandeController extends Controller
{
    //client
        public function commandeClientImpaye()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.commande.commande-impaye', compact('clientdevis'));
        }
        public function commandeClientPaye()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.commande.commande-paye', compact('clientdevis'));
        }
        public function commandeClientPartielle()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.commande.commande-partielle', compact('clientdevis'));
        }

        public function commandeClientDetail(Clientdevis $clientdevis)
        {
            return view('dashboard.comptable.commande.commande-detail', compact('clientdevis'));
        }
        public function commandeClientVersement(Clientdevis $clientdevis)
        {
            return view('dashboard.comptable.commande.commande-versement', compact('clientdevis'));
        }
        public function commandeClientTransactionStore(Request $request, Clientdevis $clientdevis)
        {
            $this->validate($request, [
                'reference' => 'required|min:1',
                'montant' => 'required|min:1',
                'decaissement' => 'required|min:1',
            ]);

            //données
                $noms = $clientdevis->client->nom ;
                $versement = $clientdevis->versement + $request->montant ;
                if($versement == $clientdevis->total_payer) {
                    $statut = 1;
                }else{
                    $statut = 2;
                }

                if($versement > $clientdevis->total_payer) {
                    return back()->with('error', "Desolé! le montant renseillé est superieur au reste à payer.");
                }
            //

            $clientdevistransaction = Clientdevistransaction::create([
                'reference' => $request->reference,
                'montant' => $request->montant,
                'date' => date('d/m/Y H:i'),
                'description' => null,
                'decaissement' => $request->decaissement,
                'clientdevis_id' => $clientdevis->id,
            ]);

            $clientdevis->update([
                'statut' => $statut,
                'versement' => $versement,
            ]);
                
            return redirect()->route('comptable.commande.client.versement', compact('clientdevis'))->with('success', "Nouvelle transaction ajoutée avec succès");
        }













        
        // public function commandeClientImpaye()
        // {
        //     $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
        //         $query->where('etat', null);
        //     })->orderBy('updated_at','desc')->get();
        //     return view('dashboard.comptable.commande.commande-impaye', compact('clientdevis'));
        // }
        
        public function rejetCommandeClientStore(Request $request, Clientdevis $clientdevis)
        {
            $this->validate($request, [
                'motif_rejet' => 'required|min:1',
            ]);

            //données
                $noms = $clientdevis->client->nom ;
            //

            $clientdevis->clientdevisinfo->update([
                'etat' => 2,
                'motif_rejet' => $request->motif_rejet ,
            ]);
                
            return redirect()->route('comptable.commande.client.refuse')->with('success', "$noms : commande rejetée avec succès");
        }     
        public function annulerRejetCommandeClient(Clientdevis $clientdevis)
        {
            //données
                $noms = $clientdevis->client->nom ;
            //

            $clientdevis->clientdevisinfo->update([
                'etat' => null,
                'motif_rejet' => null ,
            ]);
                
            return redirect()->route('comptable.commande.client.encours')->with('success', "$noms : rejet de commande annulé avec succès");
        }
        public function validerCommandeClientStore(Request $request, Clientdevis $clientdevis)
        {
            $this->validate($request, [
                'frais' => 'required|min:1',
                'delai_livraison' => 'required|min:1',
            ]);

            //données
                $noms = $clientdevis->client->nom ;
            //

            $clientdevis->update([
                'frais' => $request->frais,
                'delai_livraison' => $request->delai_livraison,
            ]);

            $clientdevis->clientdevisinfo->update([
                'etat' => 1,
            ]);
                
            return redirect()->route('comptable.commande.client.valide')->with('success', "$noms : commande validée avec succès");
        }
    //

    //client avoir
        //etablir un avoir
            public function commandeClientAvoir(Clientdevis $clientdevis)  
            {
                return view('dashboard.comptable.commande.avoir.etablir', compact('clientdevis'));
            }
            /*
                public function commandeClientAvoirStore(Request $request, Clientdevis $clientdevis)
                {
                    //verify all input
                        // $n = 0;
                        // foreach($clientdevis->clientdevisprods as $clientdevisprod)
                        // {
                        //     if(empty($request->{"qty".$clientdevisprod->id})) 
                        //     {
                        //         $n++;
                        //     }
                        // }
                        // if($n == $clientdevis->clientdevisprods->count()) 
                        // {
                        //     return back()->with('success', "Desolé! Veillez appliquer un avoir sur au moins un produit");    
                        // }
                        $emptyCount = collect($clientdevis->clientdevisprods)
                            ->filter(fn($prod) => empty($request->{"qty".$prod->id}))
                            ->count();

                        if ($emptyCount === $clientdevis->clientdevisprods->count()) {
                            return back()->with('success', "Désolé ! Veuillez appliquer un avoir sur au moins un produit");
                        }

                    //
                    dd(5);
                    //données
                        $tva = null;
                        $airsiMontant = null;
                        $total_ttc = null;
                    //
                    dd($request->all());

                    // Génération du numero de devis
                        $nom = strtoupper(substr(removeAccents($clientdevis->client->nom), 0, 3));
                        $contact = strtoupper(substr(removeAccents($clientdevis->client->contact), 0, 3));
                        $lastClientdevis = Clientdevisavoir::orderBy('id', 'desc')->first();
                        $lastNumber = $lastClientdevis ? $lastClientdevis->id : 0;
                        $numero_devis = "{$nom}-{$contact}-{$lastNumber}";
                    //

                    $clientdevisavoir = Clientdevisavoir::create([
                        'numero_devis' => $numero_devis ,
                        'numero_facture' => null ,
                        'tva' => $tva ,
                        'airsi_montant' => $airsiMontant ,
                        'total_ttc' => $total_ttc ,
                        'total_payer' => null ,
                        'clientdevis_id' => $clientdevis->id ,
                    ]);

                    foreach($clientdevis->clientdevisprods as $clientdevisprod)
                    {
                        if(!empty($request->{"qty".$clientdevisprod->id})) 
                        {
                            $this->validate($request, [
                                "qty$clientdevisprod->id" => 'required|min:1|max:'.$clientdevisprod->quantite.'',
                            ]);

                            $qty = $request->{"qty".$clientdevisprod->id};
                            $prix_total = $qty * $clientdevisprod->prix_unitaire;

                            $clientdevisavoirprod = Clientdevisavoirprod::create([
                                'quantite' => $qty,
                                'prix_total' => $prix_total ,
                                'clientdevisavoir_id' => $clientdevisavoir->id ,
                                'clientdevisprod_id' => $clientdevisprod->id,
                            ]);

                            $total_ttc = $prix_total + $total_ttc;
                        }
                    }
                    
                    //donées
                        $tva = round($total_ttc * (18/100));
                        $airsiMontant = $total_ttc * ($clientdevis->airsi/100); //des fois 1% 5% 3% en fonction de la tva
                        $total_payer = $prix_total + $tva + $airsiMontant;
                    //

                    $clientdevisavoir->update([
                        'tva' => $tva ,
                        'airsi_montant' => $airsiMontant ,
                        'total_ttc' => $total_ttc ,
                        'total_payer' => $total_payer ,
                    ]);

                    return redirect()->route('comptable.commande.client.all.avoir', compact('clientdevis'))->with('success', "Facture ajouté et envoyé au service comptable avec succès");
                }
            */
            public function commandeClientAvoirStore(Request $request, Clientdevis $clientdevis)
            {
                // Vérifier qu'au moins une quantité a été saisie
                    if($clientdevis->TDF != 2)
                    {
                        $emptyCount = collect($clientdevis->clientdevisprods)
                            ->filter(fn($prod) => empty($request->input("qty{$prod->id}")))
                            ->count();

                        if ($emptyCount === $clientdevis->clientdevisprods->count()) {
                            return back()->with('success', "Désolé ! Veuillez appliquer un avoir sur au moins un produit");
                        }
                    }
                    else
                    {
                        $emptyCount = collect($clientdevis->clientdevisprestations)
                            ->filter(fn($prod) => empty($request->input("qty{$prod->id}")))
                            ->count();

                        if ($emptyCount === $clientdevis->clientdevisprestations->count()) {
                            return back()->with('success', "Désolé ! Veuillez appliquer un avoir sur au moins une prestation");
                        }
                    }
                //

                // Initialisation des variables
                $tva = 0;
                $airsiMontant = 0;
                $total_ttc = 0;

                // Génération du numéro de devis avoir
                $nom = strtoupper(substr(removeAccents($clientdevis->client->nom), 0, 3));
                $contact = strtoupper(substr(removeAccents($clientdevis->client->contact), 0, 3));
                $lastClientdevis = Clientdevisavoir::latest()->first();
                $lastNumber = $lastClientdevis ? $lastClientdevis->id + 1 : 1;
                $numero_devis = "AVR-{$nom}-{$contact}-{$lastNumber}";

                // Création du devis avoir
                $clientdevisavoir = Clientdevisavoir::create([
                    'numero_devis' => $numero_devis,
                    'numero_facture' => null,
                    'tva' => $tva,
                    'airsi_montant' => $airsiMontant,
                    'total_ttc' => $total_ttc,
                    'total_payer' => null,
                    'clientdevis_id' => $clientdevis->id,
                ]);

                // Parcourir les produits et créer les lignes d'avoir
                    if($clientdevis->TDF != 2)
                    {
                        foreach ($clientdevis->clientdevisprods as $clientdevisprod) {
                            $qtyInput = $request->input("qty{$clientdevisprod->id}");

                            if (!empty($qtyInput)) {
                                // Validation individuelle
                                $this->validate($request, [
                                    "qty{$clientdevisprod->id}" => 'required|numeric|min:1|max:' . $clientdevisprod->quantite,
                                ]);

                                $qty = (int) $qtyInput;
                                $prix_unitaire = $clientdevisprod->prix_unitaire;
                                if($clientdevisprod->clientdevisremise && $clientdevisprod->clientdevisremise->TR)
                                {
                                  $prix_unitaire = $clientdevisprod->clientdevisremise->prix_remise ;
                                }
                                $prix_total = $qty * $prix_unitaire;

                                Clientdevisavoirprod::create([
                                    'quantite' => $qty,
                                    'prix_total' => $prix_total,
                                    'clientdevisavoir_id' => $clientdevisavoir->id,
                                    'clientdevisprod_id' => $clientdevisprod->id,
                                ]);

                                $total_ttc += $prix_total;
                            }
                        }
                    }
                    else
                    {
                        $emptyCount = collect($clientdevis->clientdevisprestations)
                            ->filter(fn($prod) => empty($request->input("qty{$prod->id}")))
                            ->count();

                        if ($emptyCount === $clientdevis->clientdevisprestations->count()) {
                            return back()->with('success', "Désolé ! Veuillez appliquer un avoir sur au moins une prestation");
                        }

                        foreach ($clientdevis->clientdevisprestations as $clientdevisprestation) {
                            $qtyInput = $request->input("qty{$clientdevisprestation->id}");

                            if (!empty($qtyInput)) {
                                // Validation individuelle
                                $this->validate($request, [
                                    "qty{$clientdevisprestation->id}" => 'required|numeric|min:1|max:' . $clientdevisprestation->nbre_passage,
                                ]);

                                $qty = (int) $qtyInput;
                                $prix_total = $qty * $clientdevisprestation->prix_unitaire;

                                Clientdevisavoirprestation::create([
                                    'quantite' => $qty,
                                    'prix_total' => $prix_total,
                                    'clientdevisavoir_id' => $clientdevisavoir->id,
                                    'clientdevisprestation_id' => $clientdevisprestation->id,
                                ]);

                                $total_ttc += $prix_total;
                            }
                        }
                    }
                //

                // Calcul TVA et AIRSI
                $tva = round($total_ttc * (18 / 100));
                $airsiMontant = round($total_ttc * ($clientdevis->airsi / 100));
                $total_payer = $total_ttc + $tva + $airsiMontant; // + $clientdevis->timbre;

                // Mise à jour du devis avoir
                $clientdevisavoir->update([
                    'tva' => $tva,
                    'airsi_montant' => $airsiMontant,
                    'total_ttc' => $total_ttc,
                    'total_payer' => $total_payer,
                ]);

                return redirect()
                    ->route('comptable.commande.client.all.avoir', compact('clientdevis'))
                    ->with('success', "Facture ajoutée et envoyée au service comptable avec succès");
            }
        //
        //details avoir
            public function commandeClientAllFactureAvoir(Clientdevis $clientdevis)  
            {
                return view('dashboard.comptable.commande.avoir.all-avoir', compact('clientdevis'));
            }
            public function commandeClientAvoirDetail(Clientdevisavoir $clientdevisavoir)  
            {
                // dd($clientdevisavoir->numero_devis);
                return view('dashboard.comptable.commande.avoir.detail-avoir', compact('clientdevisavoir'));
            }
        //
        //modifier un avoir
            public function commandeClientAvoirEdit(Clientdevis $clientdevis)  
            {
                return view('dashboard.comptable.commande.avoir.editer', compact('clientdevis'));
            }
        //
        //supprimer un avoir
            public function commandeAvoirDestroy(Clientdevisavoir $clientdevisavoir)
            {
                if($clientdevisavoir->facturefneavoir)
                {
                    return back()->with('success', "Desolé! Impossible de supprimé cet avoir");
                }
                //données
                    $noms = $clientdevisavoir->numero_devis ;
                //
                $clientdevisavoir->delete();
                return back()->with('success', "$noms supprimé avec succès");
            }
        //
    //
}
