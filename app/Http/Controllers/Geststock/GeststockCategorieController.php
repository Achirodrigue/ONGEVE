<?php

namespace App\Http\Controllers\Geststock;


use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Entrepotcateg;

class GeststockCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $categories = Categorie::orderBy('updated_at','desc')->get();
        return view('dashboard.geststock.entrepot.all-entrepot', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.geststock.entrepot.add-entrepot');
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
        return view('dashboard.geststock.entrepot.edit-entrepot', compact('categorie'));
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
        return redirect()->route('geststock.categorie.index')->with('success', "$noms modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $NP = 0;
        $entrepotcategs = $categorie->entrepotcategs()->get();
        if($entrepotcategs->count() > 0)
        {
            foreach($entrepotcategs as $entrepotcateg)
            {
                if($entrepotcateg->produits()->count() > 0)
                {
                    $NP += 1 ;
                }
            }
        }
        //dd($categorieP);
        if($NP > 0)
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

    
    //entrepot categorie et entrepot categorie produits
        public function entrepotCategorie(Categorie $categorie)
        {
            return view('dashboard.geststock.entrepot.entrepot-categorie', compact('categorie'));
        }
        public function entrepotCategorieProduit(Entrepotcateg $entrepotcateg)
        {
            $produits = $entrepotcateg->produits()->orderBy('updated_at','desc')->get();
            return view('dashboard.geststock.entrepot.entrepot-categorie-produit', compact('produits','entrepotcateg'));
        }
    //
}
