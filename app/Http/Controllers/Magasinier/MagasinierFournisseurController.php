<?php

namespace App\Http\Controllers\Magasinier;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class MagasinierFournisseurController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        $fournisseurs = Fournisseur::orderBy('updated_at','desc')->get();
        return view('dashboard.magasinier.fournisseur.all-fournisseur', compact('fournisseurs'));
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
            'adresse_postale' => 'required|min:2',
            'domaine' => 'required|min:2',
            'siege_social' => 'required|min:2',
        ]);
        
        $fournisseur = Fournisseur::create([
            'nom' => $request->nom,
            'email' => $request->email ,
            'contact' => $request->contact ,
            'adresse_postale' => $request->adresse_postale,
            'domaine' => $request->domaine,
            'siege_social' => $request->siege_social,
        ]);

        //données
            $noms = $fournisseur->nom ;
        //

        return redirect()->route('magasinier.fournisseur.index')->with('success', "$noms ajouté avec succès");
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

        $this->validate($request, [
            'nom' => 'required|min:2',
            'adresse_postale' => 'required|min:2',
            'contact'   => 'required|unique:fournisseurs,contact,' . $fournisseur->id . '|min:8|max:12',
            'email'   => 'required|email|unique:fournisseurs,email,' . $fournisseur->id . '|min:8',
            'domaine' => 'required|min:2',
            'siege_social' => 'required|min:2',
        ]);
        
        $fournisseur->update($request->post());

        $fournisseur->fournisseurinfo->update($request->post());
        
        return redirect()->route('magasinier.fournisseur.index')->with('success', "$noms modifié avec succès");
    }

    public function destroy(Fournisseur $fournisseur)
    {
        //données
            $noms = $fournisseur->nom ;
        //
        $fournisseur->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
    
    //fournisseur facture reception
        public function factureFournisseurReceptionEncours()
        {
            return view('dashboard.magasinier.facture-fournisseur.reception.encours'); //compact('fournisseurs')
        }
        public function factureFournisseurReceptionValide()
        {
            return view('dashboard.magasinier.facture-fournisseur.reception.valide');
        }
    //
}
