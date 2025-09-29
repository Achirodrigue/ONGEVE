<?php

namespace App\Http\Controllers\Commun;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class FournisseurController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        // $fournisseurs = Fournisseur::orderBy('updated_at','desc')->get();
        // return view('dashboard.magasinier.fournisseur.all-fournisseur', compact('fournisseurs'));
    }

    public function create()
    {
        // return view('dashboard.magasinier.fournisseur.add-fournisseur');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|min:2',
            'email' => 'required|email|unique:fournisseurs|min:8',
            'contact' => 'required|unique:fournisseurs|min:8|max:12',
            'NCC' => 'nullable|unique:fournisseurs|min:3|max:30',
            'adresse_postale' => 'required|min:2',
            'domaine' => 'required|min:2',
            'siege_social' => 'required|min:2',
            'reff' => 'nullable|min:1',
        ]);
        
        $fournisseur = Fournisseur::create([
            'nom' => $request->nom,
            'email' => $request->email ,
            'contact' => $request->contact ,
            'NCC' => $request->NCC ,
            'adresse_postale' => $request->adresse_postale,
            'domaine' => $request->domaine,
            'siege_social' => $request->siege_social,
            'reff' => $request->reff,
        ]);

        //données
            $noms = $fournisseur->nom ;
        //

        return back()->with('success', "$noms ajouté avec succès");
    }

    public function edit(Fournisseur $fournisseur)  
    {
        // return view('dashboard.magasinier.fournisseur.edit-fournisseur', compact('fournisseur'));
    }

    public function update(Request $request, Fournisseur $fournisseur)
    {
        // Validation
        //données
            $noms = $fournisseur->nom ;
        //

        // dd($request->NCC);

        $this->validate($request, [
            'nom' => 'required|min:2',
            'adresse_postale' => 'required|min:2',
            'contact'   => 'required|unique:fournisseurs,contact,' . $fournisseur->id . '|min:8|max:12',
            'email'   => 'required|email|unique:fournisseurs,email,' . $fournisseur->id . '|min:8',
            'NCC' => 'nullable|unique:fournisseurs,NCC,' . $fournisseur->id . '|min:3|max:30',
            'domaine' => 'required|min:2',
            'siege_social' => 'required|min:2',
        ]);
        
        $fournisseur->update($request->post());
        
        return back()->with('success', "$noms modifié avec succès");
    }

    public function destroy(Fournisseur $fournisseur)
    {
        //données
            $noms = $fournisseur->nom ;
        //
        $fournisseur->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
}
