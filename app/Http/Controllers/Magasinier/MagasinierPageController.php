<?php

namespace App\Http\Controllers\Magasinier;

use Mpdf\Mpdf;
use App\Models\Client;
use App\Models\Projet;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Produitse;
use App\Models\Clientdevis;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Fournisseurfacturecomptable;
use Illuminate\Foundation\Validation\ValidatesRequests;

class MagasinierPageController extends Controller
{
    use ValidatesRequests;

    public function logout(Request $request) {
        // dd(5);
        Auth::logout();
        return redirect(route('magasinier.login'));
    }
    
    public function home()
    {
        //categorie et produit
            $categories = Categorie::orderBy('updated_at','desc')->get();
            $produits = Produit::orderBy('updated_at','desc')->get();
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

        return  view('dashboard.magasinier.home', 
                compact('produits','categories','clients','fournisseurs','clientdevis',
                        'clientdevisM','fournisseurfacturecomptables','fournisseurfacturecomptablesM'));
    }

    //projet   
        public function projet()
        { 
            $projets = Projet::orderBy('updated_at','desc')->get();
            return  view('dashboard.magasinier.projet.projet', compact('projets'));
        }
        public function projetTache(Projet $projet)
        { 
            return  view('dashboard.magasinier.projet.projet-tache', compact('projet'));
        }
    //

    //confirme livraison   
        public function factureLivre()
        { 
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1)->where('magasinier', 1)->where('livraison', 1);
                })->orderBy('updated_at','desc')->get();
            return  view('dashboard.magasinier.facture-client.livre', compact('clientdevis'));
        }
        public function factureNonLivre()
        { 
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1)->where('magasinier', 1)->where('livraison', 0);
                })->orderBy('updated_at','desc')->get();
            return  view('dashboard.magasinier.facture-client.non-livre', compact('clientdevis'));
        }
        public function factureClientDetail(Clientdevis $clientdevis)
        {
            return view('dashboard.magasinier.facture-client.commande-detail', compact('clientdevis'));
        }
    //

    //facture location livrés
        public function factureLocationLivreSansRetour()
        { 
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1)->where('magasinier', 1)->where('livraison', 1)->where('livraison_retour', 0);
                })->where('TD', 1)->orderBy('updated_at','desc')->get();
            return  view('dashboard.magasinier.facture-client.location.livre-sans-retour', compact('clientdevis'));
        }
        public function factureLocationLivreAvecRetour()
        { 
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1)->where('magasinier', 1)->where('livraison', 1)->where('livraison_retour', 1);
                })->where('TD', 1)->orderBy('updated_at','desc')->get();
            return  view('dashboard.magasinier.facture-client.location.livre-avec-retour', compact('clientdevis'));
        }
    // 
      
}
