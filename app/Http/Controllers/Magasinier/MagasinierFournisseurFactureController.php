<?php

namespace App\Http\Controllers\Magasinier;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\Fournisseurfacture;
use App\Http\Controllers\Controller;
use App\Models\Fournisseurfactureprod;
use Illuminate\Foundation\Validation\ValidatesRequests;

class MagasinierFournisseurFactureController extends Controller
{
    use ValidatesRequests;
    
    public function edit(Fournisseurfacture $fournisseurfacture)  
    {
        return view('dashboard.magasinier.fournisseur-facture.edit-facture', compact('fournisseurfacture'));
    }

    public function update(Request $request, Fournisseurfacture $fournisseurfacture)
    {
        foreach($fournisseurfacture->fournisseurfactureprods as $fournisseurfactureprod)
        {
            $this->validate($request, [
                "nomProduit$fournisseurfactureprod->id" => 'required',
                "quantiteProduit$fournisseurfactureprod->id" => 'required|min:1',
                "prixProduit$fournisseurfactureprod->id" => 'required|min:1',
            ]);
        }

        //données
            $total_ttc = 0 ;
        //

        foreach($fournisseurfacture->fournisseurfactureprods as $fournisseurfactureprod)
        {
            $prix_total = $request->{"quantiteProduit".$fournisseurfactureprod->id} * $request->{"prixProduit".$fournisseurfactureprod->id} ;
            $fournisseurfactureprod->update([
                'produit' => $request->{"nomProduit".$fournisseurfactureprod->id},
                'quantite' => $request->{"quantiteProduit".$fournisseurfactureprod->id} ,
                'prix_unitaire' => $request->{"prixProduit".$fournisseurfactureprod->id} ,
                'prix_total' => $prix_total,
            ]);
            
            $total_ttc += $prix_total ;
        }

        $fournisseurfacture->update([
            'total_ttc' => $total_ttc ,
            'magasinier_id' => auth()->user()->id,
        ]);

        return redirect()->route('magasinier.fournisseur.facture.invalide')->with('success', "Facture ajouté et envoyé au service comptable avec succès");
    }

    public function destroy(Fournisseurfacture $fournisseurfacture)
    {
        //données
            $noms = $fournisseurfacture->numero_facture ;
        //
        $fournisseurfacture->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }



    public function fournisseurFacture(Fournisseur $fournisseur)
    {
        return view('dashboard.magasinier.fournisseur-facture.fournisseur-facture', compact('fournisseur'));
    }

    public function fournisseurFactureDetail(Fournisseurfacture $fournisseurfacture)
    {
        return view('dashboard.magasinier.fournisseur-facture.fournisseur-facture-detail', compact('fournisseurfacture'));
    }

    public function fournisseurFactureCreate(Fournisseur $fournisseur, $produit)
    {
        // dd($produit);

        return view('dashboard.magasinier.fournisseur-facture.add-facture', compact('fournisseur','produit'));
    }

    public function fournisseurFactureStore(Request $request, Fournisseur $fournisseur)
    {
        $this->validate($request, [
            'produit' => 'required|min:1',
            'fournisseur' => 'required',
        ]);

        $produit = $request->produit ;
        $fournisseur = $request->fournisseur ;
        return redirect()->route('magasinier.fournisseur.facture.create', compact('fournisseur','produit'));
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
            'magasinier_id' => auth()->user()->id,
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

        return redirect()->route('magasinier.fournisseur.facture.invalide')->with('success', "Facture ajouté et envoyé au service comptable avec succès");

    }
 
    public function fournisseurFactureValide()
    {
        $fournisseurfactures = Fournisseurfacture::where('isvalide', 1)->orderBy('updated_at','desc')->get();
        return view('dashboard.magasinier.fournisseur-facture.etat.facture-valide', compact('fournisseurfactures'));
    }
    public function fournisseurFactureInvalide()
    {
        // dd(5);
        $fournisseurfactures = Fournisseurfacture::where('isvalide', 0)->orderBy('updated_at','desc')->get();
        return view('dashboard.magasinier.fournisseur-facture.etat.facture-invalide', compact('fournisseurfactures'));
    }
}
