<?php

namespace App\Http\Controllers\Packauto;

use App\Http\Controllers\Controller;
use App\Models\Vehiculedc;
use Illuminate\Http\Request;

class PackautoDemandeCarburantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicules = Vehiculedc::orderBy('updated_at','desc')->get();
        return view('dashboard.packauto.carburant.all-demande', compact('vehiculedcs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'categorie' => 'required|exists:categories,id',
        ]);

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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
