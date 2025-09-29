<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Employe;
use App\Models\Entretien;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index()
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
    return view('dashboard', compact('entretiens'));  // Assure-toi que cette vue existe
}


}
