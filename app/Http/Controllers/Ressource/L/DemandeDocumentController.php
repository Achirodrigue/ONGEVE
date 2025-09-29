<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DemandeDocument;

class DemandeDocumentController extends Controller
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
