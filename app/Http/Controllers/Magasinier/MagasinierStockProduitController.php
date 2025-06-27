<?php

namespace App\Http\Controllers\Magasinier;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Produitse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class MagasinierStockProduitController extends Controller
{
    use ValidatesRequests;
    
    //stock
        public function StockProduitUn(Categorie $categorie)
        {
            $produits = $categorie->produits()->orderBy('updated_at', 'desc')->get();

            return view('dashboard.magasinier.historique-stock.entrepot', compact('produits','categorie'));
        }
        public function StockProduitDeux()
        {
            $produitses = Produitse::orderBy('updated_at', 'desc')->get();

            return view('dashboard.magasinier.historique-stock.stock2', compact('produitses'));
        }
        public function quantiteProduitUpdate(Request $request, Produit $produit)
        {
            $this->validate($request, [
                'qtyStock' => 'required|integer|min:1',
            ]);

            // Mise à jour de la quantité en stock
            if ($request->qtyStock < $produit->qtyStock) {
                return back()->with('success', "Désolé! La nouvelle quantité en stock ne dois être inferieur à la quantité initial.");
            }
            
            // Mise à jour du produit
            $produit->update([
                'qtyStock' => $request->qtyStock,
            ]);
        
            //cal
                $cal = ($request->qtyStock * 25) / 100 ;
                $SM = floor($cal);

                $entree = $request->qtyStock - $produit->qtyStock ;
                $entreT = $entree + $produit->produitstat->entree;
                // $quantite = $entree + $produit->prodse->quantite;
            //

            $produit->produitstat->update([
                'stock_min' => $SM,
                'entree' => $entreT
            ]);

            if($entree > 0)
            {
                Produitse::create([
                    'quantite' => $entree,
                    'entree_sortie' => 1,
                    'produit_id' => $produit->id,
                ]);
            }
        
            return back()->with('success', "Stock du produit $produit->nom mis à jour avec succès");
        }
    //

    // //historique solde
    //     public function HistoriqueSolde()
    //     {
    //         $n=1;
    //         $Gsolde = Gsolde::first();
    //         $soldedays = Soldeday::all();

    //         return view('dashboard.admin.historique-solde.historique', compact('soldedays','n','Gsolde'));
    //     }
    // //

    // //recherche produit
    //     public function rechercheProduit(Request $request)
    //     {
    //         $this->validate($request, [
    //             'search'   => 'required|min:1',
    //         ]);  

    //         //données 
    //             $search = request()->input('search');
    //         // 

    //         //dd($choix);

    //         if(!empty($search))
    //         {
    //             $produits = Produit::Where('reference', 'like', "%$search%")
    //                     ->orWhere('nom', 'like', "%$search%")
    //                     ->orWhere('prix', 'like', "%$search%")
    //                     ->orWhere('promo', 'like', "%$search%")
    //                     ->paginate(20);

                        
    //             if(isset($request->type))
    //             {
    //                 if(!empty($request->type))
    //                 {
    //                     return view ('dashboard.admin.historique-stock.recherche-produit-stock', compact('produits'));
    //                 }
    //             }
                
    //             return view ('dashboard.admin.produit.recherche.recherche-produit', compact('produits'));
    //         }

    //         return redirect()->route('admin.home')->with('error', "Désolé! Aucune recherche n'a été effectuer.");
    //     }
    // //

    // //vendeur
    //     public function vendeurProduit(Vendeur $vendeur)
    //     {
    //         $produits = $vendeur->produits()->orderBy('updated_at','desc')->paginate(12);
    //         $souscategories = Souscategorie::all();

    //         if($vendeur->produits->count() > 0)
    //         {        
    //             return view('dashboard.admin.vendeur.vendeur-produit', compact('produits','vendeur','souscategories'));
    //         }

    //         return back()->with('error', "Désolé! aucun produit pour le fournisseur $vendeur->nom");
    //     }

    //     public function vendeurCompteUpdate(Vendeur $vendeur)
    //     {
    //         if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
    //             return $redirect;
    //         }

    //         $produits = $vendeur->produits()->get();
    //         // dd($produits->count());

    //         if($vendeur->produits->count() > 0)
    //         {   
    //             foreach($produits as $produit) 
    //             {
    //                 $produit->update([
    //                     'isvalide' => !$vendeur->isvalide
    //                 ]);
    //             }  
                
