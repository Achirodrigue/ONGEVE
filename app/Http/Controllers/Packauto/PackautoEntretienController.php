<?php

namespace App\Http\Controllers\Packauto;

use App\Models\Pentretien;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class PackautoEntretienController extends Controller
{
    //entretien
        public function entretienPanne()
        {
            $pentretiens = Pentretien::orderBy('updated_at','desc')->get();
            return view('dashboard.packauto.entretien.all-entretien', compact('pentretiens'));
        }
        // public function entretienDetailPanne(Pentretien $pentretien)
        // {
        //     return view('dashboard.packauto.entretien.entretien-detail-panne', compact('pentretien'));
        // }
    //
}
