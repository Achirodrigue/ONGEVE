<?php

namespace App\Http\Controllers\Ressource\Colaborateur;

use Carbon\Carbon;
use App\Models\Paie;
use App\Models\User;
use App\Models\Conge;
use App\Models\Employe;
use App\Models\Entretien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RessourcePaiementController extends Controller
{
public function index()
{
    $mois = Carbon::now()->format('Y-m');
    $entretiens = [];
    $employes = Employe::where('statut', 'Actif')->get(); // Liste complète
    $paies = Paie::where('mois', $mois)->get()->keyBy('employe_id');

    return view('paiement', [
        'mois' => $mois,
        'employes' => $employes,
        'paies' => $paies,
        'entretiens' => $entretiens,
    ]);
}



    public function payer(Request $request, Employe $employe)
{
    $mois = Carbon::now()->format('Y-m');

    $paie = Paie::firstOrNew([
        'employe_id' => $employe->id,
        'mois' => $mois,
    ]);

    // Données depuis le formulaire
    $paie->salaire_base = $employe->salaire_de_base;
    $paie->primes = $request->input('primes', 0);
    $paie->heures_supplementaires = $request->input('heures_supplementaires', 0);
    $paie->montant_heures_supplementaires = $request->input('montant_heures_supplementaires', 0);
    $paie->indemnites = $request->input('indemnites', 0);

    $paie->cnps = $request->input('cnps', 0);
    $paie->impot = $request->input('impot', 0);
    $paie->avance_salaire = $request->input('avance_salaire', 0);
    $paie->autres_retenues = $request->input('autres_retenues', 0);

    // Calcul du salaire net
    $paie->salaire_net =
        $paie->salaire_base +
        $paie->primes +
        $paie->montant_heures_supplementaires +
        $paie->indemnites
        - $paie->cnps
        - $paie->impot
        - $paie->avance_salaire
        - $paie->autres_retenues;

    $paie->mode_paiement = $request->input('mode_paiement', 'Espèce');
    $paie->statut = 'Payé';
    $paie->date_paiement = now();
    $paie->save();

    return redirect()->route('paiement.index')->with('success', "Paiement effectué pour {$employe->nom}.");
}


}
