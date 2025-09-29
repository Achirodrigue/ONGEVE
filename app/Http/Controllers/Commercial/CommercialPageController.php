<?php

namespace App\Http\Controllers\Commercial;

use App\Models\Client;
use App\Models\Projet;
use App\Models\Categorie;
use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Models\Clientdevisremise;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommercialPageController extends Controller
{
    use ValidatesRequests;

    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('commercial.login'));
    }
    
    public function home()
    { 
        $clients = Client::orderBy('updated_at','desc')->get();
        $clientdevis = Clientdevis::orderBy('updated_at','desc')->get();
        $AuthClients = [];
        $CA = 0;
        $MT = 0;

        if(!auth()->user()->role)
        {
            //commercial
                $AuthClients = auth()->user()->clients()->orderBy('updated_at','desc')->get();

                $clientdevis = auth()->user()->clientdevis()->orderBy('updated_at','desc')->get();
            //
        }

        foreach($clientdevis as $ChiffreAffaire)
        {
            $CA += $ChiffreAffaire->versement ;
            $MT += $ChiffreAffaire->total_payer ;
        }

        return  view('dashboard.commercial.home',
                compact('clients','clientdevis','AuthClients','CA','MT'));
    }

    //projet   
        public function projet()
        { 
            if(!PageAccessibleCommercial()) 
            {
                return redirect()->route('commercial.home')->with('error',"Désolé! vous n'êtes pas un responsable commercial pour effectuer cette opération");
            } 

            $projets = Projet::orderBy('updated_at','desc')->get();
            return  view('dashboard.commercial.projet.projet', compact('projets'));
        }
        public function projetTache(Projet $projet)
        { 
            if(!PageAccessibleCommercial()) 
            {
                return redirect()->route('commercial.home')->with('error',"Désolé! vous n'êtes pas un responsable commercial pour effectuer cette opération");
            } 
            
            return  view('dashboard.commercial.projet.projet-tache', compact('projet'));
        }
    //

    //remise / à supprimer
        public function clientRemise()
        {
            $clientremises = Clientdevisremise::orderBy('updated_at','desc')->get();
            if(!auth()->user()->role)
            {
                $clientremises = auth()->user()->clientdevisremises()->orderBy('updated_at','desc')->get();
            }
            return view('dashboard.commercial.historique-remise.remise-client', compact('clientremises'));
        }
        // public function particulierRemise()
        // {
        //     $particulierremises = Particulierremise::orderBy('updated_at','desc')->get();
        //     return view('dashboard.commercial.historique-remise.remise-particulier', compact('particulierremises'));
        // }
    //

    //statistique
        public function statistique()
        {
            $clients = Client::orderBy('updated_at','desc')->get();
            $DevisCA = 0;
            $DevisMT = 0;
            $FactureCA = 0;
            $FactureMT = 0;
            // dd(1);

            $AuthClients = auth()->user()->clients()->orderBy('updated_at','desc')->get();

            $clientdevis = auth()->user()->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 0);
                })->get();

            $clientdevisfactures = auth()->user()->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->get();

            foreach($clientdevis as $DevisChiffreAffaire)
            {
                $DevisCA += $DevisChiffreAffaire->versement ;
                $DevisMT += $DevisChiffreAffaire->total_payer ;
            }
            foreach($clientdevisfactures as $FactureChiffreAffaire)
            {
                $FactureCA += $FactureChiffreAffaire->versement ;
                $FactureMT += $FactureChiffreAffaire->total_payer ;
            }

            // dd($DevisMT);

            return  view('dashboard.commercial.statistique.statistique', 
                    compact('clients','clientdevis','clientdevisfactures','AuthClients','DevisCA','DevisMT','FactureCA','FactureMT'));
        }
        public function statistiqueAnnee(Request $request)
        {
            $startYear = 2024;
            $currentYear = now()->year;
            $selectedYear = $request->input('year', $currentYear);

            // Récupération par mois
            $devisData = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })
                        ->select(
                            DB::raw('YEAR(created_at) as year'),
                            DB::raw('MONTH(created_at) as month'),
                            DB::raw('COUNT(*) as total')
                        )
                        ->where('commercial_id', auth()->user()->id)
                        ->whereYear('created_at', $selectedYear)
                        ->groupBy('year', 'month')
                        ->orderBy('month')
                        ->get();
            // dd($devisData);

            // Structure pour le graphe
            $chartData = [];
            foreach (range(1, 12) as $m) {
                $monthName = Carbon::create()->month($m)->format('F');
                $chartData[$monthName] = 0;
            }
            foreach ($devisData as $row) {
                $monthName = Carbon::create()->month($row->month)->format('F');
                $chartData[$monthName] = $row->total;
            }

            return view('dashboard.commercial.statistique.statistique-annee', [
                'startYear'   => $startYear,
                'currentYear' => $currentYear,
                'selectedYear'=> $selectedYear,
                'chartData'   => $chartData
            ]);
        }
        public function statistiqueMois($year, $month)
        {
            $clientdevis = Clientdevis::where('commercial_id', auth()->user()->id)
                        ->whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get();

            $monthName = Carbon::create()->month($month)->translatedFormat('F');

            return view('dashboard.commercial.statistique.statistique-mois', [
                'clientdevis' => $clientdevis,
                'year'  => $year,
                'month' => $month,
                'monthName' => $monthName
            ]);
        }
    //
    
    //stock
        public function StockProduit(Categorie $categorie)
        {
            $produits = $categorie->produits()->orderBy('updated_at', 'desc')->get();

            return view('dashboard.commercial.historique-stock.entrepot', compact('produits','categorie'));
        }
    //
    
    //rapport
        public function rapportClient()
        {
            // $n = 1;
            $clientdevis = Auth()->user()->clientdevis()->get();
            $clients = Auth()->user()->clients()->get();
            return view('dashboard.commercial.rapport.client.rapport', compact('clientdevis','clients'));
        }
        // public function rapportParticulier()
        // {
        //     // $n = 1;
        //     $clientdevis = Auth()->user()->commandelivreurs()->where('isvalide', 0)->get();
        //     $particulierdevis = Auth()->user()->commandelivreurs()->where('isvalide', 0)->get();
        //     return view('dashboard.commercial.rapport.particulier.rapport');
        // }
    //
}
