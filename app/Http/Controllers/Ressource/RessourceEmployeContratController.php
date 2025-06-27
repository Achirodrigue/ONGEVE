<?php

namespace App\Http\Controllers\Ressource;

use App\Models\Employe;
use Illuminate\Http\Request;
use App\Models\Employecontrat;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RessourceEmployeContratController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        // $employes = Employe::orderBy('updated_at','desc')->get();
        // return view('dashboard.ressource.employe.all-employe', compact('employes'));
    }

    public function create(Employe $employe)
    {
        // return view('dashboard.ressource.employe.add-employe');
    }

    public function store(Request $request, Employe $employe)
    {
        // 1. Validation des données
        $validatedData = $request->validate([
            'type_contrat' => 'required|string|max:255',
            // 'numero_contrat' => 'nullable|string|max:255|unique:employecontrats,numero_contrat',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'status' => 'required|in:Active,Terminé,Expiré',
            'salaire' => 'nullable|numeric|min:0',
            'job_description' => 'nullable|string',
            'horaire_travail' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        
        $employecontrat = Employecontrat::create([
            'type_contrat' => $request->type_contrat,
            // 'numero_contrat' => $request->numer_contrat,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'status' => $request->status,
            'salaire' => $request->salaire,
            'job_description' => $request->job_description,
            'horaire_travail' => $request->horaire_travail,
            'notes' => $request->notes,
        ]);

        // 4. Redirection vers la page de détails de l'employé avec un message de succès
        return redirect()->route('ressource.employecontrat.show', $employe->id)->with('success', 'contratument ajouté avec succès !');
    }

    public function show($employe)
    {
        $employe = Employe::findOrFail($employe);
        // dd($employe->nom);
        // $employe->load('employecontrats');

        return view('dashboard.ressource.employe.contrat.contrat-employe', compact('employe'));
    }

    public function edit(Employe $employe)  
    {
        // return view('dashboard.ressource.employe.edit-employe', compact('employe'));
    }

    public function update(Request $request, Employecontrat $employecontrat)
    {
        // Validation des données
        $validatedData = $request->validate([
            'type_contrat' => 'required|string|max:255',
            // 'numero_contrat' => 'nullable|string|max:255|unique:employecontrats,numero_contrat',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'status' => 'required|in:Active,Terminé,Expiré',
            'salaire' => 'nullable|numeric|min:0',
            'job_description' => 'nullable|string',
            'horaire_travail' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $employecontrat->update($validatedData);

        return redirect()->route('ressource.employecontrat.show', $employecontrat->employe->id)->with('success', 'Contrat mis à jour avec succès !');
    }

    public function destroy(Employecontrat $employecontrat)
    {
        $employecontrat->delete();
        return redirect()->route('ressource.employecontrat.show', $employecontrat->employe->id)->with('success', "Contrat supprimé avec succès !");
    }
}
