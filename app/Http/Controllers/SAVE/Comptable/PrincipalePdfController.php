<?php

namespace App\Http\Controllers\Principale;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Mail\TestMail;
use App\Models\Client;
use App\Models\Secteur;
use App\Models\Commande;
use App\Models\Panierprod;
use Illuminate\Http\Request;
use App\Models\Detailcommande;
use App\Models\Commandesecteur;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Gloudemans\Shoppingcart\Facades\Cart;

class PrincipalePdfController extends Controller
{    

    public function commandeStore(Request $request) 
    {
        //dd(Cart::content()->count() );
        $this->validate($request, [
            'nom' => 'required|min:2|max:15',
            'prenom' => 'required|min:2|max:30',
            'contact' => 'required|min:10|max:10',
            'email'   => 'nullable|email',
            'secteur' => 'required|min:2|max:30',
            'adresse_livraison' => 'required|min:2|max:30',
            'frais_livraison' => 'required',
            'adresse' => 'required|min:2'
        ]);

        //données
            if (!empty($request->note_commande))
            {
                $note_commande = $request->note_commande;
            }
            else{
                $note_commande = "aucun commentaire";
            }

            
            $price = explode('Fcfa',getprice(Cart::total()));
            $getprice =  trim($price[0]);
            $espace = explode(' ',$getprice);
            //dd(sizeof($espace));

            if(sizeof($espace) == 2) {
                $espaceUn =  trim($espace[0]);
                $espaceDeux = trim($espace[1]);
                $chiffre = $espaceUn.$espaceDeux;
            } elseif(sizeof($espace) == 3) {
                $espaceUn =  trim($espace[0]);
                $espaceDeux = trim($espace[1]);
                $espaceTrois = trim($espace[2]);
                $chiffre = $espaceUn.$espaceDeux.$espaceTrois;
            }else{
                $chiffre = $getprice;
            }
            //dd(getprice(Cart::total()), $getprice, $espace, $chiffre, $request->all(), $chiffre);

            $parts = explode('-', $request->secteur);
            $nom = $parts[0];         // "abidjan"
            $frais_livraison = $parts[1];         // "2500"
            $secteur = Secteur::where('nom', $nom)->where('frais_livraison', $frais_livraison)->first();
        //


        $client = Client::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'contact' => $request->contact,
            'adresse' => $request->adresse,         
            'isvalide' => 1,           
        ]);

        $commande = Commande::create([
            /*'adresse_livraison' => "agence",*/
            'adresse_livraison' => $request->adresse_livraison,
            'frais_livraison' => $frais_livraison,
            'note_commande' => $note_commande,
            'numero_facture' => "Aucun",
            'total_prix' => $chiffre,
            'isvalide' => 0,
            'client_id' => $client->id,
        ]);

        $numero_facture = date('ydm').$commande->id;
        $commande->update([
            'numero_facture' => $numero_facture,
        ]);
        
        $commandesecteur = Commandesecteur::create([
            'commande_id' => $commande->id,
            'secteur_id' => $secteur->id,
        ]);

        if ( Cart::count() > 0 )
        {
            foreach (Cart::content() as $produit)
            {
                $prix_total = $produit->price * $produit->qty ;
                $detailcommande = Detailcommande::create([
                    'quantite' => $produit->qty ,
                    'prix_unitaire' => $produit->price,
                    'prix_total' => $prix_total,
                    'commande_id' => $commande->id,
                    'produit_id' => $produit->id,
                ]);

                $panierprod = Panierprod::create([
                    'quantite' => $produit->qty ,
                    'client_id' => $client->id,
                    'produit_id' => $produit->id,
                ]);
            }
        }

        // session()->put([
        //     'client' => $client,
        //     'commande' => $commande,
        // ]);        

        
        //Mail::to('rodrigueachi26@mail.test')->send(new TestMail($commande));
        // return back()->compact('client','commande')->with('confirm', 'Mr/Mme '.$client->nom.' '.$client->prenom.' votre commande a bien été envoyé. Merci et à bientôt.');
        return back()->with([
            'Mfacture' => 'Mr/Mme ' . $client->nom . ' ' . $client->prenom . ', votre commande a bien été envoyée. Merci et à bientôt.',
            'commande' => $commande,
        ]);
        // return redirect()->route('pdf.commande', compact('client','commande'))->with('confirm', 'Mr/Mme '.$client->nom.' '.$client->prenom.' votre commande a bien été envoyé. Merci et à bientôt.');
    }
    
    public function pdfCommande(Commande $commande) //Commande $commande, $chiffre
    {
        //return view('facture-pdf.chat2');
        //dd($commande->total_prix);

        // $date = date('d-m-Y');
        // $facture = date('ydm').$commande->id;

        // dd($facture); // Résultat : 250925


        $html = View::make('facture-pdf.chat', compact('commande'))->render();
        
        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $mpdf->WriteHTML($html);

        return response()->streamDownload(
            fn () => $mpdf->Output(),
            "facture-commande.pdf"
        );
    }
}
