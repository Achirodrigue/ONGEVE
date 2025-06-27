<?php

namespace App\Http\Controllers\Principale;

use App\Models\Equipe;
use App\Models\Message;
use App\Models\Produit;
use App\Models\Vendeur;
use App\Models\Avisprod;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Conseilastuce;
use App\Models\Souscategorie;
use App\Http\Controllers\Controller;

class PrincipalePageController extends Controller
{
    //fonction principale
        public function accueil()
        {   
            $produits = Produit::where('isvalide',1)->orderBy('updated_at','desc')->get();
            return view('principale.accueil', compact('produits'));
        }
        public function entreprise()
        {   
            $equipes = Equipe::all();
            return view('principale.entreprise', compact('equipes'));
        }
        public function service()
        {   
            return view('principale.service');
        }

        public function boutiqueProduit(Vendeur $vendeur)
        {   
            $produits = Produit::where('isvalide',1)->orderBy('updated_at','desc')->get();
            $produits = $vendeur->produits()->where('isvalide', 1)->orderBy('updated_at','desc')->paginate(20);
            return view('principale.boutique.boutique-produit', compact('vendeur','produits'));
        }

        public function filtrerParPrix(Request $request)
        {
            $min = (int)$request->min;
            $max = (int)$request->max;

            $produits = Produit::with('produitimg')
                        ->where('isvalide', 1)
                        ->whereBetween('prix', [$min, $max])
                        ->get();

            return view('principale.produit.ppp', compact('produits'))->render();
        }
    //
    
    //produit
        public function allProduit()
        {
            $produits = Produit::orderBy('updated_at','desc')->where('isvalide', 1)->paginate(20);
            return view ('principale.produit.all-produit', compact('produits'));
        }

        public function allProduitReconditionne()
        {
            $produits = Produit::orderBy('updated_at','desc')->where('isvalide', 1)->where('etat', 0)->paginate(20);
            return view ('principale.produit.all-produit-reconditionne', compact('produits'));
        }

        public function allProduitPromo()
        {
            $produits = Produit::orderBy('updated_at','desc')->where('isvalide', 1)->where('promo','!=', null)->paginate(20);
            return view ('principale.produit.all-produit-promo', compact('produits'));
        }

        public function detailProduit(Produit $produit)
        {
            return view('principale.produit.detail-produit', compact('produit'));
        }

        public function commentaireProduitStore(Request $request, Produit $produit)
        {
            //dd(1);     
            $this->validate($request, [
                'nom'   => 'required|min:3',
                'prenom'   => 'required|min:3',
                'commentaire'   => 'required|min:6',
                'etoile'   => 'required'
            ]);   
            
            $avisprod = Avisprod::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'commentaire' => $request->commentaire,
                'etoile' => $request->etoile,
                'produit_id' => $produit->id,
            ]);
                
            return back()->with('success', "Mr/Mme $avisprod->nom $avisprod->prenom ,votre commentaire a bien été enregistré.");
        }

        //recherche produit
            public function rechercheProduit(Request $request)
            {
                $this->validate($request, [
                    'search'   => 'required|min:3',
                    'choix'   => 'required',
                ]);  

                //données 
                    $search = request()->input('search');
                    $choix = request()->input('choix');

                    if(!empty($choix)){ 
                        $scategorie = Souscategorie::where('id', $choix)->first();
                        $scategorie = $scategorie->nom;
                    } else { $scategorie = 'Tout les produits'; }
                // 

                //dd($choix);

                if(!empty($search))
                {
                    if(!empty($choix))
                    {

                        $produits = Produit::where('souscategorie_id', $choix)
                        ->where(function ($query) use ($search) {
                            $query->where('nom', 'like', "%$search%")
                                ->orWhere('prix', 'like', "%$search%")
                                ->orWhere('promo', 'like', "%$search%");
                        })
                        ->paginate(20);
                    }
                    else
                    {
                        $produits = Produit::Where('nom', 'like', "%$search%")
                                ->orWhere('prix', 'like', "%$search%")
                                ->orWhere('promo', 'like', "%$search%")
                                ->paginate(20);
                    }
                    
                    
                    // $this->validate($request, [
                    //     'choix'   => 'required|min:8|max:12',
                    // ]);
                    // if($request->choix > 0)
                    // $produits = Produit::where('souscategorie_id', $choix)
                    //             ->Where('nom', 'like', "%$search%")
                    //             ->orWhere('prix', 'like', "%$search%")
                    //             ->orWhere('promo', 'like', "%$search%")
                    //             ->paginate(20);
                    return view ('principale.produit.recherche-produit', compact('produits'));
                }

                return redirect()->route('accueil')->with('error', "Désolé! Aucune recherche n'a été effectuer.");
            }
        //
    //
    
    //contact
        public function contact()
        {
            return view('principale.contact');
        }
        public function messageStore(Request $request)
        {
            //dd(2, $request);
            $this->validate($request, [
                'contact'   => 'required|min:8|max:12',
                'email'   => 'required|email|min:8',
                'nom_prenom'   => 'required|min:6',
                'objet'   => 'required|min:4',
                'message'   => 'required|min:4',
            ]);

            $message = Message::create([
                'nom_prenom' => $request->nom_prenom,
                'email' => $request->email,
                'contact' => $request->contact,
                'objet' => $request->objet,
                'message' => $request->message,
                'isvalide' => 0,
            ]);

            $nom = $request->nom_prenom;
                
            return back()->with('success', 'Mr/Mme '.$nom.' votre message a bien été envoyé. Merci et à bientôt.');
        }
    //

    //categ et sous categ
        public function scategorieProduit(Souscategorie $souscategorie)
        {
            $prod = $souscategorie->produits()->where('isvalide',1)->count();
            $produits = $souscategorie->produits()->where('isvalide',1)->paginate(15);
    
            if( $prod > 0 ){
                return view('principale.produit.scategorie-produit', compact('produits','souscategorie'));
            }
            
            return redirect()->route('accueil')->with('error',"Désolé! la sous catégorie $souscategorie->nom ne contient pas de produit");

        }

        public function categorieProduit(Categorie $categorie)
        {
            $total = 0;
            if($categorie->souscategories->count() > 0)
            {
                foreach($categorie->souscategories as $souscategorie)
                {
                    if($souscategorie->produits->where('isvalide', 1)->count() > 0)
                    {
                        $total++;
                    }
                }
            }

            if( $total > 0 ){
                return view('principale.produit.categorie-produit', compact('categorie'));
            }
            
            return redirect()->route('accueil')->with('error',"Désolé! la catégorie $categorie->nom ne contient pas de produit");

        }
    //
    
    //castuce et Conseil
        public function conseilAstuce()
        {
            $conseilastuces = Conseilastuce::all();

            return view('principale.conseil-astuce.all-conseil-astuce', compact('conseilastuces'));
        }
        public function conseilAstuceDetail(Conseilastuce $conseilastuce)
        {
            return view('principale.conseil-astuce.detail-CA', compact('conseilastuce'));
        }
    //
}