<?php

namespace App\Http\Controllers\Geststock;


use App\Models\Categorieprod;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class GeststockCategorieProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $categorieprods = Categorieprod::orderBy('updated_at','desc')->get();
        return view('dashboard.geststock.categorie-produit.all-categorie-produit', compact('categorieprods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.geststock.categorie.add-categorie');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|unique:categorieprods|min:3'
        ]);

        $categorie = Categorieprod::create([
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
    public function edit(Categorieprod $categorieprod)     //(string $id)
    {
        return view('dashboard.geststock.categorie.edit-categorie', compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorieprod $categorieprod)
    {
        $this->validate($request, [
            'nom' => [
                'required',
                'min:3',
                Rule::unique('categorieprods', 'nom')->ignore($categorieprod->id),
            ],
        ]);
        
        $noms = $categorieprod->nom;
        $categorieprod->update($request->post());
        return redirect()->route('geststock.categorieprod.index')->with('success', "$noms modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorieprod $categorieprod)
    {
        $NP = 0;
        $entrepotcategs = $categorieprod->entrepotcategs()->count();
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
            return back()->with('error',"Désolé! vous ne pouvez pas supprimer une categorie contenant déjà des produits.");
        }
        else
        {
            $noms = $categorieprod->nom;
            $categorieprod->delete();
            return back()->with('success', "$noms supprimé avec succès");
        }
    }

    
    //categorie produits
        public function categorieProduit(Categorie $categorie)
        {
            $produits = $categorie->produits()->orderBy('updated_at','desc')->get();
            return view('dashboard.geststock.categorie.categorie-produit', compact('categorie','produits'));
        }
    //
}
