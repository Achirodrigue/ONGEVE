<?php

namespace App\Http\Controllers\Commercial;

use App\Models\Client;
use App\Models\Produit;
use App\Models\Clientinfo;
use App\Models\Clientdevis;
use App\Models\Particulier;
use App\Models\Clientremise;
use Illuminate\Http\Request;
use App\Models\Clientdevisinfo;
use App\Models\Clientdevisprod;
use App\Models\Particulierdevis;
use App\Models\Clientdevisremise;
use App\Models\Particulierremise;
use App\Http\Controllers\Controller;
use App\Models\Particulierdevisprod;
use Illuminate\Support\Facades\Storage;

class CommercialDevisController extends Controller
{
    //devis client
        public function devisClientCreate()
        {
            return view('dashboard.commercial.devis.client.add-devis-client');
        }
        public function devisClientStore(Request $request)
        {
            $this->validate($request, [
                'client' => 'required|min:1',

                // 'date_expiration' => 'required|min:2',
                // 'condition_validite' => 'required|min:2',
                // 'mode_paiement' => 'required|min:2',
                // 'delai_livraison' => 'required|min:2',
                // 'note_condition' => 'required|min:2',
                // 'frais' => 'required|min:2',
            ]);
            // dd($request->client, $request->clients);

            //données
                $total_ttc = 0;
                $tva = 0; //18%
                $delai_livraison = null;
                $frais = null;
            //

            if($request->client === "Nouveau")
            {
                $this->validate($request, [
                    'nom' => 'required|min:2',
                    'adresse_postale' => 'required|min:2',
                    'contact' => 'required|unique:clients|min:8|max:12',
                    'email' => 'required|email|unique:clients|min:8',
                ]);
                
                $client = Client::create([
                    'nom' => $request->nom,
                    'email' => $request->email ,
                    'contact' => $request->contact ,
                    'Pachat' => $request->Pachat,
                    'adresse_postale' => $request->adresse_postale,
                    'TC' => $request->TC,
                    'commercial_id' => auth()->user()->id,
                ]);

                if($request->TC === "0")
                {
                    $this->validate($request, [
                        'forme_juridique' => 'required|min:2',
                        'numero_identifie' => 'required|min:2',
                        'domaine' => 'required|min:2',
                        'siege_social' => 'required|min:2',
                    ]);

                    $clientinfo = Clientinfo::create([
                        'genre' => null,
                        'naissance' => null,
                        'forme_juridique' => $request->forme_juridique,
                        'numero_identifie' => $request->numero_identifie,
                        'domaine' => $request->domaine,
                        'siege_social' => $request->siege_social,
                        'client_id' => $client->id,
                    ]);
                }else{
                    $this->validate($request, [
                        'genre' => 'required|min:4',
                        'naissance' => 'required|min:8',
                    ]);

                    $clientinfo = Clientinfo::create([
                        'genre' => $request->genre,
                        'naissance' => $request->naissance,
                        'forme_juridique' => null,
                        'numero_identifie' => null,
                        'domaine' => null,
                        'siege_social' => null,
                        'client_id' => $client->id,
                    ]);
                }
            }
            else
            {
                $this->validate($request, [
                    'clients' => 'required|min:1',
                ]);
                $client = Client::findOrfail($request->clients)->first();
            }

            // Génération de la référence
            $nom = strtoupper(substr(removeAccents($client->nom), 0, 3));
            $contact = strtoupper(substr(removeAccents($client->contact), 0, 3));
            $lastClientdevis = Clientdevis::orderBy('id', 'desc')->first();
            $lastNumber = $lastClientdevis ? $lastClientdevis->id : 0;
            $numero_devis = "{$nom}-{$contact}-{$lastNumber}";

            // dd($tva);
            $clientdevis = Clientdevis::create([
                'numero_devis' => $numero_devis ,
                'tva' => $tva ,
                'frais' => $request->frais,
                'total_ttc' => $total_ttc ,
                'delai_livraison' => $request->delai_livraison,
                'remise' => null ,
                'motif' => null ,
                'TD' => $request->TD ,
                'client_id' => $client->id ,
                'commercial_id' => auth()->user()->id,
            ]);

            if($request->TD === "0")
            {
                $clientdevisinfo = Clientdevisinfo::create([
                    'isvalide' => 0,
                    'livraison' => 0,
                    'paye' => 0,
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
                    'isvalide' => 0,
                    'livraison' => 0,
                    'paye' => 0,
                    'etat' => null,
                    'motif_rejet' => null,
                    'debut' => $request->debut,
                    'fin' => $request->fin,
                    'clientdevis_id' => $clientdevis->id,
                ]);
            }

            $noms = $client->nom ;
                
            return redirect()->route('commercial.devis.client.create.deux', compact('clientdevis'))->with('success', "$noms : devis ajouté avec succès");
        }
        public function devisClientCreateDeux(Clientdevis $clientdevis)
        {
            // dd(date('d/m/Y H:i'));
            return view('dashboard.commercial.devis.client.add-devis-client-deux', compact('clientdevis'));
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

            $this->validate($request, [
                'quantite'   => 'required|min:1',
            ]);

            // dd(5);
            
            //données
                $prix = $produit->prix;
                if(!empty($request->remise))
                {
                    $this->validate($request, [
                        'remise'   => 'required|min:1|max:100',
                        'motif'   => 'required|min:10',
                    ]);
                    //données
                        $date = date('d/m/Y H:i');
                        $prixNA = $produit->prix - ($request->remise * ($produit->prix/100));
                        $prixR = round($prixNA);
                        $prix = (int)($prixR);
                    //
                }

                $prix_total = $request->quantite * $prix;
                $total_ttc = $clientdevis->total_ttc + $prix_total;
                $tva = (int)($total_ttc * (18/100));
            //

            // dd($prix_total, $total_ttc, $clientdevis->total_ttc);

            $clientdevisTTC = ClientCommandeImpaye($clientdevis->client);
            if (($prix_total + $clientdevisTTC) > $clientdevis->client->Pachat) {
                return back()->with('message', "Ce client dépasse son plafond d'achat autorisé.");
            }

            $clientdevisprod = Clientdevisprod::create([
                'quantite' => $request->quantite ,
                'unite' => "aucune",
                'prix_unitaire' => $prix ,
                'prix_total' => $prix_total,
                'clientdevis_id' => $clientdevis->id,
                'produit_id' => $produit->id ,
            ]);

            $clientdevis->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
            ]);

            if(!empty($request->remise))
            {
                $clientdevisremise = Clientdevisremise::create([
                    'date' => $date ,
                    'remise' => $request->remise,
                    'prix_remise' => $prix ,
                    'motif' => $request->motif ,
                    'TR' => 1 ,
                    'clientdevis_id' => null,
                    'clientdevisprod_id' => $clientdevisprod->id,
                    'commercial_id' => auth()->user()->id ,
                ]);
            }

            $noms = $clientdevis->client->nom ;               
            return back()->with('success', "Produit $produit->nom Ajouté au devis de $noms avec succès");
        }
        // public function devisProduitPrixUpdate(Request $request, Clientdevisprod $clientdevisprod)
        // {
        //     $this->validate($request, [
        //         'prix' => 'required|min:2',
        //     ]);

        //     $produit->update([
        //         'prix' => $request->prix,
        //     ]);

        //     $noms = $produit->nom;
        //     return back()->with('success', "$noms : prix modifié avec succès");
        // }
        public function devisProduitQtyUpdate(Request $request, Clientdevisprod $clientdevisprod)
        {
            $this->validate($request, [
                'quantite'   => 'required|min:1',
            ]);

            //données
                $noms = $clientdevisprod->produit->nom;

                $prix = $clientdevisprod->prix_unitaire;

                if($clientdevisprod->clientdevisremise)
                {
                    $this->validate($request, [
                        'remise'   => 'required|min:1|max:100',
                        'motif'   => 'required|min:10',
                    ]);

                    $prix = $clientdevisprod->clientdevisremise->prix_remise;
                }

                if(!empty($request->remise))
                {
                    $this->validate($request, [
                        'remise'   => 'required|min:1|max:100',
                        'motif'   => 'required|min:10',
                    ]);

                    //données
                        $date = date('d/m/Y H:i');
                        $prixNA = $clientdevisprod->produit->prix - ($request->remise * ($clientdevisprod->produit->prix/100));
                        $prix = round($prixNA);
                    //
                }

                // dd($prix);

                $prix_total = $request->quantite * $prix;
                $total_ttc = $clientdevisprod->clientdevis->total_ttc + $prix_total - $clientdevisprod->prix_total;
                $tva = (int)($total_ttc * (18/100));
            //

            $clientdevisprod->update([
                'quantite' => $request->quantite ,
                'prix_unitaire' => $prix ,
                'prix_total' => $prix_total,
            ]);

            $clientdevisprod->clientdevis->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
            ]);
            
            if($clientdevisprod->clientdevisremise)
            {
                if($clientdevisprod->clientdevisremise->TR)
                {
                    $clientdevisprod->clientdevisremise->update([
                        'date' => $date ,
                        'remise' => $request->remise,
                        'prix_remise' => $prix ,
                        'motif' => $request->motif ,
                        'commercial_id' => auth()->user()->id ,
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
                        'motif' => $request->motif ,
                        'TR' => 1 ,
                        'clientdevis_id' => null,
                        'clientdevisprod_id' => $clientdevisprod->id,
                        'commercial_id' => auth()->user()->id ,
                    ]); 
                }
            }
                
            return back()->with('success', "Quantité du produit $noms modifié avec succès");
        }
        public function devisProduitDestroy(Clientdevisprod $clientdevisprod)
        {
            //données
                $produit = $clientdevisprod->produit->nom ;
                $total_ttc = $clientdevisprod->clientdevis->total_ttc - $clientdevisprod->prix_total;
                $tva = (int)($total_ttc * (18/100));
            //
            
            $clientdevisprod->clientdevis->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
            ]);

            $clientdevisprod->delete();

            return back()->with('success', "Produit $produit retiré avec succès");
        }
    //

    //devis particulier (entreprise)
        public function devisParticulierCreate()
        {
            return view('dashboard.commercial.devis.particulier.add-devis-particulier');
        }
        public function devisParticulierStore(Request $request)
        {
            $this->validate($request, [
                'client' => 'required|min:1',

                // 'delai_livraison' => 'required|min:2',
                // 'frais' => 'required|min:2',
            ]);
            // dd($request->client, $request->clients);

            //données
                $total_ttc = 0;
                $tva = 0; //18%
                $delai_livraison = null;
                $frais = null;
            //

            if($request->client === "Nouveau")
            {
                $this->validate($request, [
                    'nom' => 'required|min:2',
                    'forme_juridique' => 'required|min:2',
                    'numero_identifie' => 'required|min:2',
                    'domaine' => 'required|min:2',
                    'siege_social' => 'required|min:2',
                    'contact' => 'required|unique:particuliers|min:8|max:12',
                    'email' => 'required|email|unique:particuliers|min:8',
                    'adresse' => 'required|min:2',
                ]);

                $particulier = Particulier::create([
                    'nom' => $request->nom,
                    'forme_juridique' => $request->forme_juridique,
                    'numero_identifie' => $request->numero_identifie,
                    'domaine' => $request->domaine,
                    'siege_social' => $request->siege_social,
                    'contact' => $request->contact ,
                    'email' => $request->email ,
                    'adresse' => $request->adresse,
                    'commercial_id' => auth()->user()->id,
                ]);
            }
            else
            {
                $this->validate($request, [
                    'clients' => 'required|min:1',
                ]);
                $particulier = Particulier::findOrfail($request->clients)->first();
            }
            // dd($request->client, $request->clients);

            // Génération de la référence
            $nom = strtoupper(substr(removeAccents($particulier->nom), 0, 3));
            $email = strtoupper(substr(removeAccents($particulier->email), 0, 3));
            $lastParticulierdevis = Particulierdevis::orderBy('id', 'desc')->first();
            $lastNumber = $lastParticulierdevis ? $lastParticulierdevis->id : 0;
            $numero_devis = "{$nom}-{$email}-{$lastNumber}";
            // dd($tva);
            $particulierdevis = Particulierdevis::create([
                'numero_devis' => $numero_devis ,
                'delai_livraison' => $delai_livraison,
                'tva' => $tva ,
                'total_ttc' => $total_ttc ,
                'frais' => $frais,
                'etat' => null ,
                'isvalide' => 0 ,
                'livraison' => 0 ,
                'paye' => 0 ,
                'motif_rejet' => null ,
                'particulier_id' => $particulier->id ,
                'commercial_id' => auth()->user()->id,
            ]);

            $noms = $particulier->nom ;
                
            return redirect()->route('commercial.devis.particulier.create.deux', compact('particulierdevis'))->with('success', "$noms : devis ajouté avec succès");
        }
        public function devisParticulierCreateDeux(Particulierdevis $particulierdevis)
        {
            return view('dashboard.commercial.devis.particulier.add-devis-particulier-deux', compact('particulierdevis'));
        }
        public function devisParticulierStoreDeux(Request $request, Particulierdevis $particulierdevis, Produit $produit)
        {
            foreach($particulierdevis->particulierdevisprods as $particulierdevisprod)
            {
                if($particulierdevisprod->produit->id == $produit->id)
                {
                    return back()->with('success', "Le produit $produit->nom à déjà été ajouté à cet devis");
                }
            }

            $this->validate($request, [
                'quantite'   => 'required|min:1',
            ]);

            //données
            
            //données
                $prix = $produit->prix;
                if(!empty($request->remise))
                {
                    $this->validate($request, [
                        'remise'   => 'required|min:1|max:100',
                        'motif'   => 'required|min:10',
                    ]);
                    //données
                        $date = date('d/m/Y H:i');
                        $prixNA = $produit->prix - ($request->remise * ($produit->prix/100));
                        $prix = round($prixNA);
                    //
                }

                $prix_total = $request->quantite * $prix;
                $total_ttc = $particulierdevis->total_ttc + $prix_total;
                $tva = (int)($total_ttc * (18/100));
            //

            $particulierdevisTTC = ParticulierCommandeImpaye($particulierdevis->particulier);
            if (($prix_total + $particulierdevisTTC) > $particulierdevis->client->Pachat) {
                return back()->with('error', "Cet entreprise dépasse son plafond d'achat autorisé.");
            }

            $particulierdevisprod = Particulierdevisprod::create([
                'quantite' => $request->quantite ,
                'unite' => "aucune",
                'prix_unitaire' => $prix ,
                'prix_total' => $prix_total,
                'particulierdevis_id' => $particulierdevis->id,
                'produit_id' => $produit->id ,
            ]);

            $particulierdevis->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
            ]);

            if(!empty($request->remise))
            {
                $particulierremise = Particulierremise::create([
                    'date' => $date ,
                    'remise' => $request->remise,
                    'prix_remise' => $prix ,
                    'motif' => $request->motif ,
                    'particulierdevisprod_id' => $particulierdevisprod->id,
                    'commercial_id' => auth()->user()->id ,
                ]);
            }

            $noms = $particulierdevis->particulier->nom ; 
            return back()->with('success', "Produit $produit->nom Ajouté au devis de $noms avec succès");
        }
        public function devisParticulierProduitQtyUpdate(Request $request, Particulierdevisprod $particulierdevisprod)
        {
            $this->validate($request, [
                'quantite'   => 'required|min:1',
            ]);

            //données
                $noms = $particulierdevisprod->produit->nom;

                $prix = $particulierdevisprod->produit->prix;
                if($particulierdevisprod->particulierremise)
                {
                    $this->validate($request, [
                        'remise'   => 'required|min:1|max:100',
                        'motif'   => 'required|min:10',
                    ]);

                    $prix = $particulierdevisprod->particulierremise->prix_remise;
                }

                if(!empty($request->remise))
                {
                    $this->validate($request, [
                        'remise'   => 'required|min:1|max:100',
                        'motif'   => 'required|min:10',
                    ]);

                    //données
                        $date = date('d/m/Y H:i');
                        $prixNA = $particulierdevisprod->produit->prix - ($request->remise * ($particulierdevisprod->produit->prix/100));
                        $prix = round($prixNA);
                    //
                }

                $prix_total = $request->quantite * $prix;
                $total_ttc = $particulierdevisprod->particulierdevis->total_ttc + $prix_total - $particulierdevisprod->prix_total;
                $tva = (int)($total_ttc * (18/100));
            //

            $particulierdevisprod->update([
                'quantite' => $request->quantite ,
                'prix_unitaire' => $prix ,
                'prix_total' => $prix_total,
            ]);

            $particulierdevisprod->particulierdevis->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
            ]);
            
            if($particulierdevisprod->particulierremise)
            {
                $particulierdevisprod->particulierremise->update([
                    'date' => $date ,
                    'remise' => $request->remise,
                    'prix_remise' => $prix ,
                    'motif' => $request->motif ,
                    'particulierdevisprod_id' => $particulierdevisprod->id,
                    'commercial_id' => auth()->user()->id ,
                ]);
            }
            else
            {
                if(!empty($request->remise))
                {
                    $particulierremise = Particulierremise::create([
                        'date' => $date ,
                        'remise' => $request->remise,
                        'prix_remise' => $prix ,
                        'motif' => $request->motif ,
                        'particulierdevisprod_id' => $particulierdevisprod->id,
                        'commercial_id' => auth()->user()->id ,
                    ]); 
                }
            }
                
            return back()->with('success', "Quantité du produit $noms modifié avec succès");
        }
        public function devisParticulierProduitDestroy(Particulierdevisprod $particulierdevisprod)
        {
            //données
                $produit = $particulierdevisprod->produit->nom ;
                $total_ttc = $particulierdevisprod->particulierdevis->total_ttc - $particulierdevisprod->prix_total;
                $tva = (int)($total_ttc * (18/100));
            //
            
            $particulierdevisprod->particulierdevis->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
            ]);

            $particulierdevisprod->delete();

            return back()->with('success', "Produit $produit retiré avec succès");
        }
    //

    //historique
        //client
            public function devisClientEncours()
            {
                $clientdevis = Clientdevis::where('isvalide', 0)->orderBy('updated_at','desc')->get();
                return view('dashboard.commercial.devis.historique.client.devis-encours', compact('clientdevis'));
            }
            public function devisClientFinalite(Clientdevis $clientdevis)
            {
                return view('dashboard.commercial.devis.historique.client.devis-detail', compact(('clientdevis')));
            }
            public function devisClientUpdate(Request $request, Clientdevis $clientdevis)
            {
                $this->validate($request, [
                    'delai_livraison' => 'required|min:2',
                    'frais' => 'required|min:2',
                ]);

                $clientdevis->update([
                    'delai_livraison' => $request->delai_livraison,
                    'frais' => $request->frais,
                ]);

                $noms = $clientdevis->client->nom." ".$clientdevis->client->prenom;
                    
                return back()->with('success', "$noms : devis modifié avec succès");
            }
            public function devisClientDestroy(Clientdevis $clientdevis)
            {
                $noms = $clientdevis->client->nom." ".$clientdevis->client->prenom;
                $clientdevis->delete();
                return back()->with('success', "$noms : devis supprimé avec succès");
            }
            public function devisClientConvertirUpdate(Clientdevis $clientdevis)
            {
                $clientdevis->update([
                    'isvalide' => !$clientdevis->isvalide,
                ]);

                $noms = $clientdevis->client->nom." ".$clientdevis->client->prenom;

                $message = "Devis retiré des commandes avec succes" ;
                if($clientdevis->isvalide)
                {
                    $message = "Devis converti en commande avec succes" ;
                }
                return back()->with('success', "$noms : $message");
            }
        //

        //particulier
            public function devisParticulierEncours()
            {
                $particulierdevis = Particulierdevis::where('isvalide', 0)->orderBy('updated_at','desc')->get();
                return view('dashboard.commercial.devis.historique.particulier.devis-encours', compact('particulierdevis'));
            }
            public function devisParticulierFinalite(Particulierdevis $particulierdevis)
            {
                return view('dashboard.commercial.devis.historique.particulier.devis-detail', compact(('particulierdevis')));
            }
            public function devisPartenaireUpdate(Request $request, Particulierdevis $particulierdevis)
            {
                $this->validate($request, [
                    'delai_livraison' => 'required|min:2',
                    'frais' => 'required|min:2',
                ]);

                $particulierdevis->update([
                    'delai_livraison' => $request->delai_livraison,
                    'frais' => $request->frais,
                ]);

                $noms = $particulierdevis->particulier->nom ;
                    
                return back()->with('success', "$noms : devis modifié avec succès");
            }
            public function devisParticulierDestroy(Particulierdevis $particulierdevis)
            {
                $noms = $particulierdevis->particulier->nom ;
                $particulierdevis->delete();
                return back()->with('success', "$noms : devis supprimé avec succès");
            }
            public function devisParticulierConvertirUpdate(Particulierdevis $particulierdevis)
            {
                $particulierdevis->update([
                    'isvalide' => !$particulierdevis->isvalide,
                ]);

                $noms = $particulierdevis->particulier->nom ;

                $message = "Devis retiré des commandes avec succes" ;
                if($particulierdevis->isvalide)
                {
                    $message = "Devis converti en commande avec succes" ;
                }
                return back()->with('success', "$noms : $message");
            }
        //
    //
}
