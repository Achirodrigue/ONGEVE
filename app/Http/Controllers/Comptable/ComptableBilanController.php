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
            public function bilanFactureFiltrer(Request $request)
            {
                // Validation
                $request->validate([
                    'start_date' => 'required|date',
                    'end_date'   => 'nullable|date|after_or_equal:start_date',
                    'TF'         => 'required|in:all,vente,location,prestation',
                ], [
                    'end_date.after_or_equal' => 'La date de fin doit être supérieure ou égale à la date de début.',
                ]);

                $startDate = $request->input('start_date');
                $endDate   = $request->input('end_date');
                $type      = $request->input('TF');

                // Cas 1 : Une seule date (factures de ce jour)
                if ($startDate && !$endDate) {
                    $date = Carbon::parse($startDate);

                    $query = Clientdevis::whereDate('created_at', $date);
                }

                // Cas 2 : Deux dates (factures entre start et end)
                if ($startDate && $endDate) {
                    $start = Carbon::parse($startDate)->startOfDay();
                    $end   = Carbon::parse($endDate)->endOfDay();

                    $query = Clientdevis::whereBetween('created_at', [$start, $end]);
                }

                // ✅ Filtrer par type
                if ($type !== 'all') {
                    if ($type === 'vente') {
                        $query->whereNull('TDF');   // Vente => TD = null
                    } elseif ($type === 'location') {
                        $query->where('TDF', 1);    // Location => TD = 1
                    } elseif ($type === 'prestation') {
                        $query->where('TDF', 2);    // Prestation => TD = 2
                    }
                }

                $factures = $query->orderBy('created_at', 'asc')->get();

                return view('dashboard.comptable.bilan.facture-client.bilan-periode-final', [
                    'clientdevis' => $factures,
                    'startDate' => $startDate,
                    'endDate'   => $endDate,
                    'type'      => $type,
                ]);
            }


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

                        // dd($clientdevis);

                // $montantHT = 0;
                // $tva = 0;
                // $airsiMontant = 0;
                // $timbreMontant = 0;
                // $frais = 0;
                // $versement = 0;
                // $totalPayer = 0;
                // $restePayer = 0;
                // if($clientdevis->count() > 0)
                // {
                //     foreach($clientdevis as $devisclient)
                //     {
                //         // dd($factures->total_ttc);
                //         $montantHT += $devisclient->total_ttc;
                //         $tva += $devisclient->tva ;
                //         $airsiMontant += $devisclient->airsi_montant ;
                //         $timbreMontant += $devisclient->timbre_montant ;
                //         $frais += $devisclient->frais ;
                //         $versement += $devisclient->versement ;
                //         $totalPayer += $devisclient->total_payer ;
                //         $restePayer += $totalPayer - $versement ;
                //     }
                // }


                return view('dashboard.comptable.bilan.facture-client.bilan-semaine', 
                        compact('clientdevis'));
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

                // dd($clientdevis->count());

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
        //fournisseur
            public function bilanPeriodeFactureFournisseur($ids, $periode, $type)
            {
                $idsT = explode(',', $ids); // transforme la chaîne en tableau d'IDs
                $fournisseurfacturecomptables = Fournisseurfacturecomptable::whereIn('id', $idsT)->get();
                return view('dashboard.comptable.bilan.facture-fournisseur.bilan-periode', compact('periode','fournisseurfacturecomptables','type'));
            }
            public function bilanSemaineFactureFournisseur()
            {
                $fournisseurfacturecomptables = [];

                // Date de départ et fin
                $startDate = Carbon::create(2025, 8, 1)->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();

                $current = $endDate->copy();
                while ($current->gte($startDate)) {
                    $end = $current->copy();
                    $start = $current->copy()->startOfWeek();

                    if ($start->lt($startDate)) {
                        $start = $startDate->copy();
                    }

                    $factures = Fournisseurfacturecomptable::whereBetween('created_at', [$start, $end])->get();

                    $key = 'Semaine ' . $start->format('W') . ' ' . $start->format('Y')
                        . ' : ' . $start->format('d-m-Y')
                        . ' au ' . $end->format('d-m-Y');

                    $fournisseurfacturecomptables[$key] = $factures;

                    $current->subWeek();
                }

                $fournisseurfacturecomptables = collect($fournisseurfacturecomptables);

                return view('dashboard.comptable.bilan.facture-fournisseur.bilan-semaine', compact('fournisseurfacturecomptables'));                
            }
            public function bilanMoisFactureFournisseur()
            {
                $fournisseurfacturecomptables = [];

                $startDate = Carbon::create(2025, 8, 1)->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();

                $current = $endDate->copy();
                while ($current->gte($startDate)) {
                    $start = $current->copy()->startOfMonth();
                    $end = $current->copy()->endOfMonth();

                    if ($start->lt($startDate)) {
                        $start = $startDate->copy();
                    }

                    $factures = Fournisseurfacturecomptable::whereBetween('created_at', [$start, $end])->get();

                    $key = $start->translatedFormat('F Y')
                        . ' : ' . $start->format('d-m-Y')
                        . ' au ' . $end->format('d-m-Y');

                    $fournisseurfacturecomptables[$key] = $factures;

                    $current->subMonth();
                }

                $fournisseurfacturecomptables = collect($fournisseurfacturecomptables);

                return view('dashboard.comptable.bilan.facture-fournisseur.bilan-mois', compact('fournisseurfacturecomptables'));
            }
            public function bilanTrimestreFactureFournisseur()
            {
                $fournisseurfacturecomptables = [];

                $startDate = Carbon::create(2025, 8, 1)->startOfMonth();
                $endDate = Carbon::now()->endOfQuarter();

                $current = $endDate->copy()->startOfQuarter();
                while ($current->gte($startDate)) {
                    $start = $current->copy();
                    $end = $current->copy()->endOfQuarter();

                    if ($start->lt($startDate)) {
                        $start = $startDate->copy();
                    }

                    $factures = Fournisseurfacturecomptable::whereBetween('created_at', [$start, $end])->get();

                    $quarter = ceil($start->month / 3);
                    $key = 'Trimestre ' . $quarter . ' ' . $start->format('Y')
                        . ' : ' . $start->format('d-m-Y')
                        . ' au ' . $end->format('d-m-Y');

                    $fournisseurfacturecomptables[$key] = $factures;

                    $current->subQuarter();
                }

                $fournisseurfacturecomptables = collect($fournisseurfacturecomptables);

                return view('dashboard.comptable.bilan.facture-fournisseur.bilan-trimestre', compact('fournisseurfacturecomptables'));
            }
            public function bilanAnneeFactureFournisseur()
            {
                $fournisseurfacturecomptables = [];

                $startDate = Carbon::create(2025, 8, 1)->startOfDay();
                $endDate = Carbon::now()->endOfYear();

                $current = $endDate->copy();
                while ($current->year >= $startDate->year) {
                    $year = $current->year;

                    $start = Carbon::create($year, 1, 1)->startOfYear();
                    $end = Carbon::create($year, 12, 31)->endOfYear();

                    if ($year == 2025) {
                        $start = $startDate->copy();
                    }

                    if ($year == Carbon::now()->year) {
                        $end = Carbon::now()->endOfDay();
                    }

                    $factures = Fournisseurfacturecomptable::whereBetween('created_at', [$start, $end])->get();

                    $key = 'Année ' . $year
                        . ' : ' . $start->format('d-m-Y')
                        . ' au ' . $end->format('d-m-Y');

                    $fournisseurfacturecomptables[$key] = $factures;

                    $current->subYear()->endOfYear();
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

                $startDate = Carbon::create(2025, 8, 1)->startOfWeek();
                $current = Carbon::now()->endOfWeek();

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

                $depenses = collect($depenses);
                return view('dashboard.comptable.bilan.depense-interne.bilan-semaine', compact('depenses'));
            }
            public function bilanMoisDepenseInterne()
            {
                $depenses = [];

                $startDate = Carbon::create(2025, 8, 1)->startOfMonth();
                $current = Carbon::now()->endOfMonth();

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

                $depenses = collect($depenses);
                return view('dashboard.comptable.bilan.depense-interne.bilan-mois', compact('depenses'));
            }
            public function bilanTrimestreDepenseInterne()
            {
                $depenses = [];

                $startDate = Carbon::create(2025, 8, 1)->startOfMonth();
                $current = Carbon::now()->startOfQuarter();

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

                $depenses = collect($depenses);
                return view('dashboard.comptable.bilan.depense-interne.bilan-trimestre', compact('depenses'));
            }
            public function bilanAnneeDepenseInterne()
            {
                $depenses = [];

                $startDate = Carbon::create(2025, 8, 1)->startOfDay();
                $current = Carbon::now()->endOfYear();

                while ($current->year >= $startDate->year) {
                    $year = $current->year;
                    $start = Carbon::create($year, 1, 1)->startOfYear();
                    $end = Carbon::create($year, 12, 31)->endOfYear();

                    if ($year == 2025) $start = $startDate->copy();
                    if ($year == Carbon::now()->year) $end = Carbon::now()->copy()->endOfDay();

                    $factures = Depense::whereBetween('created_at', [$start, $end])->get();
                    $key = 'Année ' . $year . ' : ' . $start->format('d-m-Y') . ' au ' . $end->format('d-m-Y');

                    $depenses[$key] = $factures;
                    $current->subYear()->endOfYear();
                }

                $depenses = collect($depenses);
                return view('dashboard.comptable.bilan.depense-interne.bilan-annee', compact('depenses'));
            }
        //
    //
}
