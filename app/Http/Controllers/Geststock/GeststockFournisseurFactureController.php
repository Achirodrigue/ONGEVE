<?php

namespace App\Http\Controllers\Geststock;

use App\Models\Produit;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\Fournisseurfacture;
use App\Http\Controllers\Controller;
use App\Models\Commercial;
use App\Models\Fournisseurfactureprod;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class GeststockFournisseurFactureController extends Controller
{
    use ValidatesRequests;

    //Complet 
        public function fournisseurConfirmeCreationFacture(Fournisseur $fournisseur)
        {
            //données initiales
                $numero_facture = null;
                $total_ttc = null;
                $tva = null; //18%
                $delai_livraison = null;
                $frais = null;

                $airsi = null;
                $airsi_montant = null;
                $timbre_montant = null;
                $daterecfacture = null;
                $delai_paiement = null ;//$request->delai_paiement

                $total_payer = $tva + $frais + $total_ttc;
            //

            // Génération du numero de devis
                $nom = strtoupper(substr(removeAccents($fournisseur->nom), 0, 3));
                $contact = strtoupper(substr(removeAccents($fournisseur->contact), 0, 3));
                $lastFournisseurfacture = Fournisseurfacture::orderBy('id', 'desc')->first();
                $lastNumber = $lastFournisseurfacture ? $lastFournisseurfacture->id : 0;
                $numero_facture = "{$nom}{$contact}{$lastNumber}";
            //

            //creation
                $fournisseurfacture = Fournisseurfacture::create([
                    'numero_facture' => $numero_facture ,
                    'tva' => $tva ,
                    'frais' => $frais,
                    'total_ttc' => $total_ttc ,
                    'versement' => null ,
                    'total_payer' => $total_payer ,
                    'airsi' => $airsi ,
                    'airsi_montant' => $airsi_montant ,
                    'timbre_montant' => $timbre_montant ,
                    'delai_paiement' => $delai_paiement ,
                    'delai_livraison' => $delai_livraison ,
                    'facture' => null ,
                    'bon' => null ,
                    'archive' => 0 ,
                    'isvalide' => 0 ,
                    'livraison' => 0 ,
                    'fournisseur_id' => $fournisseur->id ,
                    'rgeststock_id' => auth()->user()->id ,
                ]);
            //

            return redirect()->route('geststock.fournisseur.facture.produit', compact('fournisseurfacture'))->with('success', "$fournisseur->nom : facture encours de création avec succès");
        }
        public function fournisseurFactureProduit(Fournisseurfacture $fournisseurfacture)
        {
            return view('dashboard.geststock.fournisseur.facture.creation.add-facture', compact('fournisseurfacture'));
        }
        public function fournisseurFactureAddProduit(Request $request, Fournisseurfacture $fournisseurfacture, Produit $produit)
        {
            foreach($fournisseurfacture->fournisseurfactureprods as $fournisseurfactureprod)
            {
                if($fournisseurfactureprod->produit->id == $produit->id)
                {
                    return back()->with('success', "Le produit $produit->nom à déjà été ajouté à cette facture");
                }
            }

            //validate
                $this->validate($request, [
                    'quantite'   => 'required|min:1',
                    'montant'   => 'required|min:1',
                ]);
            //
            
            //données
                $quantite = $request->quantite;
                $montant = $request->montant;
                $prix_total = $quantite * $montant;

                $total_ttc = $fournisseurfacture->total_ttc + $prix_total;
                $tva = (int)($total_ttc * (18/100));
            //

            $fournisseurfactureprod = Fournisseurfactureprod::create([
                'quantite' => $quantite ,
                'prix_unitaire' => $montant ,
                'prix_total' => $prix_total,
                'produit_id' => $produit->id ,
                'fournisseurfacture_id' => $fournisseurfacture->id,
            ]);

            $fournisseurfacture->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
            ]);

            $noms = $fournisseurfacture->fournisseur->nom ;               
            return back()->with('success', "Produit $produit->nom Ajouté à $noms avec succès");
        }
        public function fournisseurFactureEditProduit(Request $request, Fournisseurfactureprod $fournisseurfactureprod)
        {
            //validate
                $this->validate($request, [
                    'quantite'   => 'required|min:1',
                    'montant'   => 'required|min:1',
                ]);
            //

            //données
                $quantite = $request->quantite;
                $montant = $request->montant;
                $prix_total = $quantite * $montant;

                $total_ttc = $fournisseurfactureprod->fournisseurfacture->total_ttc + $prix_total - $fournisseurfactureprod->prix_total;
                $tva = (int)($total_ttc * (18/100));

                $produit = $fournisseurfactureprod->produit->nom ;
            //

            $fournisseurfactureprod->update([
                'quantite' => $quantite ,
                'prix_unitaire' => $montant ,
                'prix_total' => $prix_total,
            ]);

            $fournisseurfactureprod->fournisseurfacture->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
            ]);
                
            return back()->with('success', "Quantité du produit $produit modifié avec succès");
        }
        public function fournisseurFactureDestroyProduit(Fournisseurfactureprod $fournisseurfactureprod)
        {
            //données
                $produit = $fournisseurfactureprod->produit->nom ;
                $total_ttc = $fournisseurfactureprod->fournisseurfacture->total_ttc - $fournisseurfactureprod->prix_total;
                $tva = (int)($total_ttc * (18/100));
            //
            
            $fournisseurfactureprod->fournisseurfacture->update([
                'total_ttc' => $total_ttc ,
                'tva' => $tva ,
            ]);

            $fournisseurfactureprod->delete();

            return back()->with('success', "Produit $produit retiré avec succès");
        }
    //
    //ressource
        public function edit(Fournisseurfacture $fournisseurfacture)  
        {
            return view('dashboard.geststock.fournisseur-facture.edit-facture', compact('fournisseurfacture'));
        }
        public function update(Request $request, Fournisseurfacture $fournisseurfacture)
        {
            //données
                $noms = $fournisseurfacture->numero_facture ;
                $facture = $fournisseurfacture->facture ;
                $bon = $fournisseurfacture->bon ;
            //

            $this->validate($request, [
                'frais' => 'nullable|min:1',
                'airsi' => 'nullable|min:1|max:100',
                'timbre_montant' => 'nullable|min:1',
                'delai_paiement' => 'nullable|min:2',
                'delai_livraison' => 'nullable|min:2',
                'facture' => 'nullable|mimes:pdf,jpg,jpeg,png',
                'bon' => 'nullable|mimes:pdf,jpg,jpeg,png',
            ]);

            //calcul à faire
                $airsiCalcul = ($fournisseurfacture->total_ttc + $fournisseurfacture->tva) * ($request->airsi/100); //des fois 1% 5% 3% en fonction de la tva
                $airsiMontant = round($airsiCalcul);
                if(empty($request->airsi)) {$airsiMontant = null;}
            //
            
            //facture et bon
                if(!empty($request->facture))
                {
                    if($fournisseurfacture->facture){ Storage::disk('public')->delete($fournisseurfacture->facture); }
                    $facture = storeImage($request->file('facture'), "FournisseurFactureFichier");
                }

                if(!empty($request->bon))
                {
                    if($fournisseurfacture->bon){ Storage::disk('public')->delete($fournisseurfacture->bon); }
                    $bon = storeImage($request->file('bon'), "FournisseurFactureFichier");
                }
            //

            //modification
                $fournisseurfacture->update([
                    'frais' => $request->frais,
                    'airsi' => $request->airsi ,
                    'airsi_montant' => $airsiMontant ,
                    'timbre_montant' => $request->timbre_montant ,
                    'delai_paiement' => $request->delai_paiement ,
                    'delai_livraison' => $request->delai_livraison ,
                    'facture' => $facture ,
                    'bon' => $bon ,
                ]);
            //
            
            return back()->with('success', "$noms modifié avec succès");
        }
        public function destroy(Fournisseurfacture $fournisseurfacture)
        {
            //données
                $noms = $fournisseurfacture->numero_facture ;
            //
            if($fournisseurfacture->facture){ Storage::disk('public')->delete($fournisseurfacture->facture); }
            if($fournisseurfacture->bon){ Storage::disk('public')->delete($fournisseurfacture->bon); }

            $fournisseurfacture->delete();
            return back()->with('success', "$noms supprimé avec succès");
        }
    //
    //facture
        //fournisseur
            public function fournisseurFactureReceptionEncours(Fournisseur $fournisseur)
            {
                $fournisseurfactures = $fournisseur->fournisseurfactures->where('livraison', 0)->orderBy('updated_at','desc')->get();
                return view('dashboard.geststock.fournisseur.facture.fns.facture-fns-encours', compact('fournisseur','fournisseurfactures'));
            }
            public function fournisseurFactureReceptionRecu(Fournisseur $fournisseur)
            {
                $fournisseurfactures = $fournisseur->fournisseurfactures->where('livraison', 1)->orderBy('updated_at','desc')->get();
                return view('dashboard.geststock.fournisseur.facture.fns.facture-fns-recu', compact('fournisseur','fournisseurfactures'));
            }
        //
        //generale
            public function generaleFournisseurFactureReceptionEncours()
            {
                $fournisseurfactures = Fournisseurfacture::where('livraison', 0)->orderBy('updated_at','desc')->get();
                return view('dashboard.geststock.fournisseur.facture.gnr.facture-gnr-encours', compact('fournisseurfactures'));
            }
            public function generaleFournisseurFactureReceptionRecu()
            {
                $fournisseurfactures = Fournisseurfacture::where('livraison', 1)->orderBy('updated_at','desc')->get();
                return view('dashboard.geststock.fournisseur.facture.gnr.facture-gnr-recu', compact('fournisseurfactures'));
            }
            public function generaleFournisseurFactureReceptionValide()
            {
                $fournisseurfactures = Fournisseurfacture::where('livraison', 1)->where('isvalide', 1)->orderBy('updated_at','desc')->get();
                return view('dashboard.geststock.fournisseur.facture.gnr.facture-gnr-valide', compact('fournisseurfactures'));
            }
        //
    //
    //confirme reception et conformité
        public function fournisseurFactureConfirmeReception(Fournisseurfacture $fournisseurfacture)
        {
            //données
                $message = "Confirmation de la reception de la facture $fournisseurfacture->numero_facture du fournisseur ".$fournisseurfacture->fournisseur->nom." effectuée avec succès" ;
                if($fournisseurfacture->livraison){
                    $message = "Annulation de la confirmation de reception de la facture $fournisseurfacture->numero_facture du fournisseur ".$fournisseurfacture->fournisseur->nom;
                }
            //

            //modification
                $fournisseurfacture->update([
                    'livraison' => !$fournisseurfacture->livraison,
                ]);
            //
            
            return back()->with('success', $message);
        }
        public function fournisseurFactureConfirmeConformite(Fournisseurfacture $fournisseurfacture)
        {
            //données
                $message = "Conformité de la facture $fournisseurfacture->numero_facture du fournisseur ".$fournisseurfacture->fournisseur->nom." approuvée avec succès" ;
                if($fournisseurfacture->isvalide){
                    $message = "Annulation de la conformité de la facture $fournisseurfacture->numero_facture du fournisseur ".$fournisseurfacture->fournisseur->nom;
                }
            //

            //modification
                $fournisseurfacture->update([
                    'isvalide' => !$fournisseurfacture->isvalide,
                    'livraison' => 1,
                ]);
            //
            
            //modification qty produit
                //modification 
                    /*
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
                    
                        $fournisseurfacture->update([
                            'frais' => $request->frais,
                            'airsi' => $request->airsi ,
                            'airsi_montant' => $airsiMontant ,
                            'timbre_montant' => $request->timbre_montant ,
                            'delai_paiement' => $request->delai_paiement ,
                            'delai_livraison' => $request->delai_livraison ,
                            'facture' => $facture ,
                            'bon' => $bon ,
                        ]);
                    */
                //

                $fournisseurfacture->produit->update([
                    'frais' => $request->frais,
                    'airsi' => $request->airsi ,
                    'airsi_montant' => $airsiMontant ,
                    'timbre_montant' => $request->timbre_montant ,
                    'delai_paiement' => $request->delai_paiement ,
                    'delai_livraison' => $request->delai_livraison ,
                    'facture' => $facture ,
                    'bon' => $bon ,
                ]);
            //
            
            return back()->with('success', $message);
        }
    //



    public function fournisseurFacture(Fournisseur $fournisseur)
    {
        return view('dashboard.geststock.fournisseur-facture.fournisseur-facture', compact('fournisseur'));
    }

    public function fournisseurFactureDetail(Fournisseurfacture $fournisseurfacture)
    {
        return view('dashboard.geststock.fournisseur-facture.fournisseur-facture-detail', compact('fournisseurfacture'));
    }

    public function fournisseurFactureCreate(Fournisseur $fournisseur, $produit)
    {
        // dd($produit);

        return view('dashboard.geststock.fournisseur-facture.add-facture', compact('fournisseur','produit'));
    }

    public function fournisseurFactureStore(Request $request, Fournisseur $fournisseur)
    {
        $this->validate($request, [
            'produit' => 'required|min:1',
            'fournisseur' => 'required',
        ]);

        $produit = $request->produit ;
        $fournisseur = $request->fournisseur ;
        return redirect()->route('geststock.fournisseur.facture.create', compact('fournisseur','produit'));
    }
    public function fournisseurFactureStoreAdd(Request $request, Fournisseur $fournisseur, $produit)
    {
        for($i=1 ; $i <= $produit ; $i++)
        {
            $this->validate($request, [
                "nomProduit$i" => 'required',
                "quantiteProduit$i" => 'required|min:1',
                "prixProduit$i" => 'required|min:1',
            ]);
        }

        //données
            // $i = 2;
            // dd($fournisseur->id);
            //

            //numero_facture
                $facture = "FAC";
                $contact = strtoupper(substr(removeAccents($fournisseur->contact), 0, 3));
                $lastFacture = Fournisseurfacture::orderBy('id', 'desc')->first();
                $lastNumber = $lastFacture ? (int) substr($lastFacture->numero_facture, -3) : 0;
                $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
                $numero_facture = "{$facture}-{$contact}-{$newNumber}";
            //
            //total ttcfor($i=1 ; $i <= $produit ; $i++)
                $total_ttc = 0 ;
                for($i=1 ; $i <= $produit ; $i++)
                {
                    $prix_total = $request->{"quantiteProduit".$i} * $request->{"prixProduit".$i} ;
                    $total_ttc += $prix_total ;
                }
            //
        //

        $fournisseurfacture = Fournisseurfacture::create([
            'numero_facture' => $numero_facture,
            'total_ttc' => $total_ttc ,
            'isvalide' => 0 ,
            'fournisseur_id' => $fournisseur->id,
            'geststock_id' => auth()->user()->id,
        ]);

        for($i=1 ; $i <= $produit ; $i++)
        {
            $prix_total = $request->{"quantiteProduit".$i} * $request->{"prixProduit".$i} ;
            $fournisseurfactureprod = Fournisseurfactureprod::create([
                'produit' => $request->{"nomProduit".$i},
                'quantite' => $request->{"quantiteProduit".$i} ,
                'prix_unitaire' => $request->{"prixProduit".$i} ,
                'prix_total' => $prix_total,
                'fournisseurfacture_id' => $fournisseurfacture->id,
            ]);
        }

        return redirect()->route('geststock.fournisseur.facture.invalide')->with('success', "Facture ajouté et envoyé au service comptable avec succès");

    }
 
    public function fournisseurFactureValide()
    {
        $fournisseurfactures = Fournisseurfacture::where('isvalide', 1)->orderBy('updated_at','desc')->get();
        return view('dashboard.geststock.fournisseur-facture.etat.facture-valide', compact('fournisseurfactures'));
    }
    public function fournisseurFactureInvalide()
    {
        // dd(5);
        $fournisseurfactures = Fournisseurfacture::where('isvalide', 0)->orderBy('updated_at','desc')->get();
        return view('dashboard.geststock.fournisseur-facture.etat.facture-invalide', compact('fournisseurfactures'));
    }
}
