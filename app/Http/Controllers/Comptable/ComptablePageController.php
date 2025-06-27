<?php

namespace App\Http\Controllers\Comptable;

use Mpdf\Mpdf;
use App\Models\Client;
use App\Models\Clientdevis;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ComptablePageController extends Controller
{
    use ValidatesRequests;

    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('comptable.login'));
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

        return  view('dashboard.comptable.home', 
                compact('clients','clientdevis','clientcommandes','TCPCA'));
    }

}
