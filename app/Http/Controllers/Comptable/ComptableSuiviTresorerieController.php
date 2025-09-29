<?php

namespace App\Http\Controllers\Comptable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComptableSuiviTresorerieController extends Controller
{
    //Bilan
        public function consultationFlux()
        {
            return view('dashboard.comptable.suivi-tresorerie.consultation-flux');
        }
        public function suiviPaiement()
        {
            return view('dashboard.comptable.suivi-tresorerie.suivi-paiement');
        }
        public function suiviAlerteAnomalie()
        {
            return view('dashboard.comptable.suivi-tresorerie.suivi-alerte-anomalie');
        }
    //
}