<?php

namespace App\Http\Controllers\Ressource\Colaborateur;

use Illuminate\Http\Request;
use App\Models\DemandeDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RessourceDemandeDocumentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom_demandeur' => 'required|string|max:255',
            'prenoms_demandeur' => 'required|string|max:255',
            'type_document' => 'required|string|max:255',
            'titre_document' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'destinataire_id' => 'required|exists:users,id',
        ]);

        DemandeDocument::create([
            'nom_demandeur' => $request->nom_demandeur,
            'prenoms_demandeur' => $request->prenoms_demandeur,
            'destinataire_id' => $request->destinataire_id,
            'type_document' => $request->type_document,
            'titre_document' => $request->titre_document,
            'description' => $request->description,
            'statut' => 'en attente',
        ]);

        return redirect()->back()->with('success', 'Demande envoyée avec succès.');
    }
}
