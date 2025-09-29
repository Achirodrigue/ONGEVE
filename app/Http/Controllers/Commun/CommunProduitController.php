<?php

namespace App\Http\Controllers\Commun;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Produitse;
use App\Models\Produitstat;
use Illuminate\Http\Request;
use App\Models\Entrepotcateg;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CommunProduitController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        $produits = Produit::orderBy('updated_at','desc')->get();
        return view('dashboard.geststock.produit.all-produit', compact('produits'));
    }

    public function create()
    {
        if(categories()->count() > 0)
        {
            // dd(1);
            return view('dashboard.geststock.produit.add-produit');
        }

        return back()->with('error', "le nombre de catégorie ".categories()->count()." doit être superieur à zéro");
    }

    // Fonction pour supprimer les accents
        public static function removeAccents($string)
        {
            return strtr(utf8_decode($string), 
                utf8_decode('ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝŸàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'),
                'AAAAAAACEEEEIIIIDNOOOOOOUUUUYYaaaaaaaceeeeiiiidnoooooouuuuyy'
            );
        }
    //
    

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|min:3',
            'prix' => 'required|numeric|min:1',
            'qtyStock' => 'required|min:1',
            'reference' => 'nullable|min:1',
            'TP' => 'required',
            'famille' => 'nullable|min:1',
            'reff' => 'nullable|min:1',
            'unite' => 'nullable|min:1',
            'entrepotcateg' => 'required|min:1',
        ]);

        // Génération de la référence
        if($request->TP == 0){ $vente = "V";}else{ $vente = "P";}
        $entrepotcateg = Entrepotcateg::findOrFail($request->entrepotcateg);
        $categoryCode1 = strtoupper(substr(self::removeAccents($entrepotcateg->categorie->nom), 0, 3));
        $categoryCode2 = strtoupper(substr(self::removeAccents($entrepotcateg->categorieprod->nom), 0, 3));
        $lastProduct = $entrepotcateg->produits()->orderBy('id', 'desc')->first();
        $lastNumber = $lastProduct ? (int) substr($lastProduct->reference, -3) : 0;
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $reference = "{$vente}-{$categoryCode1}-{$categoryCode2}-{$newNumber}";

        // Création du produit
        $produit = Produit::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'qtyStock' => $request->qtyStock,
            'qtyC' => null,
            'reference' => $reference,
            'TP' => $request->TP,
            'famille' => $request->famille,
            'reff' => $request->reff,
            'unite' => $request->unite,
            'entrepotcateg_id' => $request->entrepotcateg,
        ]);
        // dd(1);

        //cal
            $cal = ($request->qtyStock * 25) / 100 ;
            $SM = floor($cal);
        //

        Produitstat::create([
            'stock_min' => $SM,
            'entree' => $request->qtyStock,
            'sortie' => 0,
            'produit_id' => $produit->id,
        ]);

        Produitse::create([
            'quantite' => $request->qtyStock,
            'entree_sortie' => 1,
            'produit_id' => $produit->id,
        ]);

        return back()->with('success', "$produit->nom ajouté avec succès");
    }

    public function detailProduit(Produit $produit)
    { 
        // return view('dashboard.geststock.produit.detail-produit', compact('produit'));
    }

    public function edit(Produit $produit)     //(string $id)
    {
        // return view('dashboard.geststock.produit.edit-produit', compact('produit'));
    }

    public function update(Request $request, Produit $produit)
    {
        // Validation
        $request->validate([
            'nom' => 'required|min:3',
            'prix' => 'required|numeric|min:1',
            'qtyStock' => 'required|min:1',
            // 'reference' => 'nullable|min:1',
            'TP' => 'required',
            'famille' => 'nullable|min:1',
            'reff' => 'nullable|min:1',
            'unite' => 'nullable|min:1',
            'entrepotcateg' => 'required|min:1',
        ]);
        // dd(1);

        // Mise à jour de la quantité en stock
        if ($request->qtyStock < $produit->qtyStock) {
            return back()->with('error', "Désolé! La nouvelle quantité en stock ne dois être inferieur à la quantité initial.");
        }
    
        // Mise à jour du produit
        $produit->update([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'qtyStock' => $request->qtyStock,
            'qtyC' => null,
            // 'reference' => $request->reference,
            'TP' => $request->TP,
            'famille' => $request->famille,
            'reff' => $request->reff,
            'unite' => $request->unite,
            'entrepotcateg_id' => $request->entrepotcateg,
        ]);
    
        /* */
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
        
        
        return back()->with('success', "$produit->nom modifié avec succès");
    }

    public function destroy(Produit $produit)
    {
        $noms = $produit->nom;
        $produit->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }

}
