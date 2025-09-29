<?php

namespace App\Http\Controllers\Comptable;

use App\Models\Depense;
use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fournisseurfacturecomptable;
use Carbon\Carbon;

class ComptableBilanController extends Controller
{
    //Bilans comptables automatisés
        // client
            public function bilanPeriodeFactureClient($ids, $periode, $type)
            {
                // dd(1);
                $idsT = explode(',', $ids); // transforme la chaîne en tableau d'IDs
                $clientdevis = Clientdevis::whereIn('id', $idsT)->get();
                return view('dashboard.comptable.bilan.facture-client.bilan-periode', compact('periode','clientdevis','type'));
            }
            public function bilanSemaineFactureClient()
            {
                $clientdevis = [];

                // 📌 Date de départ fixe
                $startDate = Carbon::create(2025, 8, 1)->startOfWeek();

                // 📌 Date d’aujourd’hui (fin de la boucle)
                $endDate = Carbon::now()->endOfWeek();

                // 🔹 Boucle semaine par semaine en partant d’aujourd’hui
                $current = $endDate->copy();
                while ($current->gte($startDate)) {
                    $end = $current->copy();
                    $start = $current->copy()->startOfWeek();

                    // ⚠️ Ne pas descendre avant le 01/08/2025
                    if ($start->lt($startDate)) {
                        $start = $startDate->copy();
                    }

                    $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                        $query->where('isvalide', 1);
                                    })
                                    ->whereBetween('created_at', [$start, $end])
                                    ->get();

                    $key = 'Semaine ' . $start->format('W') . ' ' . $start->format('Y')
                        . ' : ' . $start->format('d-m-Y')
                        . ' au ' . $end->format('d-m-Y');

                    $clientdevis[$key] = $factures;

