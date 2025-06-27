<?php

namespace App\Http\Controllers\Magasinier;

use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Models\Particulierdevis;
use App\Http\Controllers\Controller;

class MagasinierCommandeController extends Controller
{
    //client
        public function commandeClientValide()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1)->where('etat', 1)->where('livraison', 0);
            })->orderBy('updated_at','desc')->get();
            return view('dashboard.magasinier.commande.client.commande-valide', compact('clientdevis'));
        }
        public function commandeClientLivre()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1)->where('etat', 1)->where('livraison', 1);
            })->orderBy('updated_at','desc')->get();
            return view('dashboard.magasinier.commande.client.commande-livre', compact('clientdevis'));
        }
        public function commandeClientDetail(Clientdevis $clientdevis)
        {
            return view('dashboard.magasinier.commande.client.commande-detail', compact('clientdevis'));
        }
        public function confirmeLivraisonCommandeClient(Request $request, Clientdevis $clientdevis)
        {
            //données
                $noms = $clientdevis->client->nom ;
            //

            $clientdevis->clientdevisinfo->update([
                'livraison' => 1, //!$clientdevis->livraison,
            ]);
                
            return redirect()->route('magasinier.commande.client.livre')->with('success', "Confirmation de la commande de $noms effectuée avec succès");
        }
    //

    //particulier
        public function commandeParticulierValide()
        {
            $particulierdevis = Particulierdevis::where('isvalide', 1)->where('etat', 1)->where('livraison', 0)->get();
            return view('dashboard.magasinier.commande.particulier.commande-valide', compact('particulierdevis'));
        }
        public function commandeParticulierLivre()
        {
            $particulierdevis = Particulierdevis::where('isvalide', 1)->where('etat', 1)->where('livraison', 1)->get();
            return view('dashboard.magasinier.commande.particulier.commande-livre', compact('particulierdevis'));
        }
        public function commandeParticulierDetail(Particulierdevis $particulierdevis)
        {
            return view('dashboard.magasinier.commande.particulier.commande-detail', compact('particulierdevis'));
        }
        public function confirmeLivraisonCommandeParticulier(Request $request, Particulierdevis $particulierdevis)
        {
            //données
                $noms = $particulierdevis->particulier->nom ;
            //

            $particulierdevis->update([
                'livraison' => 1, //!$particulierdevis->livraison,
            ]);
                
            return redirect()->route('magasinier.commande.particulier.livre')->with('success', "Confirmation de la commande de $noms effectuée avec succès");
        }
    //
}
