<?php

namespace App\Http\Controllers\Packauto;

use App\Models\Pchauffeur;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PackautoChauffeurController extends Controller
{
    public function index()
    {
        $pchauffeurs = Pchauffeur::orderBy('updated_at','desc')->get();
        return view('dashboard.packauto.chauffeur.all-chauffeur', compact('pchauffeurs'));
    }
    // public function chauffeurDisponible()
    // {
    //     // dd(5);
    //     $pchauffeurs = Pchauffeur::where('ES', 0)->orderBy('updated_at','desc')->get();
    //     return view('dashboard.packauto.chauffeur.all-chauffeur-disponible', compact('pchauffeurs'));
    // }
    // public function chauffeurEmprunte()
    // {
    //     $pchauffeurs = Pchauffeur::where('ES', 1)->orderBy('updated_at','desc')->get();
    //     return view('dashboard.packauto.chauffeur.all-chauffeur-emprunte', compact('pchauffeurs'));
    // }
    
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|min:1',
            'prenom' => 'required|min:1',
            'email' => 'required|email|unique:pchauffeurs|min:1',
            'contact' => 'required|unique:pchauffeurs|min:1',
            'permis_numero' => 'nullable|unique:pchauffeurs|min:1',
            'permis_validite' => 'nullable|min:1',
            // 'photo' => 'nullable|mimes:png,jpg,jpeg,pdf',
        ]);

        // Sauvegarde d'images
            // $photo = null;
            // if($request->hasFile('photo')){ $photo = storeImage($request->file('photo'), "ChauffeurPhoto"); }  
        //

        // Création chauffeur
            $pchauffeur = Pchauffeur::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'contact' => $request->contact,
                'permis_validite' => $request->permis_validite,
                'permis_numero' => $request->permis_numero,
                'statut' => 1,
                // 'photo' => $photo,
            ]);
        //

        return back()->with('success', "$pchauffeur->nom $pchauffeur->prenom ajouté avec succès");
    }

    public function show(Pchauffeur $pchauffeur)
    {
        return view('dashboard.packauto.chauffeur.chauffeur-document', compact('pchauffeur'));
    }
    
    public function edit(string $id)
    {
        //
    }
    
    public function update(Request $request, Pchauffeur $pchauffeur)
    {
        $request->validate([
            'nom' => 'required|min:1',
            'prenom' => 'required|min:1',
            'email' => [
                'required',
                'email',
                'min:3',
                Rule::unique('pchauffeurs', 'email')->ignore($pchauffeur->id),
            ],
            'contact' => [
                'required',
                'min:3',
                Rule::unique('pchauffeurs', 'contact')->ignore($pchauffeur->id),
            ],
            'permis_numero' => [
                'nullable',
                'min:3',
                Rule::unique('pchauffeurs', 'permis_numero')->ignore($pchauffeur->id),
            ],
            'permis_validite' => 'nullable|min:1',
            // 'photo' => 'nullable|mimes:png,jpg,jpeg,pdf',
        ]);

        // Sauvegarde d'images
            // Stocker les anciennes images
            // $photo = $pchauffeur->photo;
        
            // Mise à jour des images si nouvelles versions fournies
            // if ($request->hasFile('photo')) {
            //     if($pchauffeur->photo){ Storage::disk('public')->delete($pchauffeur->photo); }  
            //     $photo = storeImage($request->file('photo'), "ChauffeurPhoto");
            // }
        //

        $noms = "$pchauffeur->nom $pchauffeur->prenom";
        $pchauffeur->update($request->post());
        // $pchauffeur->update([
        //     'photo' => $photo,
        // ]);

        return back()->with('success', "$noms ajouté avec succès");
    }

    public function destroy(Pchauffeur $pchauffeur)
    {
        $noms = "$pchauffeur->nom $pchauffeur->prenom";
        // if($pchauffeur->photo){ Storage::disk('public')->delete($pchauffeur->photo); }  
        $pchauffeur->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
}