    //             $vendeur->update([
    //                 'isvalide' => !$vendeur->isvalide
    //             ]);

                
    //             if($vendeur->isvalide){ $etat = "activé"; }else{ $etat = "désactivé"; }

    //             return back()->with('success', "$vendeur->nom_entreprise : compte $etat avec succès");
    //         }

    //         return back()->with('error', "Désolé! aucun produit pour le fournisseur $vendeur->nom_entreprise");
    //     }
    // //
    
    // //message recu
    //     public function historique()
    //     {
    //         $messages = Message::orderBy('updated_at','desc')->paginate(20);
    //         return view('dashboard.admin.message.historique', compact('messages'));
    //     }
    //     public function messageDestroy(Message $message)
    //     {
    //         if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
    //             return $redirect;
    //         }

    //         //donnée
    //             $nom = $message->nom;
    //             $prenom = $message->prenom;
    //         //

    //         $message->delete();
    //         return back()->with('success', "Message de $nom $prenom supprimé avec succès");
    //     }
    //     public function messageDestroyAll()
    //     {
    //         if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
    //             return $redirect;
    //         }
            
    //         $messages = Message::all();

    //         foreach($messages as $message){
    //             $message->delete();
    //         }

    //         return back()->with('success', "Historique vidé avec succès");
    //     }
    // //

    // //profile
    //     public function profile()
    //     {
    //         return view('dashboard.admin.profile.profile');
    //     }
    //     public function profileUpdate(Request $request)
    //     {
    //         //données
    //             $password = auth()->user()->password;
    //             $photo = auth()->user()->photo;
    //         //
            
    //         $this->validate($request, [
    //             'contact'   => 'required|unique:admins,contact,' . auth()->user()->id . '|min:8|max:12',
    //             'email'   => 'required|email|unique:admins,email,' . auth()->user()->id . '|min:8',
    //             'nom'   => 'required|min:4',
    //             'prenom'   => 'required|min:4',
    //             'identifiant'   => 'required|min:4',
    //         ]);
            
    //         if(!empty($request->password))
    //         {
    //             $this->validate($request, [
    //                 'password'   => 'required|min:5',
    //             ]);
    
    //             $password = Hash::make($request->password);
    //         }
    
    //         if (!empty($request->photo))
    //         {
    //             $this->validate($request, [
    //                 'photo' => 'required|mimes:png,jpg,jpeg',
    //             ]);
    
    //             if(auth()->user()->photo) { Storage::disk('public')->delete(auth()->user()->photo); }
    
    //             $filename = time() . '.' . $request->photo->extension();
    //             $photo = $request->file('photo')->storeAs(
    //                 'AdminPhoto',
    //                 $filename,
    //                 'public'
    //             );
    //         }

    //         auth()->user()->update([
    //             'nom' => $request->nom,
    //             'prenom' => $request->prenom,
    //             'contact' => $request->contact,
    //             'email' => $request->email,
    //             'photo' => $photo,
    //             'identifiant' => $request->identifiant,
    //             'password' => $password
    //         ]);
    
    //         return back()->with('success','modification effectuée avec success');

    //     }
    //     public function adminCompteUpdate(Admin $admin)
    //     {
    //         if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
    //             return $redirect;
    //         }

    //         //donnée
    //             $noms = $admin->nom;
    //         //
    //         $admin->update([
    //             'isvalide' => !$admin->isvalide
    //         ]);

    //         //dd($produit->isvalide);
    //         if($admin->isvalide)
    //         {
    //             return back()->with('success', "$admin->nom $admin->prenom : compte activé avec succès");
    //         }
    //         else
    //         {
    //             return back()->with('success', "$admin->nom $admin->prenom : compte désactivé avec succès");
    //         }

    //     }
    //     public function superAdminAutoriseUpdate(Admin $admin)
    //     {
    //         if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
    //             return $redirect;
    //         }

    //         //donnée
    //             $noms = $admin->nom;
    //         //

    //         $admin->update([
    //             'autorise' => !$admin->autorise
    //         ]);

