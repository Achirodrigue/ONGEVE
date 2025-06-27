<?php

namespace App\Http\Controllers\Admin;

use Mpdf\Mpdf;
// use App\Models\Solde;
use App\Models\Gsolde;
// use App\Models\Article;
// use App\Models\Message;
use App\Models\Livreur;
use App\Models\Commande;
// use Illuminate\Support\Str;
use App\Models\Soldeday;
// use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Commandelivreur;
use App\Models\Commandesecteur;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Admin\FonctionPersonnelle\FonctionPersonnelle;

class AdminCommandeController extends Controller
{
    //commande
        public function nouvelleCommande()
        {
            //Commandesecteur
                if(Auth()->user()->role)
                {
                    $commandesecteurs = Commandesecteur::all();
                }
                else
                {
                    if(Auth()->user()->adminsecteur->secteur_id)
                    {
                        $commandesecteurs = Commandesecteur::where('secteur_id', Auth()->user()->adminsecteur->secteur_id)->get();
                    }
                    else
                    {
                        $commandesecteurs = Commandesecteur::all();
                    }
                }
            //

            //livreur
                if(Auth()->user()->role)
                {
                    $livreurs = Livreur::orderBy('nom','asc')->get();
                }
                else
                {
                    if(auth()->user()->adminsecteur?->secteur_id === null) 
                    {
                        $livreurs = Livreur::orderBy('nom','asc')->get();
                    }
                    else{
                        $livreurs = null;
                        if(Auth()->user()->livreurs->count() > 0)
                        {
                            $livreurs = Auth()->user()->livreurs()->orderBy('nom','asc')->get();
                        }
                    }
                }
            //

            $commandes = Commande::where('isvalide',0)->orderBy('updated_at','desc')->paginate(15);
            return view('dashboard.admin.commande.new-commande', compact('commandes','livreurs','commandesecteurs'));
        }
        public function historiqueCommandeLivre()
        {
            //Commandesecteur
                if(Auth()->user()->role)
                {
                    $commandesecteurs = Commandesecteur::all();
                }
                else
                {
                    if(Auth()->user()->adminsecteur->secteur_id)
                    {
                        $commandesecteurs = Commandesecteur::where('secteur_id', Auth()->user()->adminsecteur->secteur_id)->get();
                    }
                    else
                    {
                        $commandesecteurs = Commandesecteur::all();
                    }
                }
            //

            $commandes = Commande::where('isvalide',1)->orderBy('updated_at','desc')->paginate(20);
            return view('dashboard.admin.commande.commande-deja-livre', compact('commandes','commandesecteurs'));
        }
        public function commandeProduit(Commande $commande)
        {
            return view('dashboard.admin.commande.produit-commande', compact('commande'));
        }
        public function livraisonCommandeEncours()
        {
            $commandelivreurs = Commandelivreur::orderBy('created_at','asc')->get();
            return view('dashboard.admin.commande.livraison-encours', compact('commandelivreurs'));
        }
        public function annulerLivraisonCommandecommandeDestroy(Request $request, Commandelivreur $commandelivreur)
        {
            if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
                return $redirect;
            }
            
            $nom = $commandelivreur->commande->client->nom;
            $prenom = $commandelivreur->commande->client->prenom;

            $commandelivreur->delete();

