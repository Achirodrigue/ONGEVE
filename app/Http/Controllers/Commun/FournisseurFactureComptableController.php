<?php

namespace App\Http\Controllers\Commun;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\Fournisseurfct;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Fournisseurfacturecomptable;
use Illuminate\Foundation\Validation\ValidatesRequests;

class FournisseurFactureComptableController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd('ok');
        $this->validate($request, [
            'delai_reglement' => 'required|min:1|max:255',
            'designation' => 'required|min:1|max:255',
            'echeance' => 'required|min:1|max:255',
            // 'versement' => 'nullable|numeric|min:1|max:255',
            'total_payer' => 'required|min:1|max:255',
            'facture' => 'nullable|mimes:png,jpg,jpeg,pdf',
            'bon' => 'nullable|mimes:png,jpg,jpeg,pdf',
            'fournisseur_id' => 'required|min:1',
            'createur' => 'required|min:1',
        ]);

        // if ($request->versement > $request->total_payer)
        // {
        //     return back()->with('error', "Desolé! Le total à payer est inferieur à la somme déjà versé.");       
        // }

        //donnée
            $facture = null;
            $bon = null;
            $date = date('d/m/Y H:i');
            $fournisseur = Fournisseur::findOrFail($request->fournisseur_id);

            $statut = null;
            // if($request->versement)
            // {
            //     if($request->versement === $request->total_payer)
            //     {
            //         $statut = 1;
            //     }
            //     else{ $statut = 2;}

            //     // $fournisseurfct = Fournisseurfct::create([
            //     //     'reference' => null,
            //     //     'montant' => $request->versement,
            //     //     'date' => $date,
            //     //     'description' => null,
            //     //     'decaissement' => $request->decaissement,
            //     //     'fournisseurfacturecomptable_id' => $fournisseurfacturecomptable->id,
            //     // ]);
            // }
        //

        if (!empty($request->file('facture')))
        {
            // if(auth()->user()->photo) { Storage::disk('public')->delete(auth()->user()->photo); }
            $facture = storeImage($request->file('facture'), "FournisseurFactureFichier");
        }
        if (!empty($request->file('bon')))
        {
            $bon = storeImage($request->file('bon'), "FournisseurFactureBon");
        }

        // Génération de la référence
            $nom = strtoupper(substr(removeAccents($fournisseur->nom), 0, 3));
            $contact = strtoupper(substr(removeAccents($fournisseur->contact), 0, 3));
            $lastfacture = Fournisseurfacturecomptable::orderBy('id', 'desc')->first();
            $lastNumber = $lastfacture ? $lastfacture->id : 0;
            $numero_facture = "{$nom}-{$contact}-{$lastNumber}";
        //
        
        $fournisseurfacturecomptable = Fournisseurfacturecomptable::create([
            'numero_facture' => $numero_facture,
            'date' => $date,
            'delai_reglement' => $request->delai_reglement,
            'designation' => $request->designation,
            'echeance' => $request->echeance,
            'statut' => $statut,
            'versement' => null ,//$request->versement,
            'total_payer' => $request->total_payer,
            'facture' => $facture,
            'bon' => $bon,
            'createur' => $request->createur,
            'fournisseur_id' => $fournisseur->id,
        ]);

        $nom = "$fournisseurfacturecomptable->numero_facture ajouté avec succès";

        if($request->createur == 0)
        {
            return redirect()->route('comptable.fournisseur.facture.add.produit', compact('fournisseurfacturecomptable'))->with('success', $nom);
        }else{
            return redirect()->route('geststock.fournisseur.facture.add.produit', compact('fournisseurfacturecomptable'))->with('success', $nom);
        }
        
        // if($statut == null)
        // {
        //     return redirect()->route('comptable.fournisseur.facture.impaye', compact('fournisseur'))->with('success', $nom);
        // }elseif($statut == 1){
        //     return redirect()->route('comptable.fournisseur.facture.paye', compact('fournisseur'))->with('success', $nom);
        // }else{
        //     return redirect()->route('comptable.fournisseur.facture.partielle', compact('fournisseur'))->with('success', $nom);
        // }
    }

    public function edit(Fournisseurfacturecomptable $fournisseurfacturecomptable)  
    {
        // return view('dashboard.comptable.client.edit-client', compact('client'));
    }

    public function update(Request $request, Fournisseurfacturecomptable $fournisseurfacturecomptable)
    {
        //données
            $noms = $fournisseurfacturecomptable->numero_facture ;
            $statut = $fournisseurfacturecomptable->statut ;
            $facture = $fournisseurfacturecomptable->facture ;
            $bon = $fournisseurfacturecomptable->bon ;
        //
        
        $this->validate($request, [
            'delai_reglement' => 'required|min:1|max:255',
            'designation' => 'required|min:1|max:255',
            'echeance' => 'required|min:1|max:255',
            'total_payer' => 'required|min:1|max:255',
            'facture' => 'nullable|mimes:png,jpg,jpeg,pdf',
            'bon' => 'nullable|mimes:png,jpg,jpeg,pdf',
            // 'fournisseur_id' => 'required|min:1',
        ]);

        if ($request->total_payer < $fournisseurfacturecomptable->versement)
        {
            return back()->with('error', "Desolé! Le total à payer est inferieur à la somme déjà versé.");       
        }

        if ($request->total_payer > $fournisseurfacturecomptable->versement && $fournisseurfacturecomptable->versement != null)
        { $statut = 2; }
        if ($request->total_payer == $fournisseurfacturecomptable->versement)
        { $statut = 1; }


        if (!empty($request->file('facture')))
        {
            if($fournisseurfacturecomptable->facture) { Storage::disk('public')->delete($fournisseurfacturecomptable->facture); }
            $facture = storeImage($request->file('facture'), "FournisseurFactureFichier");
        }
        if (!empty($request->file('bon')))
        {
            if($fournisseurfacturecomptable->bon) { Storage::disk('public')->delete($fournisseurfacturecomptable->bon); }
            $bon = storeImage($request->file('bon'), "FournisseurFactureBon");
        }
        
        $fournisseurfacturecomptable->update($request->post());

        $fournisseurfacturecomptable->update([
            'statut' => $statut,
            'facture' => $facture,
            'bon' => $bon,
        ]);
        
        return back()->with('success', "$noms modifié avec succès");
    }

    public function destroy(Fournisseurfacturecomptable $fournisseurfacturecomptable)
    {
        //données
            $noms = $fournisseurfacturecomptable->numero_facture ;
        //
        $fournisseurfacturecomptable->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }

    //Fournisseur facture add produit
        public function fournisseurFactureAddProduitStore(Request $request, Fournisseurfacturecomptable $fournisseurfacturecomptable, Produit $produit)
        {
            // dd("ok");
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
                    ]);
                    
                    //données
                        $date = date('d/m/Y H:i');
                        $prixNA = $produit->prix - ($request->remise * ($produit->prix/100));
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

                $prix_total = $request->quantite * $prix;
                $total_ttc = $clientdevis->total_ttc + $prix_total;
                $tva = (int)($total_ttc * (18/100));

                $total_payer = $tva + $clientdevis->frais + $total_ttc;
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
                'total_payer' => $total_payer ,
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
    //
}