    //         //dd($produit->isvalide);
    //         if($admin->autorise)
    //         {
    //             return back()->with('success', "$admin->nom $admin->prenom : compte d'autorisation activé avec succès");
    //         }
    //         else
    //         {
    //             return back()->with('success', "$admin->nom $admin->prenom : compte d'autorisation désactivé avec succès");
    //         }

    //     }
    // //
    
    // //Formation Formateur
    //     public function affectationFormationFormateurStore(Request $request, Formation $formation)
    //     {
    //         if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
    //             return $redirect;
    //         }

    //         $this->validate($request, [
    //             'formateur_id'   => 'required|min:1'
    //         ]);
    
    //         $formationFormateur = Formationformateur::create([
    //             'formation_id' => $formation->id ,
    //             'formateur_id' => $request->formateur_id ,
    //             'isvalide' => 1 ,
    //         ]);
    
    //         $noms = "$formation->nom" ;
                
    //         return back()->with('success', "Affectation ajouté avec succès");
    //     }
    //     public function affectationFormationFormateurUpdate(Request $request, Formationformateur $formationformateur)
    //     {
    //         if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
    //             return $redirect;
    //         }

    //         //données
    //             $password = auth()->user()->password;
    //             $photo = auth()->user()->photo;
    //         //
            
    //         $this->validate($request, [
    //             'formateur_id'   => 'required|unique:formationformateurs,formateur_id,' . $formationformateur->formateur_id . '|min:1',
    //         ]);

    //         $formationformateur->update([
    //             'formateur_id' => $request->formateur_id,
    //         ]);
    
    //         return back()->with('success',"Nouvelle affectation effectuée avec success");

    //     }
    //     public function retirerAffectationFormation(Formationformateur $formationformateur)
    //     {
    //         if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
    //             return $redirect;
    //         }

    //         //donnée
    //             $noms = $formationformateur->formateur->nom." ".$formationformateur->formateur->prenom ;
    //         //

    //         $formationformateur->delete();
                
    //         return back()->with('success', "Affectation retiré avec succès");
    //     }
        
    //     public function formateurFormationEncours(Formateur $formateur)
    //     {
    //         //donnée
    //             $noms = $formateur->nom." ".$formateur->prenom ;
    //         //

    //         $formationFormateurs = $formateur->formationformateurs()->where('isvalide', 0)->count();
    //         //dd($commandeLivreurs);
    //         if($formationFormateurs > 0)
    //         {
    //             return view('dashboard.admin.formateur.formation-encours', compact('formateur'));
    //         }
            
    //         return back()->with('error',"Désolé! Ce formateur n'a aucune formation en cours.");
    //     }
    // //
    
    // //Commande livreur
    //     public function affectationCommandeLivreurStore(Request $request, Commande $commande)
    //     {
    //         $this->validate($request, [
    //             'livreur_id'   => 'required|min:1'
    //         ]);
    
    //         $commandeLivreur = Commandelivreur::create([
    //             'commande_id' => $commande->id ,
    //             'livreur_id' => $request->livreur_id ,
    //             'isvalide' => 0,
    //         ]);
    
    //         $noms = $commande->client->nom ;
                
    //         return back()->with('success', "Affectation ajouté avec succès");
    //     }
    //     public function affectationCommandeLivreurUpdate(Request $request, Commandelivreur $commandelivreur)
    //     {
    //         //données
    //             $password = auth()->user()->password;
    //             $photo = auth()->user()->photo;
    //         //
            
    //         $this->validate($request, [
    //             'livreur_id'   => 'required|unique:commandelivreur,livreur_id,' . $commandelivreur->livreur_id . '|min:1',
    //         ]);

    //         $commandelivreur->update([
    //             'livreur_id' => $request->livreur_id,
    //         ]);
    
    //         return back()->with('success',"Nouvelle affectation effectuée avec success");

    //     }
    //     public function retirerAffectationCommande(Commandelivreur $commandelivreur)
    //     {
    //         //donnée
    //             $noms = $formationformateur->formateur->nom." ".$formationformateur->formateur->prenom ;
    //         //

    //         $formationformateur->delete();
                
    //         return back()->with('success', "Affectation retiré avec succès");
    //     }
        
    //     public function livreurLivraisonEncours(Livreur $livreur)
    //     {
    //         //donnée
    //             $noms = $livreur->nom." ".$livreur->prenom ;
    //         //

