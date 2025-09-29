<?php

namespace App\Http\Controllers\Admin;

use App\Models\Commercial;
use App\Models\Clientdevis;
use App\Models\Clientdevisremise;
use Illuminate\Routing\Controller;

class AdminCommercialController extends Controller
{
    //devis 
        public function devisClientEncours()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 0);
            })->orderBy('updated_at','desc')->get();

            return view('dashboard.admin.commercial.devis.devis-encours', compact('clientdevis'));
        }
    //
    //commercial
        public function allCommercial()
        {
            $commercials = Commercial::orderBy('updated_at','desc')->get()->except(auth()->user()->id);
            return view('dashboard.admin.commercial.commercial.all-commercial', compact('commercials'));
        }
    //
    //Historique remise
        public function clientRemise()
        {
            $clientremises = Clientdevisremise::orderBy('updated_at','desc')->get();
            return view('dashboard.admin.commercial.remise.remise-client', compact('clientremises'));
        }
    //
}
