<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Projet;
use App\Models\Clientdevis;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Fournisseurfacturecomptable;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AdminPageController extends Controller
{
    use ValidatesRequests;

    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('admin.login'));
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
            $clientdevis = Clientdevis::orderBy('updated_at','desc')->get();
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

        return  view('dashboard.admin.home', 
                compact('clients','fournisseurs','clientdevis','clientdevisM','fournisseurfacturecomptables','fournisseurfacturecomptablesM','depenses','depensesM'));
    
    }

    //projet   
        public function projet()
        { 
            $projets = Projet::orderBy('updated_at','desc')->get();
            return  view('dashboard.admin.projet.projet', compact('projets'));
        }
        public function projetTache(Projet $projet)
        { 
            return  view('dashboard.admin.projet.projet-tache', compact('projet'));
        }
    //

    //client rappel vente 
        public function clientRappelVente15Jours()
        {
            $clients = Client::whereDoesntHave('clientdevis', function ($query) {
                $query->where('created_at', '>=', Carbon::now()->subDays(15));
            })->get();

            return  view('dashboard.admin.comptable.rappel-client.rappel-15-jours', compact('clients'));
        }
        public function clientRappelVente1Mois()
        {
            $clients = Client::whereDoesntHave('clientdevis', function ($query) {
                $query->where('created_at', '>=', Carbon::now()->subMonth());
            })->get();

            return  view('dashboard.admin.comptable.rappel-client.rappel-1-mois', compact('clients'));
        }
    //

}
