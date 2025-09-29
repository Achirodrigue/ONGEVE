<?php

namespace App\Http\Controllers\Magasinier;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Produitse;
use App\Models\Produitstat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class MagasinierProduitController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        $produits = Produit::orderBy('updated_at','desc')->get();
        return view('dashboard.magasinier.produit.all-produit', compact('produits'));
    }

    public function create()
    {
        if(categories()->count() > 0)
        {
            // dd(1);
            return view('dashboard.magasinier.produit.add-produit');
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
            // 'image' => 'required|mimes:png,jpg,jpeg',
            'description' => 'required|min:5',
            'prix' => 'required|numeric|min:0',
            'qtyStock' => 'required|integer|min:1',
            'TP' => 'required|min:1|max:1',
            'categorie' => 'required|exists:categories,id',
        ]);
        // dd(1);

        // Sauvegarde d'images
        // $image = storeImage($request->file('image'), "MagasinierProduitImage");

        // Génération de la référence
        $categorie = Categorie::findOrFail($request->categorie);
        $categoryCode = strtoupper(substr(self::removeAccents($categorie->nom), 0, 3));
        $lastProduct = $categorie->produits()->orderBy('id', 'desc')->first();
        $lastNumber = $lastProduct ? (int) substr($lastProduct->reference, -3) : 0;
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $reference = "{$categoryCode}-{$newNumber}";

        // Création du produit
        $produit = Produit::create([
            'nom' => $request->nom,
            // 'image' => $image,
            'description' => $request->description,
            'prix' => $request->prix,
            'promo' => null,
            'stock' => 1,
            'isvalide' => 1,
            'etat' => null,
            'mvente' => 0,
            'TP' => $request->TP,
            'reference' => $reference,
            'qtyStock' => $request->qtyStock,
            'categorie_id' => $request->categorie,
        ]);

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

        return redirect()->route('magasinier.produit.index')->with('success', "$produit->nom ajouté avec succès");
    }

    public function detailProduit(Produit $produit)
    { 
        return view('dashboard.magasinier.produit.detail-produit', compact('produit'));
    }

    public function edit(Produit $produit)     //(string $id)
    {
        $categories = Categorie::all()->except($produit->categorie->id);
        return view('dashboard.magasinier.produit.edit-produit', compact('categories','produit'));
    }

    public function update(Request $request, Produit $produit)
    {
        // Validation
        $request->validate([
            'nom' => 'required|min:3',
            // 'image' => 'required|mimes:png,jpg,jpeg',
            'description' => 'required|min:5',
            'prix' => 'required|numeric|min:0',
            // 'qtyStock' => 'required|integer|min:1',
            'TP' => 'required|min:1|max:1',
            'categorie' => 'required|exists:categories,id',
        ]);

        // Mise à jour de la quantité en stock
        if ($request->qtyStock < $produit->qtyStock) {
            return back()->with('success', "Désolé! La nouvelle quantité en stock ne dois être inferieur à la quantité initial.");
        }
    
        // Stocker les anciennes images
        // $image = $produit->image;
    
        // Mise à jour des images si nouvelles versions fournies
        // if ($request->hasFile('image')) {
        //     Storage::disk('public')->delete($image);
        //     $image = storeImage($request->file('image'), "MagasinierProduitImage");
        // }
    
        // Mise à jour du produit
        $produit->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            // 'qtyStock' => $request->qtyStock,
            'TP' => $request->TP,
            'categorie_id' => $request->categorie,
            // 'image' => $image, // première image principale
        ]);
    
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
        */
        
        return redirect()->route('magasinier.produit.index')->with('success', "$produit->nom modifié avec succès");
        // return redirect()->route('magasinier.categorie.produit', [
        //     'categorie' => $request->categorie
        // ])->with('success', "$produit->nom modifié avec succès");
    }

    public function destroy(Produit $produit)
    {
        $noms = $produit->nom;
        // Storage::disk('public')->delete($produit->produitimg->image1);
        $produit->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
























    // //action
    //     public function etatProduit(Produit $produit)
    //     {
    //         if ($redirect = FonctionPersonnelle::pageAccessiblemagasinier()) {
    //             return $redirect;
    //         }

    //         //donnée
    //             $noms = $produit->nom;
    //         //
    //         $produit->update([
    //             'isvalide' => !$produit->isvalide
    //         ]);

    //         //dd($produit->isvalide);
    //         if($produit->isvalide)
    //         {
    //             return back()->with('success', "$noms : activé avec succès");
    //         }
    //         else
    //         {
    //             return back()->with('success', "$noms désactivé avec succès");
    //         }

    //     }
    //     public function stockProduit(Produit $produit)
    //     {
    //         if ($redirect = FonctionPersonnelle::pageAccessiblemagasinier()) {
    //             return $redirect;
    //         }

    //         //donnée
    //             $noms = $produit->nom;
    //         //

    //         $produit->update([
    //             'stock' => !$produit->stock
    //         ]);

    //         //dd($produit->isvalide);
    //         if($produit->stock)
    //         {
    //             return back()->with('success', "$noms : stock activé avec succès");
    //         }
    //         else
    //         {
    //             // $produit->update([
    //             //     'qtyStock' => 0
    //             // ]);

    //             return back()->with('success', "$noms : stock désactivé avec succès");
    //         }

    //     }
    //     //promo promo.produit.retrait
    //         public function promoProduitUpdate(Request $request, Produit $produit)
    //         {
    //             if ($redirect = FonctionPersonnelle::pageAccessiblemagasinier()) {
    //                 return $redirect;
    //             }

    //             //données
    //                 $noms = $produit->nom;
    //             //

    //             $this->validate($request, [
    //                 'promo' => 'required|min:1',
    //             ]);

    //             if(filter_var($request->promo, FILTER_VALIDATE_INT))
    //             {
    //                 if($produit->prix > $request->promo)
    //                 {
    //                     $produit->update([
    //                         "promo" => $request->promo
    //                     ]);

    //                     return back()->with('success', "$noms mis en promotion avec succès");
    //                 }

    //                 return back()->with('error', "Désolé! Le prix promo doit être inferieur au montant du prix normal.");
    //             }

    //             return back()->with('error', "Veillez entrer un montant valide svp.");
    //         }
    //         public function promoProduitDestroy(Produit $produit)
    //         {
    //             if ($redirect = FonctionPersonnelle::pageAccessiblemagasinier()) {
    //                 return $redirect;
    //             }

    //             //donnée
    //                 $noms = $produit->nom;
    //             //

    //             $produit->update([
    //                 'promo' => null
    //             ]);

    //             return back()->with('success', "$noms : Promotion retiré avec succès");
    //         }
    //     //
    // //

    // //avis produit
    //     public function avisProduit(Produit $produit)
    //     {
    //         if($produit->avisprods->count() > 0)
    //         {        
    //             return view('dashboard.magasinier.produit.avis.avis-produit', compact('produit'));
    //         }

    //         return back()->with("error", "Désolé! aucun avis disponible pour le produit $produit->nom");
    //     }

    //     public function avisProduitDestroy(Avisprod $avisprod)
    //     {
    //         if ($redirect = FonctionPersonnelle::pageAccessiblemagasinier()) {
    //             return $redirect;
    //         }

    //         $produit = $avisprod->produit->id;
    //         $noms = "$avisprod->nom $avisprod->prenom";
    //         $avisprod->delete();
    //         return redirect()->route('magasinier.avis.produit', compact('produit'))->with('success', "Avis de $noms supprimé avec succès");
    //     }
    // //

}
