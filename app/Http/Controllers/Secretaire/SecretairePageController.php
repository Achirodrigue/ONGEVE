<?php

namespace App\Http\Controllers\Secretaire;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Projet;
use App\Models\Clientdevis;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Client\ClientdevisExport;
use App\Models\Fournisseurfacturecomptable;
use App\Exports\Client\ClientdevisGeneralExport;
use App\Exports\Client\ClientdevisGeneralCAExport;
use App\Exports\Client\ClientdevisIndividuelExport;

use App\Exports\Fournisseur\FournisseurFactureExport;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Exports\Fournisseur\FournisseurFactureGeneralExport;
use App\Exports\Fournisseur\FournisseurFactureIndividuelExport;

class SecretairePageController extends Controller
{
    use ValidatesRequests;

    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('secretaire.login'));
    }
    
    public function home()
    {
        // dd(null + null);
        //depense
            $depenses = Client::orderBy('updated_at','desc')->get();
            $depensesM = 0 ;
            foreach($depenses as $depense)
            {
                $depensesM += $depense->montant ;
            }
        //
        //client
            $clients = Client::orderBy('updated_at','desc')->get();
        //
        //facture client
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->orderBy('updated_at','desc')->get();
            $clientdevisM = 0 ;
            foreach($clientdevis as $clientdevis)
            {
                $clientdevisM += $clientdevis->total_payer ;
            }
        //
        //fournisseur
            $fournisseurs = Fournisseur::orderBy('updated_at','desc')->get();
        //
        //facture fournisseur
            $fournisseurfacturecomptables = Fournisseurfacturecomptable::orderBy('updated_at','desc')->get();
            $fournisseurfacturecomptablesM = 0 ;
            foreach($fournisseurfacturecomptables as $fournisseurfacturecomptable)
            {
                $fournisseurfacturecomptablesM += $fournisseurfacturecomptable->total_payer ;
            }
        //

        return  view('dashboard.secretaire.home', 
                compact('clients','fournisseurs','clientdevis','clientdevisM','fournisseurfacturecomptables','fournisseurfacturecomptablesM','depenses','depensesM'));
    }

    //projet   
        public function projet()
        { 
            $projets = Projet::orderBy('updated_at','desc')->get();
            return  view('dashboard.secretaire.projet.projet', compact('projets'));
        }
        public function projetTache(Projet $projet)
        { 
            return  view('dashboard.secretaire.projet.projet-tache', compact('projet'));
        }
    //
}
