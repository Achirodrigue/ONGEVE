<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Employe;
use App\Models\Paie;
use Carbon\Carbon;

class PaieController extends Controller
{
  // Affiche uniquement les bulletins "Payé" du mois courant
    public function paie()
    {
        $moisActuel = now()->format('Y-m');

        $paies = Paie::with('employe')
            ->where('statut', 'Payé')
            ->where('mois', $moisActuel)
            ->orderByDesc('mois')
            ->get();

        return view('paie', compact('paies'));
    }

public function telecharger(Paie $paie)
{
    if ($paie->statut !== 'Payé') {
        return redirect()->back()->with('error', 'Fiche de paie non disponible.');
    }

    $employe = $paie->employe;

    $pdf = Pdf::loadView('fiche_paie', compact('paie', 'employe'));
    return $pdf->download('fiche_paie_'.$employe->nom.'_'.$paie->mois.'.pdf');
}


 public function fichePaies(Request $request)
{
    $paies = [];

    if ($request->filled(['nom', 'prenoms'])) {
        $nom = strtolower($request->nom);
        $prenoms = strtolower($request->prenoms);
        $mois = Carbon::now()->format('Y-m'); // Mois en cours

        $paies = Paie::with('employe')
            ->whereHas('employe', function ($q) use ($nom, $prenoms) {
                $q->whereRaw('LOWER(nom) = ?', [$nom])
                  ->whereRaw('LOWER(prenoms) = ?', [$prenoms]);
            })
            ->where('mois', $mois)
            ->where('statut', 'Payé')
            ->get();
    }

    return view('fiche-paies', compact('paies'));
}
}
