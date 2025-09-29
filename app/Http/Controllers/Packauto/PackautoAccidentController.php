<?php

namespace App\Http\Controllers\Packauto;

use App\Models\Paccident;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class PackautoAccidentController extends Controller
{
    //Accident
        public function accident()
        {
            $paccidents = Paccident::orderBy('updated_at','desc')->get();
            return view('dashboard.packauto.accident.all-accident', compact('paccidents'));
        }
        public function accidentDetail(Paccident $paccident)
        {
            return view('dashboard.packauto.accident.accident-detail', compact('paccident'));
        }
        public function accidentRapport(Paccident $paccident)
        {
            return view('dashboard.packauto.accident.accident-rapport', compact('paccident'));
        }
    //
}
