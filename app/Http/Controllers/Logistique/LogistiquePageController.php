<?php

namespace App\Http\Controllers\Logistique;

use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LogistiquePageController extends Controller
{
    use ValidatesRequests;

    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('logistique.login'));
    }
    
    public function home()
    {
        // $n = 1;
        // $commandelivreurs = Auth()->user()->commandelivreurs()->where('isvalide', 0)->get();

        return view('dashboard.logistique.home');
    }
    
    public function validerLivraisonCommandeStore(Request $request, Commandelivreur $commandelivreur)
    {
        $noms = $commandelivreur->livreur->nom." ".$commandelivreur->livreur->prenom ;

        $commandelivreur->update([
            'isvalide' => !$commandelivreur->isvalide,
        ]);

        foreach ($commandelivreur->commande->detailcommandes as $detailcommande)
        {
            //cal
                $newsQtyProduit = $detailcommande->produit->qtyStock - $detailcommande->quantite ;
                $newsMvente = (int)($detailcommande->produit->mvente) + (int)($detailcommande->quantite) ;

                $sortie = $detailcommande->produit->produitstat->sortie + $detailcommande->quantite ;
            //

            $detailcommande->produit->update([
                'qtyStock' => $newsQtyProduit,
                'mvente' => $newsMvente,
            ]);

            $detailcommande->produit->produitstat->update([
                'sortie' => $sortie,
            ]);

            Prodse::create([
                'quantite' => $detailcommande->quantite,
                'entree_sortie' => 0,
                'produit_id' => $detailcommande->produit->id,
            ]);

            if($newsQtyProduit <= 0)
            {
                $detailcommande->produit->update([
                    'stock' => 0,
                ]);
            }
        }

        return redirect()->route('livreur.commande.livrer')->with('success', "Livraison de la commade de $noms livré avec succès");
    }

    public function CommandeLivrer()
    {
        $n = 1;
        $commandelivreurs = Auth()->user()->commandelivreurs()->where('isvalide', 1)->get();

        return view('dashboard.livreur.commande.commande-deja-livre', compact('commandelivreurs','n'));
    }

    
    public function commandeProduit(Commande $commande)
    {
        return view('dashboard.livreur.commande.produit-commande', compact('commande'));
    }
    public function pdfCommande(Commande $commande) 
    {
        $html = View::make('dashboard.admin.pdf.chat', compact('commande'))->render();
    
        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $mpdf->WriteHTML($html);

        return response()->streamDownload(
            fn () => $mpdf->Output(),
            "facture-4.pdf"
        );
        
    }
    
}
