<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Models\Clientdevisavoir;
use App\Models\Particulierdevis;
use App\Http\Controllers\Controller;
use App\Models\Clientdevisavoirprod;
use App\Models\Clientdevistransaction;
use Illuminate\Support\Facades\Storage;

class AdminCommandeController extends Controller
{
    //client
        public function commandeClientImpaye()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
            return view('dashboard.admin.client.general.commande-impaye', compact('clientdevis'));
        }
        public function commandeClientPaye()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
            return view('dashboard.admin.client.general.commande-paye', compact('clientdevis'));
        }
        public function commandeClientPartielle()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            return view('dashboard.admin.client.general.commande-partielle', compact('clientdevis'));
        }

        public function commandeClientDetail(Clientdevis $clientdevis)
        {
            return view('dashboard.admin.client.general.commande-detail', compact('clientdevis'));
        }
        public function commandeClientVersement(Clientdevis $clientdevis)
        {
            return view('dashboard.admin.client.general.commande-versement', compact('clientdevis'));
        }
    //
}
