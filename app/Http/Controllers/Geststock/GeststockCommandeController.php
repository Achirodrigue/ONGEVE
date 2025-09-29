<?php

namespace App\Http\Controllers\Geststock;

use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Models\Particulierdevis;
use App\Http\Controllers\Controller;

class GeststockCommandeController extends Controller
{
    //client
        // public function commandeClientValide()
        // {
        //     $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
        //         $query->where('isvalide', 1)->where('etat', 1)->where('livraison', 0);
        //     })->orderBy('updated_at','desc')->get();
        //     return view('dashboard.geststock.commande.client.commande-valide', compact('clientdevis'));
        // }
        // public function commandeClientLivre()
        // {
        //     $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
        //         $query->where('isvalide', 1)->where('etat', 1)->where('livraison', 1);
        //     })->orderBy('updated_at','desc')->get();
        //     return view('dashboard.geststock.commande.client.commande-livre', compact('clientdevis'));
        // }
        // public function commandeClientDetail(Clientdevis $clientdevis)
        // {
        //     return view('dashboard.geststock.commande.client.commande-detail', compact('clientdevis'));
        // }
        // public function confirmeLivraisonCommandeClient(Request $request, Clientdevis $clientdevis)
        // {
        //     //données
        //         $noms = $clientdevis->client->nom ;
        //     //

        //     $clientdevis->clientdevisinfo->update([
        //         'livraison' => 1, //!$clientdevis->livraison,
        //     ]);
                
        //     return redirect()->route('geststock.commande.client.livre')->with('success', "Confirmation de la commande de $noms effectuée avec succès");
        // }
    //
    //client all facture
        public function allFactureClient()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1)->where('etat', 1)->where('livraison', 1);
            })->orderBy('updated_at','desc')->get();

            return view('dashboard.geststock.commande.generale.all-commande', compact('clientdevis'));
        }
    //
}
