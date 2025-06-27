<?php

namespace App\Http\Controllers\Admin;


use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\FonctionPersonnelle\FonctionPersonnelle;

class AdminCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    // public function indexPrimaire()
    // {
    //     if(!auth()->user()->role) 
    //     {
    //         return redirect()->route('admin.home')->with('message',"Désolé! vous n'êtes pas un superviseur ou super admin");
    //     } 
    // }

    public function index()
    {
        $categories = Categorie::orderBy('updated_at','desc')->get();
        return view('dashboard.admin.categorie.all-categorie', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->indexPrimaire() ;
        
        return view('dashboard.admin.categorie.add-categorie');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        $this->validate($request, [
            'nom' => 'required|unique:categories|min:3'
        ]);

        // dd(4);

        $categorie = Categorie::create([
            'nom' => $request->nom
        ]);
            
        return back()->with('success', $categorie->nom.' ajouté avec succès');
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
        return view('dashboard.admin.categorie.edit-categorie', compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        $this->validate($request, [
            'nom' => [
                'required',
                'min:3',
                Rule::unique('categories', 'nom')->ignore($categorie->id),
            ],
        ]);
        
        $noms = $categorie->nom;
        $categorie->update($request->post());
        return redirect()->route('admin.categorie.index')->with('success', $noms.' modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        $categorieSC = $categorie->souscategories()->count();
        //dd($categorieSC);
        if($categorieSC > 0)
        {
            return back()->with('error','Désolé! vous ne pouvez pas supprimer une catégorie contenant déjà des sous categories.');
        }
        else
        {
            $noms = $categorie->nom;
            $categorie->delete();
            return back()->with('success', $noms.' supprimé avec succès');
        }
    }

    
    //categorie sous categ
        public function categorieSousCategorie(Categorie $categorie)
        {
            $categories = Categorie::orderBy('updated_at','desc')->get();
            return view('dashboard.admin.categorie.categorie-souscategorie', compact('categorie','categories'));
        }
    //
}
