<?php

namespace App\Http\Controllers\Commercial;

use Mpdf\Mpdf;
use App\Models\Client;
use App\Models\Categorie;
use App\Models\Clientdevis;
use App\Models\Particulier;
use App\Models\Clientremise;
use Illuminate\Http\Request;
use App\Models\Particulierdevis;
use App\Models\Clientdevisremise;
use App\Models\Particulierremise;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Validation\ValidatesRequests;

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
        $clientcommandes = Clientdevis::whereHas('clientdevisinfo', function ($query) {
            $query->where('isvalide', 1);
        })->orderBy('updated_at','desc')->get();

        $TCPCA = 0;
        $clientCA = Clientdevis::whereHas('clientdevisinfo', function ($query) {
            $query->where('isvalide', 1)->where('etat', 1)->where('livraison', 1);
        })->orderBy('updated_at','desc')->get();
        foreach($clientCA as $CchiffreAffaire)
        {
            $TCPCA += $CchiffreAffaire->tva + $CchiffreAffaire->total_ttc + $CchiffreAffaire->frais ;
        }
        // dd($TCPCA);

        return  view('dashboard.commercial.home', 
                compact('clients','clientdevis','clientcommandes','TCPCA'));
    }

    //remise
        public function clientRemise()
        {
            $clientremises = Clientdevisremise::orderBy('updated_at','desc')->get();
            return view('dashboard.commercial.historique-remise.remise-client', compact('clientremises'));
        }
        public function particulierRemise()
        {
            $particulierremises = Particulierremise::orderBy('updated_at','desc')->get();
            return view('dashboard.commercial.historique-remise.remise-particulier', compact('particulierremises'));
        }
    //

    //statistique
        public function statistique()
        {
            $clients = auth()->user()->clients()->orderBy('updated_at','desc')->get();
            $clientdevis = auth()->user()->clientdevis()->orderBy('updated_at','desc')->get();
            $clientcommandes = auth()->user()->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1)->where('etat', 1);
            })->orderBy('updated_at','desc')->get();

            $TCPCA = 0;
            $clientCA = auth()->user()->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1)->where('etat', 1)->where('livraison', 1);
            })->orderBy('updated_at','desc')->get();
            foreach($clientCA as $CchiffreAffaire)
            {
                $TCPCA += $CchiffreAffaire->tva + $CchiffreAffaire->total_ttc + $CchiffreAffaire->frais ;
            }
            // dd($TCPCA);

            return  view('dashboard.commercial.statistique.statistique', 
                    compact('clients','clientdevis','clientcommandes','TCPCA'));
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
        public function rapportParticulier()
        {
            // $n = 1;
            $clientdevis = Auth()->user()->commandelivreurs()->where('isvalide', 0)->get();
            $particulierdevis = Auth()->user()->commandelivreurs()->where('isvalide', 0)->get();
            return view('dashboard.commercial.rapport.particulier.rapport');
        }
    //
}
