<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Entretien;
use App\Models\Employe;
use Illuminate\Http\Request;

class EntretienController extends Controller
{
public function Entretien()
{
    $entretiens = Entretien::with('employe')->latest()->get();
    $employes = Employe::all();
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
    return view('/entretien', compact('entretiens', 'employes'));
}


public function store(Request $request)
{
    $request->validate([
        'employe_id' => 'required|exists:employes,id',
        'date_entretien' => 'required|date',
        'type' => 'required',
    ]);

    Entretien::create([
        'employe_id' => $request->employe_id,
        'auteur_id' => Auth::id(),
        'date_entretien' => $request->date_entretien,
        'type' => $request->type,
        'lieu' => $request->lieu,
        'objectif' => $request->objectif,
    ]);

    return redirect()->route('entretien')->with('success', 'Entretien enregistré.');



}
public function validerParComm($id)
{
    $entretien = Entretien::findOrFail($id);

    // 👉 On supprime la condition sur le rôle pour autoriser tout utilisateur connecté
    // à valider l'entretien

    $entretien->valide_par_comm = true;
    $entretien->save();

    return redirect()->back()->with('success', 'Entretien validé.');
}



}
