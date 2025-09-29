<?php

namespace App\Http\Controllers\Ressource\Colaborateur;
use App\Models\Paie;
use App\Models\User;
use App\Models\Employe;
use App\Models\Entretien;
use Illuminate\Http\Request;

use App\Models\DemandeDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RessourceEmployeController extends Controller
{
        // 🏠 Affiche la page welcome
    public function index()
    {
          $user = Auth::user();

    $employe = Employe::where('email', $user->email)
        ->where('nom', $user->nom)
        ->where('prenoms', $user->prenoms)
        ->first();

    $entretiens = [];
    // dd(5);

    if ($employe) {
        $entretiens = Entretien::where('employe_id', $employe->id)
            ->where('valide_par_comm', true) // ✅ uniquement ceux validés par la communication
            ->latest()
            ->take(5)
            ->get();
    }
        return view('dashboard.ressource.ange.welcome', compact('entretiens'));
    }

       public function store(Request $request)
    {
        // 🔍 Validation des champs
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenoms' => 'required|string|max:150',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:100',
            'genre' => 'required|in:Homme,Femme,Autre',
            'email' => 'required|email|max:100',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string',

            'photo_profil' => 'nullable|image|max:2048',

            'matricule' => 'required|string|max:50',
            'poste' => 'required|string|max:100',
            'grade' => 'required|string|max:50',
            'departement_id' => 'nullable|integer',
            'superieur_id' => 'nullable|integer',
            'statut' => 'required|in:Actif,Suspendu,Démissionnaire',
            'date_embauche' => 'required|date',
            'type_contrat' => 'required|in:CDI,CDD,Stage',
            'salaire_de_base' => 'required|numeric',
            'devise' => 'required|string|max:10',
            'nb_heures_semaine' => 'required|integer',

            'cv_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'lettre_motivation_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'contrat_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'photo_piece_identite_path' => 'nullable|image|max:2048',

            'num_cnps' => 'nullable|string|max:50',
            'num_impots' => 'nullable|string|max:50',
            'banque' => 'nullable|string|max:100',
            'num_compte_bancaire' => 'nullable|string|max:100',
            'situation_matrimoniale' => 'required|in:Célibataire,Marié(e),Divorcé(e)',
            'nb_enfants' => 'nullable|integer',
            'niveau_etude' => 'nullable|string|max:100',
            'dernier_etablissement' => 'nullable|string|max:150',

            'user_id' => 'nullable|integer',
        ]);

       // 📂 Gestion sécurisée des fichiers uploadés
$uploads = [
    'photo_profil' => 'photos',
    'cv_path' => 'documents/cv',
    'lettre_motivation_path' => 'documents/lettres',
    'contrat_path' => 'documents/contrats',
    'photo_piece_identite_path' => 'documents/pieces_identite'
];

foreach ($uploads as $champ => $repertoire) {
    if ($request->hasFile($champ) && $request->file($champ)->isValid()) {
        $validated[$champ] = $request->file($champ)->store($repertoire, 'public');
    }
}

        // 💾 Enregistrement en base
        Employe::create($validated);

        return response()->json(['message' => 'Employé ajouté avec succès.'], 201);
    }


    public function liste()
{
              $user = Auth::user();

    $employe = Employe::where('email', $user->email)
        ->where('nom', $user->nom)
        ->where('prenoms', $user->prenoms)
        ->first();

    $entretiens = [];

    if ($employe) {
        $entretiens = Entretien::where('employe_id', $employe->id)
            ->where('valide_par_comm', true) // ✅ uniquement ceux validés par la communication
            ->latest()
            ->take(5)
            ->get();
    }
    $employes = \App\Models\Employe::latest()->get(); // tu peux ajouter `->with('departement')` si besoin
    return view('dashboard.ressource.ange.liste', compact('employes','entretiens'));
}


public function conge()
{
    // Exemple : récupérer des données de congés si besoin
    // $conges = Conge::all();
    $user = Auth::user();
    return view('dashboard.ressource.ange.conge'); // crée cette vue dans resources/views/conge.blade.php
}
public function document()
{
             $user = Auth::user();

    $employe = Employe::where('email', $user->email)
        ->where('nom', $user->nom)
        ->where('prenoms', $user->prenoms)
        ->first();

    $entretiens = [];

    if ($employe) {
        $entretiens = Entretien::where('employe_id', $employe->id)
            ->where('valide_par_comm', true) // ✅ uniquement ceux validés par la communication
            ->latest()
            ->take(5)
            ->get();
    }
    $demandes = DemandeDocument::where('demandeur_id', Auth::id())
        ->orderByDesc('created_at')
        ->get();

    return view('dashboard.ressource.ange.document', compact('demandes','entretiens')); // crée cette vue dans resources/views/conge.blade.php
}



}
