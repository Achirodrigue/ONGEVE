<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produit;
use App\Models\Vendeur;
use App\Models\Avisprod;
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
        $produits = Produit::orderBy('updated_at','desc')->paginate(20);
        return view('dashboard.admin.produit.all-produit', compact('produits','souscategories'));
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
        // Convertir en majuscules et tronquer à 3 caractères
        //$categoryCode = strtoupper(substr($category, 0, 3));
        // $souscategorie = Souscategorie::findOrFail($request->souscategorie);
        // $categoryCode = strtoupper(substr(self::removeAccents($souscategorie->categorie->nom), 0, 3));
        // $subcategoryCode = strtoupper(substr(self::removeAccents($souscategorie->nom), 0, 3));

        // $lastProduct = $souscategorie->produits()->orderBy('id', 'desc')->first();
        // $lastNumber = $lastProduct ? (int) substr($lastProduct->reference, -3) : 0;
        // $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);


        //$subcategoryCode = strtoupper(substr($subcategory, 0, 3));
        // dd("$categoryCode-$subcategoryCode-$newNumber");
        // // Trouver le dernier numéro utilisé
        // $lastProduct = self::where('category', $category)
        //     ->where('subcategory', $subcategory)
        //     ->orderBy('id', 'desc')
        //     ->first();

        // $lastNumber = $lastProduct ? (int) substr($lastProduct->reference, -3) : 0;
        // $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // return "{$categoryCode}-{$subcategoryCode}-{$newNumber}";

        // $reference = Produit::generateReference($request->category, $request->subcategory);
    





        $this->validate($request, [
            'image' => 'required|mimes:png,jpg,jpeg',
            'nom'   => 'required|min:3',
            'description'   => 'required|min:5',
            'prix'   => 'required|min:3',
            'qtyStock'   => 'required|min:1',
        ]);

        $filename = time() . '.' . $request->image->extension();
        $image = $request->file('image')->storeAs(
            'AdminProduitImage',
            $filename,
            'public'
        );

        $souscategorie = Souscategorie::findOrFail($request->souscategorie);
        $categoryCode = strtoupper(substr(self::removeAccents($souscategorie->categorie->nom), 0, 3));
        $subcategoryCode = strtoupper(substr(self::removeAccents($souscategorie->nom), 0, 3));

        $lastProduct = $souscategorie->produits()->orderBy('id', 'desc')->first();
        $lastNumber = $lastProduct ? (int) substr($lastProduct->reference, -3) : 0;
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $reference = "{$categoryCode}-{$subcategoryCode}-{$newNumber}";

        $produit = Produit::create([
            'nom' => $request->nom,
            'image' => $image,
            'description' => $request->description,
            'prix' => $request->prix,
            'promo' => null,
            'stock' => 1,
            'isvalide' => 1,
            'reference' => $reference,
            'qtyStock' => $request->qtyStock,
            'vendeur_id' => $request->vendeur,
            'souscategorie_id' => $request->souscategorie,
        ]);

        return redirect()->route('admin.produit.index')->with('success', $produit->nom.' ajouté avec succès');
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
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        //données
            $noms = $produit->nom;
            $image = $produit->image;
        //

        if (!empty($request->image))
        {
            $this->validate($request, [
                'image' => 'required|mimes:png,jpg,jpeg',
            ]);
            
            Storage::disk('public')->delete($produit->image);
            $filename = time() . '.' . $request->image->extension();
            $image = $request->file('image')->storeAs(
                'AdminProduitImage',
                $filename,
                'public'
            );
        }
        
        $produit->update([
            'image' => $image
        ]);

        $produit->update($request->post());

        $souscategorie = $produit->souscategorie->id;

        return redirect()->route('admin.sous.categorie.produit', compact('souscategorie'))->with('success', $noms.' modifié avec succès');
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
        Storage::disk('public')->delete($produit->image);
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
                    'promo' => 'required|min:3',
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

    // use Illuminate\Support\Str;

    // class Product extends Model
    // {
    //     protected $fillable = ['name', 'category', 'subcategory', 'reference'];

    //     public static function generateReference($category, $subcategory)
    //     {
    //         // Convertir en majuscules et tronquer à 3 caractères
    //         $categoryCode = strtoupper(substr($category, 0, 3));
    //         $subcategoryCode = strtoupper(substr($subcategory, 0, 3));

    //         // Trouver le dernier numéro utilisé
    //         $lastProduct = self::where('category', $category)
    //             ->where('subcategory', $subcategory)
    //             ->orderBy('id', 'desc')
    //             ->first();

    //         $lastNumber = $lastProduct ? (int) substr($lastProduct->reference, -3) : 0;
    //         $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

    //         return "{$categoryCode}-{$subcategoryCode}-{$newNumber}";
    //     }
    // }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'category' => 'required|string|max:255',
    //         'subcategory' => 'required|string|max:255',
    //     ]);

    //     $reference = Product::generateReference($request->category, $request->subcategory);

    //     $product = Product::create([
    //         'name' => $request->name,
    //         'category' => $request->category,
    //         'subcategory' => $request->subcategory,
    //         'reference' => $reference,
    //     ]);

    //     return response()->json(['message' => 'Produit ajouté avec succès', 'product' => $product], 201);
    // }

}