    //         $commandeLivreurs = $livreur->commandelivreurs()->where('isvalide', 0)->count();
    //         //dd($commandeLivreurs);
    //         if($commandeLivreurs > 0)
    //         {
    //             return view('dashboard.admin.livreur.livraison-encours', compact('livreur'));
    //         }
            
    //         return back()->with('error',"Désolé! Ce livreur n'a aucune livraison en cours.");
    //     }
    // //

    // //produit
    //     //supprimer une image
    //         public function ProduitImageDestroy(Request $request, Produit $produit)
    //         {
    //             if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
    //                 return $redirect;
    //             }

    //             //dd($request->numero);

    //             // Validation
    //             $request->validate([
    //                 'numero' => 'required|min:1',
    //             ]);
        
    //             //données
    //                 $noms = $produit->nom;
    //                 $number = $request->numero;
    //             //
                
    //             if($number == "2")
    //             {
    //                 if($produit->produitimg->image2){Storage::disk('public')->delete($produit->produitimg->image2);}
    //                 $produit->produitimg->update([
    //                     'image2' => null,
    //                 ]);
    //             }
    //             if($number == "3")
    //             {
    //                 if($produit->produitimg->image3){Storage::disk('public')->delete($produit->produitimg->image3);}
    //                 $produit->produitimg->update([
    //                     'image3' => null,
    //                 ]);
    //             }
    //             if($number == "4")
    //             {
    //                 if($produit->produitimg->image4){Storage::disk('public')->delete($produit->produitimg->image4);}
    //                 $produit->produitimg->update([
    //                     'image4' => null,
    //                 ]);
    //             }

    //             return back()->with('success', "Image $number de $noms supprimé avec succès");
    //         }
    //     //
    // //





















    

    // //historique solde day 
    //     public function historiqueSoldeDay()
    //     {
    //         $n = 1;
    //         $soldedays = Soldeday::orderBy('updated_at','desc')->paginate(20);

    //         return view('dashboard.admin.historique-solde.historique', compact('soldedays','n'));
    //     }

    // //auth 
    //     public function allAdmin() 
    //     {
    //         $n = 1;
    //         $admins = Admin::orderBy('updated_at','desc')->get()->except(auth()->user()->id);
    //         return view('dashboard.admin.auth.all-admin', compact('admins','n'));
    //     }
    //     public function authCompteUpdate(Admin $admin)
    //     {
    //         //$admin = Admin::find($id);string $id
    
    //         $admin->update([
    //             'isvalide' => !$admin->isvalide
    //         ]);
    
    //         $noms = $admin->nom;
    
    //         if($admin->isvalide)
    //         {
    //             return back()->with('message', $noms.' : Compte activé avec succès.');
    //         }
    //         else
    //         {
    //             return back()->with('message', $noms.' : Compte désactivé avec succès.');
    //         }
    //     }
    
    // // //produit
    // //     public function categorieProduit(Categorie $categorie)
    // //     {
    // //         $produits = $categorie->produits()->orderBy('updated_at','desc')->paginate(20);
    // //         return view('dashboard.admin.produit.all-produit', compact('produits','categorie'));
    // //     }
    // //     public function scategorieProduit(Scategorie $scategorie)
    // //     {
    // //         $produits = $scategorie->produits()->orderBy('updated_at','desc')->paginate(20);
    // //         return view('dashboard.admin.produit-scategorie.all-produit', compact('produits','scategorie'));
    // //     }
    // //     //stock 
    // //         // public function produitStockUpdate(Produit $produit)
    // //         // {
    // //         //     $noms = $produit->nom;

    // //         //     $produit->update([
    // //         //         'stock' => !$produit->stock
    // //         //     ]);

    // //         //     dd('ok');

    // //         //     if($produit->stock)
    // //         //     {
    // //         //         return back()->with('message','Le stock du produit '.$noms.' à bien été activé avec succès.');
    // //         //     }
    // //         //     else
    // //         //     {
    // //         //         $produit->update([
    // //         //             'qtyStock' => 0
    // //         //         ]);
    // //         //         return back()->with('message','Le stock du produit '.$noms.' à bien été désactivé avec succès.');
    // //         //     }

