<?php

namespace App\Http\Controllers\Ressource;

use App\Models\Employe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RessourceEmployeController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        $employes = Employe::orderBy('updated_at','desc')->get();
        return view('dashboard.ressource.employe.all-employe', compact('employes'));
    }

    public function create()
    {
        return view('dashboard.ressource.employe.add-employe');
    }

    public function store(Request $request)
    {
        // 1. Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour l'image
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable|string|max:255',
            'sexe' => 'required',
            'nationalite' => 'required|string|max:255',
            'situation_matrimoniale' => 'required|string|max:255',
            'nombre_enfant' => 'required|integer|min:0',

            'adresse' => 'required|string',
            'contact' => 'required|string|unique:employes,contact|max:50',
            'email' => 'required|email|unique:employes,email|max:255',
            'contact_urgence' => 'required|string|max:50',

            'matricule_interne' => 'required|string|unique:employes,matricule_interne|max:255', // Matricule unique et requis
            'poste' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'lieu_affectation' => 'required|string|max:255',
            'nom_manageur' => 'required|string|max:255',
            'statut' => 'nullable|in:CDI,CDD,Interim,Stage',
            'date_embauche' => 'required|date',
            'date_fin_contrat' => 'nullable|date|after_or_equal:date_embauche',

            'salaire' => 'nullable|numeric|min:0',
            'mode_paiement' => 'nullable|string|max:255',
            'compte_bancaire' => 'nullable|string|max:255',
            'numero_cnps' => 'nullable|string|max:255',
            'equipement_fournis' => 'nullable|string',
        ]);

        // 2. Gestion de l'upload de la photo
        if ($request->hasFile('photo')) {
            $imagePath = storeImage($request->file('photo'), "EmployePhoto");
            $validatedData['photo'] = $imagePath;
        }

        // 3. Création du salarié
        $employe = Employe::create($validatedData);

        // 4. Redirection après succès
        // Pour l'instant, on redirige vers le formulaire avec un message de succès
        // Plus tard, nous redirigerons vers la page de détails de l'employé ou la liste.
        return redirect()->route('ressource.employe.index')->with('success', "Employé $employe->nom $employe->prenom ajouté avec succès !");
    }

    public function show(Employe $employe)
    {
        return view('dashboard.ressource.employe.detail-employe', compact('employe'));
    }

    public function edit(Employe $employe)  
    {
        return view('dashboard.ressource.employe.edit-employe', compact('employe'));
    }

    public function update(Request $request, Employe $employe)
    {
        // 1. Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour l'image
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable|string|max:255',
            'sexe' => 'required',
            'nationalite' => 'required|string|max:255',
            'situation_matrimoniale' => 'required|string|max:255',
            'nombre_enfant' => 'required|integer|min:0',

            'adresse' => 'required|string',
            'contact' => 'required|string|unique:employes,contact,' . $employe->id . '|max:50',
            'email' => 'required|email|unique:employes,email,' . $employe->id . '|max:255',
            'contact_urgence' => 'required|string|max:50',

            'matricule_interne' => 'required|string|unique:employes,matricule_interne,' . $employe->id . '|max:255', // Matricule unique et requis
            'poste' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'lieu_affectation' => 'required|string|max:255',
            'nom_manageur' => 'required|string|max:255',
            'statut' => 'nullable|in:CDI,CDD,Interim,Stage',
            'date_embauche' => 'required|date',
            'date_fin_contrat' => 'nullable|date|after_or_equal:date_embauche',

            'salaire' => 'nullable|numeric|min:0',
            'mode_paiement' => 'nullable|string|max:255',
            'compte_bancaire' => 'nullable|string|max:255',
            'numero_cnps' => 'nullable|string|max:255',
            'equipement_fournis' => 'nullable|string',
        ]);

        // 2. Gestion de l'upload de la photo
        $validatedData['photo'] = $employe->photo;
        if ($request->hasFile('photo')) {
            if ($employe->photo) { Storage::disk('public')->delete($employe->photo); }
            $imagePath = storeImage($request->file('photo'), "EmployePhoto");
            $validatedData['photo'] = $imagePath;
        }

        // 3. Mise à jour de l'employé
        $employe->update($validatedData);

        return redirect()->route('ressource.employe.index')->with('success', "Employé $employe->nom $employe->prenom mis à jour avec succès !");
    }

    public function destroy(Employe $employe)
    {
        //données
            $noms = "$employe->nom $employe->prenom" ;
        //
        if ($employe->photo) { Storage::disk('public')->delete($employe->photo); }
        $employe->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
}
