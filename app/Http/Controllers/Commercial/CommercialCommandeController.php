<?php

namespace App\Http\Controllers\Commercial;

use App\Models\Client;
use App\Models\Produit;
use App\Models\Clientdevis;
use App\Models\Particulier;
use Illuminate\Http\Request;
use App\Models\Clientdevisprod;
use App\Models\Particulierdevis;
use App\Http\Controllers\Controller;
use App\Models\Particulierdevisprod;
use Illuminate\Support\Facades\Storage;

class CommercialCommandeController extends Controller
{
    //client
        /*
        public function commandeClientEncours()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1)->where('etat', null);
            })->orderBy('updated_at','desc')->get();
            
            return view('dashboard.commercial.commande.client.commande-encours', compact('clientdevis'));
        }
        public function commandeClientValide()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1)->where('etat', 1);
            })->orderBy('updated_at','desc')->get();
            return view('dashboard.commercial.commande.client.commande-valide', compact('clientdevis'));
        }
        public function commandeClientRefuse()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1)->where('etat', 2);
            })->orderBy('updated_at','desc')->get();
            return view('dashboard.commercial.commande.client.commande-refuse', compact('clientdevis'));
        }
        */
    //

    // //particulier
    //     public function commandeParticulierEncours()
    //     {
    //         $particulierdevis = Particulierdevis::where('isvalide', 1)->where('etat', null)->orderBy('updated_at','desc')->get();
    //         return view('dashboard.commercial.commande.particulier.commande-encours', compact('particulierdevis'));
    //     }
    //     public function commandeParticulierValide()
    //     {
    //         $particulierdevis = Particulierdevis::where('isvalide', 1)->where('etat', 1)->orderBy('updated_at','desc')->get();
    //         return view('dashboard.commercial.commande.particulier.commande-valide', compact('particulierdevis'));
    //     }
    //     public function commandeParticulierRefuse()
    //     {
    //         $particulierdevis = Particulierdevis::where('isvalide', 1)->where('etat', 2)->orderBy('updated_at','desc')->get();
    //         return view('dashboard.commercial.commande.particulier.commande-refuse', compact('particulierdevis'));
    //     }
    // //
}