    // //         // }
    // //     //
    // //     //promo
    // //         public function promoProduit(Produit $produit)
    // //         {
    // //             return view('dashboard.admin.produit.promo-produit', compact('produit'));
    // //         }
    // //         public function promoProduitStore(Request $request, Produit $produit)
    // //         {
    // //             $noms = $produit->nom;

    // //             $produit->update($request->post());

    // //             $categorie = $produit->categorie_id;

    // //             return redirect()->route('admin.categorie.produit', compact('categorie'))->with('messages',$noms.' mis en promotion avec succès');
    // //         }
    // //         public function promoProduitDestroy(Produit $produit)
    // //         {
    // //             $noms = $produit->nom;

    // //             $produit->update([
    // //                 'promo' => 0,
    // //             ]);

    // //             return back()->with('messages','promotion retirée avec succès sur '.$noms);
    // //         }
    // //     //general
    // //         public function suspendreProduit(Produit $produit)
    // //         {
    // //             if($produit->isvalide)
    // //             {
    // //                 $noms = $produit->nom;

    // //                 $produit->update([
    // //                     'isvalide' => !$produit->isvalide
    // //                 ]);
    // //                 return back()->with('message',$noms.' : suspension retiréé avec succès');
    // //             }
    // //             else
    // //             {
    // //                 $noms = $produit->nom;

    // //                 $produit->update([
    // //                     'isvalide' => !$produit->isvalide
    // //                 ]);
    // //                 return back()->with('message',$noms.' suspendu avec succès');
    // //             }

    // //         }
    // //         public function meilleurProduitVenduUpdate(Produit $produit)
    // //         {
    // //             $noms = $produit->nom;

    // //             $produit->update([
    // //                 'mvente' => !$produit->mvente
    // //             ]);
    
    // //             if($produit->mvente)
    // //             {
    // //                 return back()->with('message',$noms.' à bien été ajouté aux produits les plus vendu.');
    // //             }
    // //             else
    // //             {
    // //                 return back()->with('message',$noms.' à bien été retiré des produits les plus vendu.');
    // //             }

    // //         }
    // //     //
    // //     //supprimer une image
    // //         public function ProduitImageDestroy(Request $request, Produit $produit)
    // //         {
    // //             if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
    // //                 return $redirect;
    // //             }

    // //             //dd($request->numero);

    // //             // Validation
    // //             $request->validate([
    // //                 'numero' => 'required|min:1',
    // //             ]);
        
    // //             //données
    // //                 $noms = $produit->nom;
    // //                 $number = $request->numero;
    // //             //
                
    // //             if($number == "2")
    // //             {
    // //                 if($produit->produitimg->image2){Storage::disk('public')->delete($produit->produitimg->image2);}
    // //                 $produit->produitimg->update([
    // //                     'image2' => null,
    // //                 ]);
    // //             }
    // //             if($number == "3")
    // //             {
    // //                 if($produit->produitimg->image3){Storage::disk('public')->delete($produit->produitimg->image3);}
    // //                 $produit->produitimg->update([
    // //                     'image3' => null,
    // //                 ]);
    // //             }
    // //             if($number == "4")
    // //             {
    // //                 if($produit->produitimg->image4){Storage::disk('public')->delete($produit->produitimg->image4);}
    // //                 $produit->produitimg->update([
    // //                     'image4' => null,
    // //                 ]);
    // //             }

    // //             return back()->with('success', "Image $number de $noms supprimé avec succès");
    // //         }
    // //     //
    // // //
        
    // //commentaire
    //     public function commentaire()
    //     {
    //         $n = 1;
    //         $produits = Produit::where('isvalide',1)->orderBy('updated_at','desc')->get();
    //         return view('dashboard.admin.commentaire.commentaire', compact('produits','n'));
    //     }
    //     public function commentaireProduit(Produit $produit)
    //     {
    //         $n = 1;
    //         return view('dashboard.admin.commentaire.commentaire-produit', compact('produit','n'));
    //     }
    //     public function commentaireProduitDestroy(Avisproduit $avisproduit)
    //     {
    //         $nom = $avisproduit->nom;
    //         $prenom = $avisproduit->prenom;

    //         $avisproduit->delete();

    //         return back()->with('message', 'commentaire '.$nom.' '.$prenom.' supprimé avec succès');
    //     }
    // //

}
