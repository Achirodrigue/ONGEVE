<?php

namespace App\Http\Controllers\Admin;

use App\Models\Secteur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\FonctionPersonnelle\FonctionPersonnelle;

class AdminSecteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $secteurs = Secteur::orderBy('nom','asc')->get();
        return view('dashboard.admin.secteur.all-secteur', compact('secteurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }
        
        return view('dashboard.admin.secteur.add-secteur');
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
            'nom' => 'required|unique:secteurs|min:3',
            'frais_livraison' => 'required|numeric|min:3'
        ]);

        // dd(4);

        $secteur = Secteur::create([
            'nom' => $request->nom,
            'frais_livraison' => $request->frais_livraison
        ]);
            
        return back()->with('success', $secteur->nom.' ajouté avec succès');
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
    public function edit(Secteur $secteur)     //(string $id)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        return view('dashboard.admin.secteur.edit-secteur', compact('secteur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Secteur $secteur)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        $this->validate($request, [
            'nom'   => 'required|unique:secteurs,nom,' . $secteur->id . '|min:3',
            'frais_livraison' => 'required|numeric|min:3'
        ]);
        
        $noms = $secteur->nom;
        $secteur->update($request->post());
        return redirect()->route('admin.secteur.index')->with('success', $noms.' modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(secteur $secteur)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }
        //$secteurSC = $secteur->soussecteurs()->count();
        //dd($secteurSC);
        
        if($secteur->commandesecteurs->count() > 0 || $secteur->adminsecteurs->count() > 0)
        {
            return back()->with('error','Désolé! vous ne pouvez pas supprimer un secteur contenant déjà des admins ou commande.');
        }
        else
        {
            $noms = $secteur->nom;
            $secteur->delete();
            return back()->with('success', $noms.' supprimé avec succès');
        }
    }
}