            return back()->with('success', "Livraison de $nom $prenom annulé avec succès");
        }
        
        public function affectationCommandeStore(Request $request, Commande $commande)
        {
            $this->validate($request, [
                'livreur_id' => 'required|min:1'
            ]);
    
            // dd(4);
    
            $commandelivreur = Commandelivreur::create([
                'commande_id' => $commande->id,
                'livreur_id' => $request->livreur_id,
                'isvalide' => 0,
            ]);
                
            return redirect()->route('admin.livraison.commmande.encours')->with('success', 'Livraison affecté avec succès');
            
        }


        public function validationCommande(Request $request, Commande $commande)
        {
            //dd(1);
            //données
                $noms = $commande->client->nom;
                $prenom = $commande->client->prenom;

                //$date = date('Y-m-d');
                $Gsolde = Gsolde::first();
                $Soldedays = Soldeday::all();

                $newsoldeday = $commande->total_prix + $commande->frais_livraison;
                $newGsolde = $Gsolde->solde + $commande->total_prix + $commande->frais_livraison;
            //

            $Gsolde->update([
                'solde' => $newGsolde,
            ]);

            $commande->update([
                'isvalide' =>  !$commande->isvalide,
            ]);

            
            if($Soldedays->count() > 0)
            {
                foreach ($Soldedays as $Soldeday)
                {
                    // $date = $Soldeday->created_at->format('Y-m-d');

                    if ($Soldeday->date === date('d-m-Y'))
                    {
                        $newsoldeday = $Soldeday->solde + $commande->total_prix + $commande->frais_livraison ;
                        $Soldeday->update([
                            'solde' => $newsoldeday,
                        ]);
                        
                        return back()->with('success',"Validation de la livraison de $noms $prenom approuvé avec succès.");
                    }
                }
            }

            Soldeday::create([
                'date' => date('d-m-Y'),
                'solde' => $newsoldeday,
            ]);
            //dd(1);
            
            return back()->with('success', "Validation de la livraison de $noms $prenom approuvé avec succès.");
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
            // return view('pdf.chat');

            // $html = View::make('pdf.chat2')->render();
            
            // $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            // $mpdf->WriteHTML($html);

            // return response()->streamDownload(
            //     fn () => $mpdf->Output(),
            //     "facture-4.pdf"
            // );
            
            //return view('pdf.chat');

            // Charger la vue Blade avec des données
            // $data = ['title' => 'Mon PDF', 'content' => 'Ceci est mon premier PDF avec DomPDF !'];
            // $pdf = Pdf::loadView('pdf.chat', $data);

            // // Télécharger le PDF
            // return $pdf->stream('mon-document.pdf');
            //voir le pdf
            //return $pdf->stream('mon-document.pdf');



            // // Charger la vue Blade
            // $data = ['title' => 'Mon PDF', 'content' => 'Ceci est mon premier PDF avec mPDF !'];
            // $html = View::make('pdf.template', $data)->render();

            // // Initialiser mPDF avec UTF-8
            // $mpdf = new Mpdf(['mode' => 'utf-8', 'default_font' => 'dejavusans']);

            // // Écrire le HTML dans le PDF
            // $mpdf->WriteHTML($html);

            // // Télécharger le fichier PDF
            // return response()->streamDownload(
            //     fn () => $mpdf->Output(),
            //     'mon-document.pdf'
            // );

            // 1;
            // // $mpdf = new Mpdf();
            // // $mpdf->WriteHTML("<h1>Bienvenue pdf</h1>");
            // // $mpdf->Output();

            // 2;
            // //return SnappyPdf::loadView('dashboard.admin.pdf.template')->download('document.pdf');

            // 4;
            // $data = [
            //     'title' => 'mon doc pdf',
            //     'content' => 'mon content pdf',
            // ];

           // $html = view('dashboard.admin.pdf.template', $data)->render();
            //    $html = View::make('dashboard.admin.pdf.facture')->render();
            //    $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');


            //     $mpdf = new Mpdf();
            //     $html = Str::of($html)->ascii(); // Laravel convertit en ASCII

            //     $mpdf->WriteHTML($html);

            //     return response()->streamDownload(
            //         fn () => $mpdf->Output(),
            //         "mon-document.pdf"
            //     );

            //         $html = View::make('dashboard.admin.pdf.facture')->render();
            // $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');

            // $mpdf = new Mpdf();
            // $mpdf->WriteHTML($html);
            // dd($html);

            // return response()->streamDownload(
            //     fn () => $mpdf->Output(),
            //     "mon-document.pdf"
            // );






            // $produits = $commande->dcommandes()->get();
            // $pdf = Pdf::loadView('dashboard.admin.facture', compact('commande','produits'))->setOptions(['defaultFont' => 'serif']);
            // return $pdf->stream('facture commande de '.$commande->user->nom.' '.$commande->user->prenom);
            // return back();
        }


        public function commandeDestroy(Commande $commande)
        {
            if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
                return $redirect;
            }
            $nom = $commande->client->nom;
            $prenom = $commande->client->prenom;

            $commande->delete();

            return back()->with('success', 'Commande de '.$nom.' '.$prenom.' supprimé avec succès');
        }
        public function commandeDestroyGeneral(Request $request)
        {
            if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
                return $redirect;
            }
            
            $Lhistoriques = Commande::all();

            foreach ($Lhistoriques as $Lhistorique)
            {
                $Lhistorique->delete();
            }

            return back()->with('success', 'Historique des commandes supprimées avec succès');
        }
    //
    //recherche produit
        public function rechercheProduit(Request $request)
        {
            $this->validate($request, [
                'search'   => 'required|min:3',
            ]);  

            //données 
                $search = request()->input('search');
            // 

            //dd($choix);

            if(!empty($search))
            {
                $produits = Produit::Where('reference', 'like', "%$search%")
                        ->orWhere('nom', 'like', "%$search%")
                        ->orWhere('prix', 'like', "%$search%")
                        ->orWhere('promo', 'like', "%$search%")
                        ->paginate(20);
                
                
                // $this->validate($request, [
                //     'choix'   => 'required|min:8|max:12',
                // ]);
                // if($request->choix > 0)
                // $produits = Produit::where('souscategorie_id', $choix)
                //             ->Where('nom', 'like', "%$search%")
                //             ->orWhere('prix', 'like', "%$search%")
                //             ->orWhere('promo', 'like', "%$search%")
                //             ->paginate(20);
                return view ('admin.recherche.recherche-produit', compact('produits'));
            }

            return redirect()->route('accueil')->with('error', "Désolé! Aucune recherche n'a été effectuer.");
        }
    //
}
