<?php

namespace App\Http\Controllers\Ressource\Colaborateur;
use App\Models\Conge;

use App\Models\Employe;
use App\Models\Entretien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RessourceCongeController extends Controller
{
    // Affiche le formulaire de demande de congé
    public function create()
    {
        // Aucun Auth::user(), donc pas d’obligation de connexion
        return view('conge');
    }

    // Enregistre la demande
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'email' => 'required|email',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'motif' => 'required|string|max:255',
            'explication' => 'nullable|string',
            'fichier' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
        ]);

        $fichierPath = null;
        if ($request->hasFile('fichier')) {
            $fichierPath = $request->file('fichier')->store('conges_docs');
        }

        Conge::create([
            'user_id' => 0, // valeur par défaut
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'numero' => $request->numero,
            'email' => $request->email,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'motif' => $request->motif,
            'explication' => $request->explication,
            'fichier' => $fichierPath,
            'approuver' => 0,
        ]);

        return redirect()->route('conge.create')->with('success', 'Demande envoyée avec succès, en attente de validation.');
    }


    // Pour la RH : liste les demandes
     public function index()
    {
        $conges = Conge::orderBy('created_at', 'desc')->get();

        $entretiens = [];

        $user = Auth::user();

        $employe = Employe::where('email', $user->email)
            ->where('nom', $user->nom)
            ->where('prenoms', $user->prenoms)
            ->first();

        if ($employe) {
            $entretiens = Entretien::where('employe_id', $employe->id)
                ->where('valide_par_comm', true)
                ->latest()
                ->take(5)
                ->get();
        }

        return view('conges', compact('conges', 'entretiens'));
    }

    // Pour la RH : valider ou refuser une demande
    public function updateStatus(Request $request, Conge $conge)
    {
        $request->validate([
            'approuver' => 'required|in:1,2', // 1=validé, 2=refusé
        ]);

        $conge->approuver = $request->approuver;
        $conge->save();

        return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
    }
}
