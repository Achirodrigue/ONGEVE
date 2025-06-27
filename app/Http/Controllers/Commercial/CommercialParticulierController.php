<?php

namespace App\Http\Controllers\Commercial;

use App\Models\Particulier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CommercialParticulierController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        $particuliers = Particulier::orderBy('updated_at','desc')->get();
        return view('dashboard.commercial.particulier.all-particulier', compact('particuliers'));
    }

    public function create()
    {
        return view('dashboard.commercial.particulier.add-particulier');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|min:2',
            'forme_juridique' => 'required|min:2',
            'numero_identifie' => 'required|min:2',
            'domaine' => 'required|min:2',
            'siege_social' => 'required|min:2',
            'adresse' => 'required|min:2',
            'Pachat' => 'required|min:2',
            'contact' => 'required|unique:particuliers|min:8|max:12',
            'email' => 'required|email|unique:particuliers|min:8',
        ]);
        
        // Création du particulier
        $particulier = Particulier::create([
            'nom' => $request->nom,
            'forme_juridique' => $request->forme_juridique,
            'numero_identifie' => $request->numero_identifie,
            'domaine' => $request->domaine,
            'siege_social' => $request->siege_social,
            'adresse' => $request->adresse,
            'contact' => $request->contact ,
            'email' => $request->email ,
            'Pachat' => $request->Pachat ,
            'commercial_id' => auth()->user()->id,
        ]);

        //données
            $noms = $particulier->nom ;
        //

        return redirect()->route('commercial.particulier.index')->with('success', "$noms ajouté avec succès");
    }

    public function edit(Particulier $particulier)  
    {
        return view('dashboard.commercial.particulier.edit-particulier', compact('particulier'));
    }

    public function update(Request $request, Particulier $particulier)
    {
        // Validation
        $request->validate([
            'nom' => 'required|min:2',
            'forme_juridique' => 'required|min:2',
            'numero_identifie' => 'required|min:2',
            'domaine' => 'required|min:2',
            'siege_social' => 'required|min:2',
            'adresse' => 'required|min:2',
            'Pachat' => 'required|min:2',
            'contact'   => 'required|unique:particuliers,contact,' . $particulier->id . '|min:8|max:12',
            'email'   => 'required|email|unique:particuliers,email,' . $particulier->id . '|min:8',
        ]);

        //données
            $noms = $particulier->nom ;
        //

        $particulier->update($request->post());
        
        return redirect()->route('commercial.particulier.index')->with('success', "$noms modifié avec succès");
    }

    public function destroy(Particulier $particulier)
    {
        //données
            $noms = $particulier->nom ;
        //
        $particulier->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
}
