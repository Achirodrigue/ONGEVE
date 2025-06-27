<?php

namespace App\Http\Controllers\Admin;

use App\Models\Prodse;
use App\Models\Produit;
use App\Models\Vendeur;
use App\Models\Avisprod;
use App\Models\Produitimg;
use App\Models\Produitstat;
use Illuminate\Http\Request;
use App\Models\Souscategorie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Admin\FonctionPersonnelle\FonctionPersonnelle;

class AdminProduitController extends Controller
{
    use ValidatesRequests;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $souscategories = Souscategorie::all();
        $produits = Produit::where('etat', 1)->orderBy('updated_at','desc')->paginate(20);
        return view('dashboard.admin.produit.all-produit', compact('produits','souscategories'));
    }

    public function produitReconditionne()
    {
        $souscategories = Souscategorie::all();
        $produits = Produit::where('etat', 0)->orderBy('updated_at','desc')->paginate(20);
        return view('dashboard.admin.produit.produit-reconditionne', compact('produits','souscategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }
        
        $vendeurs = Vendeur::all();
        $souscategories = Souscategorie::all();

        if($vendeurs->count() > 0 && $souscategories->count() > 0)
        {
            return view('dashboard.admin.produit.add-produit', compact('souscategories','vendeurs'));
        }

        return back()->with('error', "le nombre de vendeur {$vendeurs->count()} et de sous catégorie {$souscategories->count()} doivent être superieur à zéro");
    }

    /**
     * Store a newly created resource in storage.
     */
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
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        // Validation
        $request->validate([
            'image1' => 'required|mimes:png,jpg,jpeg',
            'image2' => 'nullable|mimes:png,jpg,jpeg',
            'image3' => 'nullable|mimes:png,jpg,jpeg',
            'image4' => 'nullable|mimes:png,jpg,jpeg',
            'nom' => 'required|min:3|max:255',
            'etat' => 'required|min:1',
            'description' => 'required|min:5|max:255',
            'prix' => 'required|numeric|min:0',
            'qtyStock' => 'required|integer|min:1',
            'souscategorie' => 'required|exists:souscategories,id',
            'vendeur' => 'required|exists:vendeurs,id',
        ]);

        // Sauvegarde des images
        $image1 = $this->storeImage($request->file('image1'));
        $image2 = $request->hasFile('image2') ? $this->storeImage($request->file('image2')) : null;
        $image3 = $request->hasFile('image3') ? $this->storeImage($request->file('image3')) : null;
        $image4 = $request->hasFile('image4') ? $this->storeImage($request->file('image4')) : null;

        // Génération de la référence
        $souscategorie = Souscategorie::findOrFail($request->souscategorie);
        $categoryCode = strtoupper(substr(self::removeAccents($souscategorie->categorie->nom), 0, 3));
        $subcategoryCode = strtoupper(substr(self::removeAccents($souscategorie->nom), 0, 3));
        $lastProduct = $souscategorie->produits()->orderBy('id', 'desc')->first();
        $lastNumber = $lastProduct ? (int) substr($lastProduct->reference, -3) : 0;
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $reference = "{$categoryCode}-{$subcategoryCode}-{$newNumber}";

        // Création du produit
        $produit = Produit::create([
            'nom' => $request->nom,
            'image' => $image1,
            'description' => $request->description,
            'prix' => $request->prix,
            'promo' => null,
            'stock' => 1,
            'isvalide' => 1,
            'reference' => $reference,
            'qtyStock' => $request->qtyStock,
            'etat' => $request->etat,
            'mvente' => 0,
            'vendeur_id' => $request->vendeur,
            'souscategorie_id' => $request->souscategorie,
        ]);

        // Enregistrement des images supplémentaires
        Produitimg::create([
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'image4' => $image4,
            'produit_id' => $produit->id,
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

        Prodse::create([
            'quantite' => $request->qtyStock,
            'entree_sortie' => 1,
            'produit_id' => $produit->id,
        ]);

        return redirect()->route('admin.produit.index')->with('success', "$produit->nom ajouté avec succès");
    }

    private function storeImage($image)
    {
        $filename = time() . '_' . uniqid() . '.' . $image->extension();
        return $image->storeAs('AdminProduitImage', $filename, 'public');
    }


    /**
     * Display the specified resource.
     */
    public function detailProduit(string $id)
    { 
        $produit = Produit::findOrFail($id);
        return view('dashboard.admin.produit.detail-produit', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)     //(string $id)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }
        //$vendeurs = Vendeur::where('id','!=',$produit->vendeur->id)->get();
        
        $vendeurs = Vendeur::all()->except($produit->vendeur->id);
        $souscategories = Souscategorie::all()->except($produit->souscategorie->id);
        return view('dashboard.admin.produit.edit-produit', compact('souscategories','vendeurs','produit'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Produit $produit)
    {
        // Validation
        $request->validate([
            'nom' => 'required|min:3|max:255',
            'description' => 'required|min:5|max:255',
            'prix' => 'required|numeric|min:1',
            'qtyStock' => 'required|integer|min:1',
            'souscategorie' => 'required|exists:souscategories,id',
            'vendeur' => 'required|exists:vendeurs,id',
            'image1' => 'nullable|mimes:png,jpg,jpeg',
            'image2' => 'nullable|mimes:png,jpg,jpeg',
            'image3' => 'nullable|mimes:png,jpg,jpeg',
            'image4' => 'nullable|mimes:png,jpg,jpeg',
        ]);
    
        // Stocker les anciennes images
        $image1 = $produit->produitimg->image1;
        $image2 = $produit->produitimg->image2;
        $image3 = $produit->produitimg->image3;
        $image4 = $produit->produitimg->image4;
    
        // Mise à jour des images si nouvelles versions fournies
        if ($request->hasFile('image1')) {
            Storage::disk('public')->delete($image1);
            $image1 = $this->storeImage($request->file('image1'));
        }
    
        if ($request->hasFile('image2')) {
            if ($image2) Storage::disk('public')->delete($image2);
            $image2 = $this->storeImage($request->file('image2'));
        }
    
        if ($request->hasFile('image3')) {
            if ($image3) Storage::disk('public')->delete($image3);
            $image3 = $this->storeImage($request->file('image3'));
        }
    
        if ($request->hasFile('image4')) {
            if ($image4) Storage::disk('public')->delete($image4);
            $image4 = $this->storeImage($request->file('image4'));
        }
    
        // Mise à jour du produit
        $produit->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'qtyStock' => $request->qtyStock,
            'souscategorie_id' => $request->souscategorie,
            'vendeur_id' => $request->vendeur,
            'image' => $image1, // première image principale
        ]);
    
        // Mise à jour des images supplémentaires
        $produit->produitimg->update([
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'image4' => $image4,
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

        Prodse::create([
            'quantite' => $entree,
            'entree_sortie' => 1,
            'produit_id' => $produit->id,
        ]);
    
        return redirect()->route('admin.sous.categorie.produit', [
            'souscategorie' => $request->souscategorie
        ])->with('success', $produit->nom . ' modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        $noms = $produit->nom;

        if($produit->produitimg->image1){Storage::disk('public')->delete($produit->produitimg->image1);}
        if($produit->produitimg->image2){Storage::disk('public')->delete($produit->produitimg->image2);}
        if($produit->produitimg->image3){Storage::disk('public')->delete($produit->produitimg->image3);}
        if($produit->produitimg->image4){Storage::disk('public')->delete($produit->produitimg->image4);}

        $produit->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }

    //sous categ produit
        public function sousCategorieProduit(Souscategorie $souscategorie)
        {
            $produits = $souscategorie->produits()->orderBy('updated_at','desc')->paginate(12);
            $souscategories = Souscategorie::all();

            if($souscategorie->produits->count() > 0)
            {        
                return view('dashboard.admin.produit.scategorie-produit', compact('produits','souscategorie','souscategories'));
            }

            return redirect()->route('admin.produit.index');
        }
    //

    //action
        public function etatProduit(Produit $produit)
        {
            if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
                return $redirect;
            }

            //donnée
                $noms = $produit->nom;
            //
            $produit->update([
                'isvalide' => !$produit->isvalide
            ]);

            //dd($produit->isvalide);
            if($produit->isvalide)
            {
                return back()->with('success', "$noms : activé avec succès");
            }
            else
            {
                return back()->with('success', "$noms désactivé avec succès");
            }

        }
        public function stockProduit(Produit $produit)
        {
            if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
                return $redirect;
            }

            //donnée
                $noms = $produit->nom;
            //

            $produit->update([
                'stock' => !$produit->stock
            ]);

            //dd($produit->isvalide);
            if($produit->stock)
            {
                return back()->with('success', "$noms : stock activé avec succès");
            }
            else
            {
                // $produit->update([
                //     'qtyStock' => 0
                // ]);

                return back()->with('success', "$noms : stock désactivé avec succès");
            }

        }
        //promo promo.produit.retrait
            public function promoProduitUpdate(Request $request, Produit $produit)
            {
                if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
                    return $redirect;
                }

                //données
                    $noms = $produit->nom;
                //

                $this->validate($request, [
                    'promo' => 'required|min:1',
                ]);

                if(filter_var($request->promo, FILTER_VALIDATE_INT))
                {
                    if($produit->prix > $request->promo)
                    {
                        $produit->update([
                            "promo" => $request->promo
                        ]);

                        return back()->with('success', "$noms mis en promotion avec succès");
                    }

                    return back()->with('error', "Désolé! Le prix promo doit être inferieur au montant du prix normal.");
                }

                return back()->with('error', "Veillez entrer un montant valide svp.");
            }
            public function promoProduitDestroy(Produit $produit)
            {
                if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
                    return $redirect;
                }

                //donnée
                    $noms = $produit->nom;
                //

                $produit->update([
                    'promo' => null
                ]);

                return back()->with('success', "$noms : Promotion retiré avec succès");
            }
        //
    //

    //avis produit
        public function avisProduit(Produit $produit)
        {
            if($produit->avisprods->count() > 0)
            {        
                return view('dashboard.admin.produit.avis.avis-produit', compact('produit'));
            }

            return back()->with("error", "Désolé! aucun avis disponible pour le produit $produit->nom");
        }

        public function avisProduitDestroy(Avisprod $avisprod)
        {
            if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
                return $redirect;
            }

            $produit = $avisprod->produit->id;
            $noms = "$avisprod->nom $avisprod->prenom";
            $avisprod->delete();
            return redirect()->route('admin.avis.produit', compact('produit'))->with('success', "Avis de $noms supprimé avec succès");
        }
    //

}
