<?php

namespace App\Http\Controllers\Ressource;

use App\Models\Employe;
use App\Models\Employedoc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RessourceEmployeDocumentController extends Controller
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
        // dd($employe->id);
        // 1. Validation des données
        $validatedData = $request->validate([
            'nom_document' => 'required|string|max:255',
            'type_document' => 'required|string|max:50', // Ou 'required|in:CNI,PASSPORT,...' si on voulait une liste fixe
            'fichier' => 'required|file|max:5120|mimes:pdf,doc,docx,jpg,jpeg,png', // Max 5MB, types autorisés
            'date_expiration' => 'nullable|date',
            'description' => 'nullable|string|max:1000',
        ]);

        // 2. Gestion de l'upload du fichier
        if ($request->hasFile('fichier')) {
            $fichier = storeImage($request->file('fichier'), "EmployeDocumentFichier");
        }

        // 3. Création du document lié à l'employé
        // $employe->employedocs()->create($validatedData); // Crée le document et l'associe à l'employé
        
        $employedoc = Employedoc::create([
            'nom_document' => $request->nom_document,
            'type_document' => $request->type_document ,
            'fichier' => $fichier ,
            'date_expiration' => $request->date_expiration,
            'description' => $request->description,
            'employe_id' => $employe->id,
        ]);

        // 4. Redirection vers la page de détails de l'employé avec un message de succès
        return redirect()->route('ressource.employedoc.show', $employe->id)->with('success', 'Document ajouté avec succès !');
    }

    public function show($employe)
    {
        $employe = Employe::findOrFail($employe);
        // dd($employe->nom);
        // $employe->load('employedocs');

        return view('dashboard.ressource.employe.doc.doc-employe', compact('employe'));
    }

    public function edit(Employe $employe)  
    {
        // return view('dashboard.ressource.employe.edit-employe', compact('employe'));
    }

    public function update(Request $request, Employedoc $employedoc)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom_document' => 'required|string|max:255',
            'type_document' => 'required|string|max:50',
            'fichier' => 'nullable|file|max:5120|mimes:pdf,doc,docx,jpg,jpeg,png', // Fichier optionnel lors de la modification
            'date_expiration' => 'nullable|date',
            'description' => 'nullable|string|max:1000',
        ]);

        // Gestion de l'upload du nouveau fichier (si fourni)
        if ($request->hasFile('fichier')) {
            // Supprime l'ancien fichier si un nouveau est uploadé
            Storage::disk('public')->delete($employedoc->fichier);

            $filePath = storeImage($request->file('fichier'), "EmployeDocumentFichier");
            $validatedData['fichier'] = $filePath;
        }else{
            $validatedData['fichier'] = $employedoc->fichier;
        }

        $employedoc->update($validatedData);

        return redirect()->route('ressource.employedoc.show', $employedoc->employe->id)->with('success', 'Document mis à jour avec succès !');
    }

    public function destroy(Employedoc $employedoc)
    {
        // Supprime le fichier du stockage avant de supprimer l'entrée de la base de données
        if ($employedoc->fichier) {
            Storage::disk('public')->delete($employedoc->fichier);
        }
        $employedoc->delete();
        return redirect()->route('ressource.employedoc.show', $employedoc->employe->id)->with('success', "Document supprimé avec succès !");
    }
}
