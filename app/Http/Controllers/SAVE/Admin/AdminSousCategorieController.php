<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Souscategorie;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\FonctionPersonnelle\FonctionPersonnelle;

class AdminSousCategorieController extends Controller
{
    
    public function index()
    {
        $categories = Categorie::orderBy('updated_at','desc')->get();
        $souscategories = Souscategorie::orderBy('updated_at','desc')->get();
        return view('dashboard.admin.sous-categorie.all-sous-categorie', compact('categories','souscategories'));
    }

    
    public function store(Request $request)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }
        
        $this->validate($request, [
            'nom' => 'required|unique:souscategories|min:3'
        ]);

        // dd(4);

        $souscategorie = Souscategorie::create([
            'nom' => $request->nom,
            'categorie_id' => $request->categorie
        ]);
            
        return back()->with('success', $souscategorie->nom.' ajouté avec succès');
    }


    // public function sousCategorieCreate(Categorie $categorie)
    // {
    //     return view('dashboard.admin.sous-categorie.add-sous-categorie', compact('categorie'));
    // }

    // public function sousCategorieStore(Request $request, Categorie $categorie)
    // {
    //     $this->validate($request, [
    //         'nom'   => 'required|unique:souscategorieS'
    //     ]);

    //     $souscategorie = Souscategorie::create([
    //         'nom' => $request->nom,
    //         'categorie_id' => $categorie->id
    //     ]);

    //     $noms = $souscategorie->nom;
            
    //     return back()->with('message', 'Sous catégorie '.$noms.' créer avec succès');
    // }

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
    public function edit(Souscategorie $souscategorie)     //(string $id)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        return view('dashboard.admin.sous-categorie.edit-sous-categorie', compact('souscategorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Souscategorie $scategorie)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        //dd($scategorie);
        $this->validate($request, [
            'nom' => [
                'required',
                'min:3',
                Rule::unique('souscategories', 'nom')->ignore($categorie->id),
            ],

        ]);
        
        $noms = $scategorie->nom;
        $scategorie->update($request->post());
        return back()->with('success', 'Sous catégorie '.$noms.' modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Souscategorie $scategorie)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }
        
        $sousCategorieProduit = $scategorie->produits()->count();
        $categorie = $scategorie->categorie->id;
        //dd($sousCategorieProduit);
        if($sousCategorieProduit > 0)
        {
            return back()->with('message','Désolé! vous ne pouvez pas supprimer une sous catégorie contenant déjà des produits.');
        }
        else
        {
            $noms = $scategorie->nom;
            $scategorie->delete();
            return back()->with('success', 'Sous catégorie '.$noms.' supprimé avec succès');
            return redirect()->route('admin.categorie.souscategorie', compact('categorie'))->with('success', 'Sous catégorie '.$noms.' supprimé avec succès');
        }
    }
}
