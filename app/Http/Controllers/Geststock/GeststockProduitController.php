<?php

namespace App\Http\Controllers\Geststock;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Produitse;
use App\Models\Produitstat;
use Illuminate\Http\Request;
use App\Models\Entrepotcateg;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class GeststockProduitController extends Controller
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
        // dd($request->all());
        // Validation
            $request->validate([
                'nom' => 'required|min:3',
                'description' => 'nullable|min:5',
                'prix' => 'required|numeric|min:1',
                // 'qtyStock' => 'nullable|integer|min:1',
                'TP' => 'required|min:0|max:1',
                'unite' => 'nullable|min:1',
                'image' => 'nullable|mimes:png,jpg,jpeg,pdf|max:2048',
                'entrepotcateg' => 'required|min:1',
            ]);
        // dd(1);

        // Sauvegarde d'images
            $image = null;
            if(!empty($request->image))
            {
                $image = storeImage($request->file('image'), "EntrepotProduitImage");
            }
        //

        // Génération de la référence
            if($request->TP == 0){ $vente = "V";}else{ $vente = "P";}
            $entrepotcateg = Entrepotcateg::findOrFail($request->entrepotcateg);
            $categoryCode1 = strtoupper(substr(self::removeAccents($entrepotcateg->categorie->nom), 0, 3));
            $categoryCode2 = strtoupper(substr(self::removeAccents($entrepotcateg->categorieprod->nom), 0, 3));
            $lastProduct = $entrepotcateg->produits()->orderBy('id', 'desc')->first();
            $lastNumber = $lastProduct ? (int) substr($lastProduct->reference, -3) : 0;
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            $reference = "{$vente}-{$categoryCode1}-{$categoryCode2}-{$newNumber}";
        //

        // Création du produit
            $produit = Produit::create([
                'nom' => $request->nom,
                'description' => $request->description,
                'prix' => $request->prix,
                'qtyStock' => null,
                'qtyC' => null,
                'reference' => $reference,
                'TP' => $request->TP,
                'famille' => null,
                'reff' => null,
                'unite' => $request->unite,
                'image' => $image,
                'entrepotcateg_id' => $request->entrepotcateg,
                'fournisseur_id' => null,
            ]);
        //

        Produitstat::create([
            'stock_min' => 0,
            'entree' => 0,
            'sortie' => 0,
            'produit_id' => $produit->id,
        ]);

        return redirect()->route('geststock.produit.index')->with('success', "$produit->nom ajouté avec succès");
    }

    public function detailProduit(Produit $produit)
    { 
        return view('dashboard.geststock.produit.detail-produit', compact('produit'));
    }

    public function edit(Produit $produit)     //(string $id)
    {
        return view('dashboard.geststock.produit.edit-produit', compact('produit'));
    }

    public function update(Request $request, Produit $produit)
    {
        // Validation
            $request->validate([
                'nom' => 'required|min:3',
                'description' => 'nullable|min:5',
                'prix' => 'required|numeric|min:1',
                // 'TP' => 'required|min:0|max:1',
                'unite' => 'nullable|min:1',
                'image' => 'nullable|mimes:png,jpg,jpeg,pdf|max:2048',
                'entrepotcateg' => 'required|min:1',
            ]);
        //

        // Stocker les anciennes images et Mise à jour des images si nouvelles versions fournies
            $image = $produit->image;
            if ($request->hasFile('image')) {
                if($produit->image){ Storage::disk('public')->delete($image); }
                $image = storeImage($request->file('image'), "EntrepotProduitImage");
            }
        //
    
        // Mise à jour du produit
            $produit->update([
                'nom' => $request->nom,
                'description' => $request->description,
                'prix' => $request->prix,
                // 'TP' => $request->TP,
                'unite' => $request->unite,
                'image' => $image,
                'entrepotcateg_id' => $request->entrepotcateg,
            ]);
        //
        
        return redirect()->route('geststock.produit.index')->with('success', "$produit->nom modifié avec succès");
    }

    public function destroy(Produit $produit)
    {
        $noms = $produit->nom;
        if($produit->image){ Storage::disk('public')->delete($produit->image); }
        $produit->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }

}
