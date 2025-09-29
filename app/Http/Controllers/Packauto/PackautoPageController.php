<?php

namespace App\Http\Controllers\Packauto;

use Carbon\Carbon;
use App\Models\Ppanne;
use App\Models\Projet;
use App\Models\Pvehicule;

use App\Models\Pchauffeur;

use App\Models\Pentretien;
use Illuminate\Http\Request;
use App\Models\Pcategorievehicule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PackautoPageController extends Controller
{
    use ValidatesRequests;

    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('packauto.login'));
    }
    
    public function home()
    {
        $pchauffeurs = Pchauffeur::orderBy('updated_at','desc')->get();
        $pcategorievehicules = Pcategorievehicule::orderBy('updated_at','desc')->get();
        $pvehicules = Pvehicule::orderBy('updated_at','desc')->get();
        $ppannes = Ppanne::orderBy('updated_at','desc')->get();
        $pentretiens = Pentretien::orderBy('updated_at','desc')->get();

        return  view('dashboard.packauto.home', 
                compact('pchauffeurs','pcategorievehicules','pvehicules','ppannes','pentretiens'));
    }

    //projet   
        public function projet()
        { 
            $projets = Projet::orderBy('updated_at','desc')->get();
            return  view('dashboard.packauto.projet.projet', compact('projets'));
        }
        public function projetTache(Projet $projet)
        { 
            return  view('dashboard.packauto.projet.projet-tache', compact('projet'));
        }
    //

    //QR code vehicule
        public function qrcodeEmpruntVehiculeGenerale() 
        {
            return view('dashboard.packauto.vehicule-qrcode.emprunt-VG');
        }
        public function qrcodeEmpruntVehicule(Pvehicule $pvehicule) 
        {
            return view('dashboard.packauto.vehicule-qrcode.emprunt-V', compact('pvehicule'));
        }
        public function qrcodePanneVehiculeGenerale() 
        {
            return view('dashboard.packauto.vehicule-qrcode.panne-VG');
        }
        public function qrcodePanneVehicule(Pvehicule $pvehicule) 
        {
            return view('dashboard.packauto.vehicule-qrcode.panne-V', compact('pvehicule'));
        }
    //
}
