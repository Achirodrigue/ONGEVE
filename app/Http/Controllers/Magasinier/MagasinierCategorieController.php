<?php

namespace App\Http\Controllers\Magasinier;


use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class MagasinierCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $categories = Categorie::orderBy('updated_at','desc')->get();
        return view('dashboard.magasinier.categorie.all-categorie', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.magasinier.categorie.add-categorie');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|unique:categories|min:3'
        ]);

        $categorie = Categorie::create([
            'nom' => $request->nom
        ]);
            
        return back()->with('success', "$categorie->nom ajouté avec succès");
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
    public function edit(Categorie $categorie)     //(string $id)
    {
        return view('dashboard.magasinier.categorie.edit-categorie', compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        $this->validate($request, [
            'nom' => [
                'required',
                'min:3',
                Rule::unique('categories', 'nom')->ignore($categorie->id),
            ],
        ]);
        
        $noms = $categorie->nom;
        $categorie->update($request->post());
        return redirect()->route('magasinier.categorie.index')->with('success', "$noms modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $categorieP = $categorie->produits()->count();
        //dd($categorieP);
        if($categorieP > 0)
        {
            return back()->with('error',"Désolé! vous ne pouvez pas supprimer un entrepôt contenant déjà des produits.");
        }
        else
        {
            $noms = $categorie->nom;
            $categorie->delete();
            return back()->with('success', "$noms supprimé avec succès");
        }
    }

    
    //categorie produits
        public function categorieProduit(Categorie $categorie)
        {
            $produits = $categorie->produits()->orderBy('updated_at','desc')->get();
            return view('dashboard.magasinier.categorie.categorie-produit', compact('categorie','produits'));
        }
    //
}