                    // Reculer d’une semaine
                    $current->subWeek();
                }

                $clientdevis = collect($clientdevis);

                /*
                    $clientdevis = [];

                    // 🔹 Par semaine (12 dernières semaines)
                    for ($i = 0; $i < 12; $i++) {
                        $start = Carbon::now()->startOfWeek()->subWeeks($i);
                        $end = $start->copy()->endOfWeek();
                        
                        $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                        $query->where('isvalide', 1);
                                    })->whereBetween('created_at', [$start, $end])->get();
                        $key = 'Semaine ' . $start->format('W') . ' ' . $start->format('Y') . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');
                        $clientdevis[$key] = $factures;
                    }

                    $clientdevis = collect($clientdevis);
                */

                return view('dashboard.comptable.bilan.facture-client.bilan-semaine', compact('clientdevis'));
            }
            public function bilanMoisFactureClient()
            {
                $clientdevis = [];

                // 📌 Date de départ
                $startDate = Carbon::create(2025, 8, 1)->startOfMonth();

                // 📌 Date actuelle
                $endDate = Carbon::now()->endOfMonth();

                // 🔹 Boucle du mois courant jusqu’au mois de départ
                $current = $endDate->copy();
                while ($current->gte($startDate)) {
                    $start = $current->copy()->startOfMonth();
                    $end = $current->copy()->endOfMonth();

                    // ⚠️ Empêcher de descendre avant août 2025
                    if ($start->lt($startDate)) {
                        $start = $startDate->copy();
                    }

                    $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                        $query->where('isvalide', 1);
                                    })
                                    ->whereBetween('created_at', [$start, $end])
                                    ->get();

                    $key = $start->translatedFormat('F Y') 
                        . ' : ' . $start->format('d-m-Y') 
                        . ' au ' . $end->format('d-m-Y');

                    $clientdevis[$key] = $factures;

                    // Reculer d’un mois
                    $current->subMonth();
                }

                $clientdevis = collect($clientdevis);

                /*
                    $clientdevis = [];

                    // 🔹 Par mois (12 derniers mois)
                    for ($mois = 1; $mois <= 12; $mois++) {
                        $start = Carbon::createFromDate(2025, $mois, 1)->startOfMonth();
                        $end = $start->copy()->endOfMonth();

                        $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                        $query->where('isvalide', 1);
                                    })->whereBetween('created_at', [$start, $end])->get();

                        $key = $start->translatedFormat('F Y') . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                        $clientdevis[$key] = $factures;
                    }

                    $clientdevis = collect($clientdevis);
                */

                return view('dashboard.comptable.bilan.facture-client.bilan-mois', compact('clientdevis'));
            }
            public function bilanTrimestreFactureClient()
            {
                $clientdevis = [];

                // 📌 Date de départ : août 2025
                $startDate = Carbon::create(2025, 8, 1)->startOfMonth();

                // 📌 Date actuelle
                $endDate = Carbon::now()->endOfMonth();

                // 🔹 Trouver le trimestre en cours
                $current = $endDate->copy()->startOfQuarter();

                while ($current->gte($startDate)) {
                    $start = $current->copy();
                    $end = $current->copy()->endOfQuarter();

                    // ⚠️ Ne pas descendre avant août 2025
                    if ($start->lt($startDate)) {
                        $start = $startDate->copy();
                    }

                    $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                        $query->where('isvalide', 1);
                                    })
                                    ->whereBetween('created_at', [$start, $end])
                                    ->get();

                    // Numéro du trimestre (1 à 4)
                    $quarter = ceil($start->month / 3);

                    $key = 'Trimestre ' . $quarter . ' ' . $start->format('Y')
                        . ' : ' . $start->format('d-m-Y')
                        . ' au ' . $end->format('d-m-Y');

                    $clientdevis[$key] = $factures;

                    // Reculer d’un trimestre
                    $current->subQuarter();
                }

                $clientdevis = collect($clientdevis);

                /*
                    $clientdevis = [];

                    for ($i = 1; $i <= 4; $i++) {
                        // Calcul de la date de début du trimestre
                        $start = Carbon::createFromDate(date('Y'))->startOfYear()->addMonths(3 * ($i - 1));
                        $end = $start->copy()->addMonths(2)->endOfMonth();

                        $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                        $query->where('isvalide', 1);
                                    })->whereBetween('created_at', [$start, $end])->get();

                        $key = 'Trimestre ' . $i . ' ' . $start->format('Y') . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                        $clientdevis[$key] = $factures;
                    }

                    $clientdevis = collect($clientdevis);
                */

                return view('dashboard.comptable.bilan.facture-client.bilan-trimestre', compact('clientdevis'));
            }
            public function bilanAnneeFactureClient()
            {
                $clientdevis = [];

                // 📌 Date de départ
                $startDate = Carbon::create(2025, 8, 1)->startOfDay();

                // 📌 Date actuelle
                $endDate = Carbon::now()->endOfYear();

                // 🔹 Boucle année par année, en partant de l’année courante
                $current = $endDate->copy();
                while ($current->year >= $startDate->year) {
                    $year = $current->year;

                    $start = Carbon::create($year, 1, 1)->startOfYear();
                    $end = Carbon::create($year, 12, 31)->endOfYear();

                    // ⚠️ Si c’est l’année 2025, on commence à août
                    if ($year == 2025) {
                        $start = $startDate->copy();
                    }

                    // ⚠️ Si c’est l’année en cours, on s’arrête à aujourd’hui
                    if ($year == Carbon::now()->year) {
                        $end = Carbon::now()->endOfDay();
                    }

                    $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                        $query->where('isvalide', 1);
                                    })
                                    ->whereBetween('created_at', [$start, $end])
                                    ->get();

                    $key = 'Année ' . $year . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');
                    $clientdevis[$key] = $factures;

                    // Reculer d’une année
                    $current->subYear()->endOfYear();
                }

                $clientdevis = collect($clientdevis);

                /*
                    $clientdevis = [];

                    // 🔹 Par année (5 dernières années)
                    for ($i = 0; $i < 5; $i++) {
                        $year = Carbon::now()->subYears($i)->year;
                        $start = Carbon::create($year, 1, 1)->startOfYear();
                        $end = Carbon::create($year, 12, 31)->endOfYear();

                        $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                        $query->where('isvalide', 1);
                                    })->whereBetween('created_at', [$start, $end])->get();
                        $clientdevis[$year] = $factures;
                    }

                    $clientdevis = collect($clientdevis);
                */

                return view('dashboard.comptable.bilan.facture-client.bilan-annee', compact('clientdevis'));
            }
        //
            public function bilanPeriodeFactureFournisseur($ids, $periode, $type)
            {
                $idsT = explode(',', $ids); // transforme la chaîne en tableau d'IDs
                $fournisseurfacturecomptables = Fournisseurfacturecomptable::whereIn('id', $idsT)->get();
                return view('dashboard.comptable.bilan.facture-fournisseur.bilan-periode', compact('periode','fournisseurfacturecomptables','type'));
            }
        //fournisseur
            public function bilanSemaineFactureFournisseur()
            {
                $fournisseurfacturecomptables = [];

                // 🔹 Par semaine (12 dernières semaines)
                for ($i = 0; $i < 12; $i++) {
                    $start = Carbon::now()->startOfWeek()->subWeeks($i);
                    $end = $start->copy()->endOfWeek();
                    
                    $factures = Fournisseurfacturecomptable::whereBetween('created_at', [$start, $end])->get();
                    $key = 'Semaine ' . $start->format('W') . ' ' . $start->format('Y') . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');
                    $fournisseurfacturecomptables[$key] = $factures;
                }

                $fournisseurfacturecomptables = collect($fournisseurfacturecomptables);

                return view('dashboard.comptable.bilan.facture-fournisseur.bilan-semaine', compact('fournisseurfacturecomptables'));                
            }
            public function bilanMoisFactureFournisseur()
            {
                $fournisseurfacturecomptables = [];

                for ($mois = 1; $mois <= 12; $mois++) {
                    $start = Carbon::createFromDate(2025, $mois, 1)->startOfMonth();
                    $end = $start->copy()->endOfMonth();

                    $factures = Fournisseurfacturecomptable::whereBetween('created_at', [$start, $end])->get();

                    $key = $start->translatedFormat('F Y') . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                    $fournisseurfacturecomptables[$key] = $factures;
                }

                $fournisseurfacturecomptables = collect($fournisseurfacturecomptables);

                return view('dashboard.comptable.bilan.facture-fournisseur.bilan-mois', compact('fournisseurfacturecomptables'));
            }
            public function bilanTrimestreFactureFournisseur()
            {
                $fournisseurfacturecomptables = [];

                // 🔹 Par trimestre (4 derniers trimestres)
                for ($i = 1; $i <= 4; $i++) {
                    // Calcul de la date de début du trimestre
                    $start = Carbon::createFromDate(date('Y'))->startOfYear()->addMonths(3 * ($i - 1));
                    $end = $start->copy()->addMonths(2)->endOfMonth();

                    $factures = Fournisseurfacturecomptable::whereBetween('created_at', [$start, $end])->get();

                    $key = 'Trimestre ' . $i . ' ' . $start->format('Y') . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                    $fournisseurfacturecomptables[$key] = $factures;
                }

                $fournisseurfacturecomptables = collect($fournisseurfacturecomptables);

                return view('dashboard.comptable.bilan.facture-fournisseur.bilan-trimestre', compact('fournisseurfacturecomptables'));
            }
            public function bilanAnneeFactureFournisseur()
            {
                
                $fournisseurfacturecomptables = [];

                // 🔹 Par année (5 dernières années)
                for ($i = 0; $i < 5; $i++) {
                    $year = Carbon::now()->subYears($i)->year;
                    $start = Carbon::create($year, 1, 1)->startOfYear();
                    $end = Carbon::create($year, 12, 31)->endOfYear();

                    $factures = Fournisseurfacturecomptable::whereBetween('created_at', [$start, $end])->get();
                    $fournisseurfacturecomptables[$year] = $factures;
                }

                $fournisseurfacturecomptables = collect($fournisseurfacturecomptables);

                return view('dashboard.comptable.bilan.facture-fournisseur.bilan-annee', compact('fournisseurfacturecomptables'));
            }
        //
        //depense interne
            public function bilanPeriodeDepenseInterne($ids, $periode, $type)
            {
                $idsT = explode(',', $ids); // transforme la chaîne en tableau d'IDs
                $depenses = Depense::whereIn('id', $idsT)->get();
                return view('dashboard.comptable.bilan.depense-interne.bilan-periode', compact('periode','depenses','type'));
            }
            public function bilanSemaineDepenseInterne()
            {
                $depenses = [];

                // 🔹 Par semaine (12 dernières semaines)
                for ($i = 0; $i < 12; $i++) {
                    $start = Carbon::now()->startOfWeek()->subWeeks($i);
                    $end = $start->copy()->endOfWeek();
                    
                    $factures = Depense::whereBetween('created_at', [$start, $end])->get();
                    $key = 'Semaine ' . $start->format('W') . ' ' . $start->format('Y') . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');
                    $depenses[$key] = $factures;
                }

                $depenses = collect($depenses);

                return view('dashboard.comptable.bilan.depense-interne.bilan-semaine', compact('depenses'));
            }
            public function bilanMoisDepenseInterne()
            {
                $depenses = [];

                // 🔹 Par mois (12 derniers mois)
                for ($mois = 1; $mois <= 12; $mois++) {
                    $start = Carbon::createFromDate(2025, $mois, 1)->startOfMonth();
                    $end = $start->copy()->endOfMonth();

                    $factures = Depense::whereBetween('created_at', [$start, $end])->get();

                    $key = $start->translatedFormat('F Y') . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                    $depenses[$key] = $factures;
                }

                $depenses = collect($depenses);

                return view('dashboard.comptable.bilan.depense-interne.bilan-mois', compact('depenses'));
            }
            public function bilanTrimestreDepenseInterne()
            {
                $depenses = [];

                // 🔹 Par trimestre (4 derniers trimestres)
                for ($i = 1; $i <= 4; $i++) {
                    // Calcul de la date de début du trimestre
                    $start = Carbon::createFromDate(date('Y'))->startOfYear()->addMonths(3 * ($i - 1));
                    $end = $start->copy()->addMonths(2)->endOfMonth();

                    $factures = Depense::whereBetween('created_at', [$start, $end])->get();

                    $key = 'Trimestre ' . $i . ' ' . $start->format('Y') . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                    $depenses[$key] = $factures;
                }

                $depenses = collect($depenses);

                return view('dashboard.comptable.bilan.depense-interne.bilan-trimestre', compact('depenses'));
            }
            public function bilanAnneeDepenseInterne()
            {
                $depenses = [];

                // 🔹 Par année (5 dernières années)
                for ($i = 0; $i < 5; $i++) {
                    $year = Carbon::now()->subYears($i)->year;
                    $start = Carbon::create($year, 1, 1)->startOfYear();
                    $end = Carbon::create($year, 12, 31)->endOfYear();

                    $factures = Depense::whereBetween('created_at', [$start, $end])->get();
                    $depenses[$year] = $factures;
                }

                $depenses = collect($depenses);

                return view('dashboard.comptable.bilan.depense-interne.bilan-annee', compact('depenses'));
            }
        //
    //

    /* fonction groupé client
        public function bilanFactureClient($periode = 'semaine')
        {
            $clientdevis = [];

            // 🔹 Point de départ
            $startDate = Carbon::create(2025, 8, 1)->startOfDay();
            $now = Carbon::now();

            switch ($periode) {
                case 'semaine':
                    $current = $now->copy()->endOfWeek();
                    while ($current->gte($startDate)) {
                        $end = $current->copy();
                        $start = $current->copy()->startOfWeek();
                        if ($start->lt($startDate)) $start = $startDate->copy();

                        $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                        $query->where('isvalide', 1);
                                    })->whereBetween('created_at', [$start, $end])->get();

                        $key = 'Semaine ' . $start->format('W') . ' ' . $start->format('Y')
                            . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                        $clientdevis[$key] = $factures;
                        $current->subWeek();
                    }
                    $view = 'dashboard.comptable.bilan.facture-client.bilan-semaine';
                    break;

                case 'mois':
                    $current = $now->copy()->endOfMonth();
                    while ($current->gte($startDate)) {
                        $start = $current->copy()->startOfMonth();
                        $end = $current->copy()->endOfMonth();
                        if ($start->lt($startDate)) $start = $startDate->copy();

                        $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                        $query->where('isvalide', 1);
                                    })->whereBetween('created_at', [$start, $end])->get();

                        $key = $start->translatedFormat('F Y')
                            . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                        $clientdevis[$key] = $factures;
                        $current->subMonth();
                    }
                    $view = 'dashboard.comptable.bilan.facture-client.bilan-mois';
                    break;

                case 'trimestre':
                    $current = $now->copy()->startOfQuarter();
                    while ($current->gte($startDate)) {
                        $start = $current->copy();
                        $end = $current->copy()->endOfQuarter();
                        if ($start->lt($startDate)) $start = $startDate->copy();

                        $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                        $query->where('isvalide', 1);
                                    })->whereBetween('created_at', [$start, $end])->get();

                        $quarter = ceil($start->month / 3);
                        $key = 'Trimestre ' . $quarter . ' ' . $start->format('Y')
                            . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                        $clientdevis[$key] = $factures;
                        $current->subQuarter();
                    }
                    $view = 'dashboard.comptable.bilan.facture-client.bilan-trimestre';
                    break;

                case 'annee':
                    $current = $now->copy()->endOfYear();
                    while ($current->year >= $startDate->year) {
                        $year = $current->year;
                        $start = Carbon::create($year, 1, 1)->startOfYear();
                        $end = Carbon::create($year, 12, 31)->endOfYear();

                        if ($year == 2025) $start = $startDate->copy();
                        if ($year == $now->year) $end = $now->copy()->endOfDay();

                        $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                        $query->where('isvalide', 1);
                                    })->whereBetween('created_at', [$start, $end])->get();

                        $key = 'Année ' . $year
                            . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                        $clientdevis[$key] = $factures;
                        $current->subYear()->endOfYear();
                    }
                    $view = 'dashboard.comptable.bilan.facture-client.bilan-annee';
                    break;

                default:
                    abort(404, "Période invalide !");
            }

            $clientdevis = collect($clientdevis);

            return view($view, compact('clientdevis'));
        }
    */
    /* fonction groupé fournisseur
        public function bilanFactureFournisseur($periode = 'semaine')
        {
            $fournisseurfacturecomptables = [];

            // Point de départ : 01/08/2025
            $startDate = Carbon::create(2025, 8, 1)->startOfDay();
            $now = Carbon::now();

            switch ($periode) {
                case 'semaine':
                    $current = $now->copy()->endOfWeek();
                    while ($current->gte($startDate)) {
                        $end = $current->copy();
                        $start = $current->copy()->startOfWeek();

                        if ($start->lt($startDate)) $start = $startDate->copy();

                        $factures = Fournisseurfacturecomptable::whereBetween('created_at', [$start, $end])->get();
                        $key = 'Semaine ' . $start->format('W') . ' ' . $start->format('Y')
                            . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                        $fournisseurfacturecomptables[$key] = $factures;
                        $current->subWeek();
                    }
                    $view = 'dashboard.comptable.bilan.facture-fournisseur.bilan-semaine';
                    break;

                case 'mois':
                    $current = $now->copy()->endOfMonth();
                    while ($current->gte($startDate)) {
                        $start = $current->copy()->startOfMonth();
                        $end = $current->copy()->endOfMonth();

                        if ($start->lt($startDate)) $start = $startDate->copy();

                        $factures = Fournisseurfacturecomptable::whereBetween('created_at', [$start, $end])->get();
                        $key = $start->translatedFormat('F Y')
                            . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                        $fournisseurfacturecomptables[$key] = $factures;
                        $current->subMonth();
                    }
                    $view = 'dashboard.comptable.bilan.facture-fournisseur.bilan-mois';
                    break;

                case 'trimestre':
                    $current = $now->copy()->startOfQuarter();
                    while ($current->gte($startDate)) {
                        $start = $current->copy();
                        $end = $current->copy()->endOfQuarter();

                        if ($start->lt($startDate)) $start = $startDate->copy();

                        $factures = Fournisseurfacturecomptable::whereBetween('created_at', [$start, $end])->get();
                        $quarter = ceil($start->month / 3);

                        $key = 'Trimestre ' . $quarter . ' ' . $start->format('Y')
                            . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                        $fournisseurfacturecomptables[$key] = $factures;
                        $current->subQuarter();
                    }
                    $view = 'dashboard.comptable.bilan.facture-fournisseur.bilan-trimestre';
                    break;

                case 'annee':
                    $current = $now->copy()->endOfYear();
                    while ($current->year >= $startDate->year) {
                        $year = $current->year;
                        $start = Carbon::create($year, 1, 1)->startOfYear();
                        $end = Carbon::create($year, 12, 31)->endOfYear();

                        if ($year == 2025) $start = $startDate->copy();
                        if ($year == $now->year) $end = $now->copy()->endOfDay();

                        $factures = Fournisseurfacturecomptable::whereBetween('created_at', [$start, $end])->get();
                        $key = 'Année ' . $year . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                        $fournisseurfacturecomptables[$key] = $factures;
                        $current->subYear()->endOfYear();
                    }
                    $view = 'dashboard.comptable.bilan.facture-fournisseur.bilan-annee';
                    break;

                default:
                    abort(404, "Période invalide !");
            }

            $fournisseurfacturecomptables = collect($fournisseurfacturecomptables);

            return view($view, compact('fournisseurfacturecomptables'));
        }
    */
    /* fonction groupé depense
        public function bilanDepenseInterne($periode = 'semaine', $ids = null, $type = null)
        {
            $depenses = [];

            // 🔹 Si des IDs spécifiques sont passés → période personnalisée
            if ($ids) {
                $idsT = explode(',', $ids);
                $depenses = Depense::whereIn('id', $idsT)->get();

                return view('dashboard.comptable.bilan.depense-interne.bilan-periode', compact('periode', 'depenses', 'type'));
            }

            // 🔹 Sinon on calcule par période (semaine / mois / trimestre / année)
            $startDate = Carbon::create(2025, 8, 1)->startOfDay(); // point de départ
            $now = Carbon::now();

            switch ($periode) {
                case 'semaine':
                    $current = $now->copy()->endOfWeek();
                    while ($current->gte($startDate)) {
                        $end = $current->copy();
                        $start = $current->copy()->startOfWeek();
                        if ($start->lt($startDate)) $start = $startDate->copy();

                        $factures = Depense::whereBetween('created_at', [$start, $end])->get();
                        $key = 'Semaine ' . $start->format('W') . ' ' . $start->format('Y')
                            . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                        $depenses[$key] = $factures;
                        $current->subWeek();
                    }
                    $view = 'dashboard.comptable.bilan.depense-interne.bilan-semaine';
                    break;

                case 'mois':
                    $current = $now->copy()->endOfMonth();
                    while ($current->gte($startDate)) {
                        $start = $current->copy()->startOfMonth();
                        $end = $current->copy()->endOfMonth();
                        if ($start->lt($startDate)) $start = $startDate->copy();

                        $factures = Depense::whereBetween('created_at', [$start, $end])->get();
                        $key = $start->translatedFormat('F Y')
                            . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                        $depenses[$key] = $factures;
                        $current->subMonth();
                    }
                    $view = 'dashboard.comptable.bilan.depense-interne.bilan-mois';
                    break;

                case 'trimestre':
                    $current = $now->copy()->startOfQuarter();
                    while ($current->gte($startDate)) {
                        $start = $current->copy();
                        $end = $current->copy()->endOfQuarter();
                        if ($start->lt($startDate)) $start = $startDate->copy();

                        $factures = Depense::whereBetween('created_at', [$start, $end])->get();
                        $quarter = ceil($start->month / 3);

                        $key = 'Trimestre ' . $quarter . ' ' . $start->format('Y')
                            . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                        $depenses[$key] = $factures;
                        $current->subQuarter();
                    }
                    $view = 'dashboard.comptable.bilan.depense-interne.bilan-trimestre';
                    break;

                case 'annee':
                    $current = $now->copy()->endOfYear();
                    while ($current->year >= $startDate->year) {
                        $year = $current->year;
                        $start = Carbon::create($year, 1, 1)->startOfYear();
                        $end = Carbon::create($year, 12, 31)->endOfYear();

                        if ($year == 2025) $start = $startDate->copy();
                        if ($year == $now->year) $end = $now->copy()->endOfDay();

                        $factures = Depense::whereBetween('created_at', [$start, $end])->get();
                        $key = 'Année ' . $year . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                        $depenses[$key] = $factures;
                        $current->subYear()->endOfYear();
                    }
                    $view = 'dashboard.comptable.bilan.depense-interne.bilan-annee';
                    break;

                default:
                    abort(404, "Période invalide !");
            }

            $depenses = collect($depenses);

            return view($view, compact('depenses'));
        }
    */
    /*route global
        // Dépenses internes par période
        Route::get('/bilan-depense-interne/{periode}', [ComptableController::class, 'bilanDepenseInterne']);
        Route::get('/bilan-depense-interne/{periode}/{ids}/{type?}', [ComptableController::class, 'bilanDepenseInterne']);
    */
}
