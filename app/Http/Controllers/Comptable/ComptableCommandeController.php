<?php

namespace App\Http\Controllers\Comptable;

use App\Models\Client;
use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Models\Particulierdevis;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ComptableCommandeController extends Controller
{
    //client
        public function commandeClientEncours()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1)->where('etat', null);
            })->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.commande.client.commande-encours', compact('clientdevis'));
        }
        public function commandeClientValide()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1)->where('etat', 1);
            })->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.commande.client.commande-valide', compact('clientdevis'));
        }
        public function commandeClientRefuse()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1)->where('etat', 2);
            })->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.commande.client.commande-refuse', compact('clientdevis'));
        }
        public function commandeClientDetail(Clientdevis $clientdevis)
        {
            return view('dashboard.comptable.commande.client.commande-detail', compact('clientdevis'));
        }

        
        public function rejetCommandeClientStore(Request $request, Clientdevis $clientdevis)
        {
            $this->validate($request, [
                'motif_rejet' => 'required|min:1',
            ]);

            //données
                $noms = $clientdevis->client->nom ;
            //

            $clientdevis->clientdevisinfo->update([
                'etat' => 2,
                'motif_rejet' => $request->motif_rejet ,
            ]);
                
            return redirect()->route('comptable.commande.client.refuse')->with('success', "$noms : commande rejetée avec succès");
        }     
        public function annulerRejetCommandeClient(Clientdevis $clientdevis)
        {
            //données
                $noms = $clientdevis->client->nom ;
            //

            $clientdevis->clientdevisinfo->update([
                'etat' => null,
                'motif_rejet' => null ,
            ]);
                
            return redirect()->route('comptable.commande.client.encours')->with('success', "$noms : rejet de commande annulé avec succès");
        }
        public function validerCommandeClientStore(Request $request, Clientdevis $clientdevis)
        {
            $this->validate($request, [
                'frais' => 'required|min:1',
                'delai_livraison' => 'required|min:1',
            ]);

            //données
                $noms = $clientdevis->client->nom ;
            //

            $clientdevis->update([
                'frais' => $request->frais,
                'delai_livraison' => $request->delai_livraison,
            ]);

            $clientdevis->clientdevisinfo->update([
                'etat' => 1,
            ]);
                
            return redirect()->route('comptable.commande.client.valide')->with('success', "$noms : commande validée avec succès");
        }
    //

    //particulier
        public function commandeParticulierEncours()
        {
            $particulierdevis = Particulierdevis::where('isvalide', 1)->where('etat', null)->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.commande.particulier.commande-encours', compact('particulierdevis'));
        }
        public function commandeParticulierValide()
        {
            $particulierdevis = Particulierdevis::where('isvalide', 1)->where('etat', 1)->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.commande.particulier.commande-valide', compact('particulierdevis'));
        }
        public function commandeParticulierRefuse()
        {
            $particulierdevis = Particulierdevis::where('isvalide', 1)->where('etat', 2)->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.commande.particulier.commande-refuse', compact('particulierdevis'));
        }
        public function commandeParticulierDetail(Particulierdevis $particulierdevis)
        {
            return view('dashboard.comptable.commande.particulier.commande-detail', compact('particulierdevis'));
        }

        public function rejetCommandeParticulierStore(Request $request, Particulierdevis $particulierdevis)
        {
            $this->validate($request, [
                'motif_rejet' => 'required|min:1',
            ]);

            //données
                $noms = $particulierdevis->particulier->nom ;
            //

            $particulierdevis->update([
                'etat' => 2,
                'motif_rejet' => $request->motif_rejet ,
            ]);
                
            return redirect()->route('comptable.commande.client.refuse')->with('success', "$noms : commande rejetée avec succès");
        }     
        public function annulerRejetCommandeParticulier(Particulierdevis $particulierdevis)
        {
            //données
                $noms = $particulierdevis->particulier->nom ;
            //

            $particulierdevis->update([
                'etat' => null,
                'motif_rejet' => null ,
            ]);
                
            return redirect()->route('comptable.commande.particulier.encours')->with('success', "$noms : rejet de commande annulé avec succès");
        }
        public function validerCommandeParticulierStore(Request $request, Particulierdevis $particulierdevis)
        {
            $this->validate($request, [
                'frais' => 'required|min:1',
                'delai_livraison' => 'required|min:1',
            ]);

            //données
                $noms = $particulierdevis->particulier->nom ;
            //

            $particulierdevis->update([
                'etat' => 1,
                'frais' => $request->frais,
                'delai_livraison' => $request->delai_livraison,
            ]);
                
            return redirect()->route('comptable.commande.particulier.valide')->with('success', "$noms : commande validée avec succès");
        }
    //
}
