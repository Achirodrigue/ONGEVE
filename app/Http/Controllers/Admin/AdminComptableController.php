<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Depense;
use App\Models\Clientdevis;
use Illuminate\Routing\Controller;
use App\Models\Fournisseurfacturecomptable;

class AdminComptableController extends Controller
{
    //Bilans comptables automatisés
        // client
            public function bilanSemaineFactureClient()
            {
                $clientdevis = [];

                // 🔹 Par semaine (12 dernières semaines)
                for ($i = 0; $i < 12; $i++) {
                    $start = Carbon::now()->startOfWeek()->subWeeks($i);
                    $end = $start->copy()->endOfWeek();
                    
                    $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                    $query->where('isvalide', 1);
                                })->whereBetween('created_at', [$start, $end])->get();
                    $key = 'Semaine ' . $start->format('W') . ' ' . $start->format('Y') . ' : ' . $start->format('d/m/Y') . ' / ' . $end->format('d/m/Y');
                    $clientdevis[$key] = $factures;
                }

                $clientdevis = collect($clientdevis);

                return view('dashboard.admin.comptable.bilan.facture-client.bilan-semaine', compact('clientdevis'));
            }
            public function bilanMoisFactureClient()
            {
                $clientdevis = [];

                // 🔹 Par mois (12 derniers mois)
                for ($mois = 1; $mois <= 12; $mois++) {
                    $start = Carbon::createFromDate(2025, $mois, 1)->startOfMonth();
                    $end = $start->copy()->endOfMonth();

                    $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                    $query->where('isvalide', 1);
                                })->whereBetween('created_at', [$start, $end])->get();

                    $key = $start->translatedFormat('F Y') . ' : ' . $start->format('d/m/Y') . ' / ' . $end->format('d/m/Y');

                    $clientdevis[$key] = $factures;
                }

                $clientdevis = collect($clientdevis);

                return view('dashboard.admin.comptable.bilan.facture-client.bilan-mois', compact('clientdevis'));
            }
            public function bilanTrimestreFactureClient()
            {
                $clientdevis = [];

                for ($i = 1; $i <= 4; $i++) {
                    // Calcul de la date de début du trimestre
                    $start = Carbon::createFromDate(date('Y'))->startOfYear()->addMonths(3 * ($i - 1));
                    $end = $start->copy()->addMonths(2)->endOfMonth();

                    $factures = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                    $query->where('isvalide', 1);
                                })->whereBetween('created_at', [$start, $end])->get();

                    $key = 'Trimestre ' . $i . ' ' . $start->format('Y') . ' : ' . $start->format('d/m/Y') . ' / ' . $end->format('d/m/Y');

                    $clientdevis[$key] = $factures;
                }

                $clientdevis = collect($clientdevis);

                return view('dashboard.admin.comptable.bilan.facture-client.bilan-trimestre', compact('clientdevis'));
            }
            public function bilanAnneeFactureClient()
            {
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

                return view('dashboard.admin.comptable.bilan.facture-client.bilan-annee', compact('clientdevis'));
            }
        //
        //fournisseur
            public function bilanSemaineFactureFournisseur()
            {
                $fournisseurfacturecomptables = [];

                // 🔹 Par semaine (12 dernières semaines)
                for ($i = 0; $i < 12; $i++) {
                    $start = Carbon::now()->startOfWeek()->subWeeks($i);
                    $end = $start->copy()->endOfWeek();
                    
                    $factures = Fournisseurfacturecomptable::whereBetween('created_at', [$start, $end])->get();
                    $key = 'Semaine ' . $start->format('W') . ' ' . $start->format('Y') . ' : ' . $start->format('d/m/Y') . ' / ' . $end->format('d/m/Y');
                    $fournisseurfacturecomptables[$key] = $factures;
                }

                $fournisseurfacturecomptables = collect($fournisseurfacturecomptables);

                return view('dashboard.admin.comptable.bilan.facture-fournisseur.bilan-semaine', compact('fournisseurfacturecomptables'));             
            }
            public function bilanMoisFactureFournisseur()
            {
                $fournisseurfacturecomptables = [];

                for ($mois = 1; $mois <= 12; $mois++) {
                    $start = Carbon::createFromDate(2025, $mois, 1)->startOfMonth();
                    $end = $start->copy()->endOfMonth();

                    $factures = Fournisseurfacturecomptable::whereBetween('created_at', [$start, $end])->get();

                    $key = $start->translatedFormat('F Y') . ' : ' . $start->format('d/m/Y') . ' / ' . $end->format('d/m/Y');

                    $fournisseurfacturecomptables[$key] = $factures;
                }

                $fournisseurfacturecomptables = collect($fournisseurfacturecomptables);

                return view('dashboard.admin.comptable.bilan.facture-fournisseur.bilan-mois', compact('fournisseurfacturecomptables'));
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

                    $key = 'Trimestre ' . $i . ' ' . $start->format('Y') . ' : ' . $start->format('d/m/Y') . ' / ' . $end->format('d/m/Y');

                    $fournisseurfacturecomptables[$key] = $factures;
                }

                $fournisseurfacturecomptables = collect($fournisseurfacturecomptables);

                return view('dashboard.admin.comptable.bilan.facture-fournisseur.bilan-trimestre', compact('fournisseurfacturecomptables'));
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

                return view('dashboard.admin.comptable.bilan.facture-fournisseur.bilan-annee', compact('fournisseurfacturecomptables'));
            }
        //
        //depense interne
            public function bilanSemaineDepenseInterne()
            {
                $depenses = [];

                // 🔹 Par semaine (12 dernières semaines)
                for ($i = 0; $i < 12; $i++) {
                    $start = Carbon::now()->startOfWeek()->subWeeks($i);
                    $end = $start->copy()->endOfWeek();
                    
                    $factures = Depense::whereBetween('created_at', [$start, $end])->get();
                    $key = 'Semaine ' . $start->format('W') . ' ' . $start->format('Y') . ' : ' . $start->format('d/m/Y') . ' / ' . $end->format('d/m/Y');
                    $depenses[$key] = $factures;
                }

                $depenses = collect($depenses);

                return view('dashboard.admin.comptable.bilan.depense-interne.bilan-semaine', compact('depenses'));
            }
            public function bilanMoisDepenseInterne()
            {
                $depenses = [];

                // 🔹 Par mois (12 derniers mois)
                for ($mois = 1; $mois <= 12; $mois++) {
                    $start = Carbon::createFromDate(2025, $mois, 1)->startOfMonth();
                    $end = $start->copy()->endOfMonth();

                    $factures = Depense::whereBetween('created_at', [$start, $end])->get();

                    $key = $start->translatedFormat('F Y') . ' : ' . $start->format('d/m/Y') . ' / ' . $end->format('d/m/Y');

                    $depenses[$key] = $factures;
                }

                $depenses = collect($depenses);

                return view('dashboard.admin.comptable.bilan.depense-interne.bilan-mois', compact('depenses'));
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

                    $key = 'Trimestre ' . $i . ' ' . $start->format('Y') . ' : ' . $start->format('d/m/Y') . ' / ' . $end->format('d/m/Y');

                    $depenses[$key] = $factures;
                }

                $depenses = collect($depenses);

                return view('dashboard.admin.comptable.bilan.depense-interne.bilan-trimestre', compact('depenses'));
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

                return view('dashboard.admin.comptable.bilan.depense-interne.bilan-annee', compact('depenses'));
            }
        //
    //
}
