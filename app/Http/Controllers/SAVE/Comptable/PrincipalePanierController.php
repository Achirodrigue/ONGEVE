<?php

namespace App\Http\Controllers\Principale;

//use Carbon\Carbon;
use App\Models\Produit;
use App\Models\Secteur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class PrincipalePanierController extends Controller
{
    public function monPanier()
    {
        $produits = Produit::orderBy('updated_at','desc')->where('isvalide', 1)->get()->take(6);

        //dd(Cart::total());
        if( Cart::count() > 0 ){
            return view('principale.panier.panier', compact('produits'));
        }
        
        return redirect()->route('accueil')->with('error','Désolé! Le panier est vide');
    }

    public function facturation()
    {
        $secteurs = Secteur::orderBy('nom','asc')->get();
        $Psecteur = Secteur::orderBy('nom','asc')->first();
        $produits = Produit::orderBy('updated_at','desc')->where('isvalide', 1)->get()->take(6);

        if( Cart::count() > 0 ){
            return view('principale.panier.facturation', compact('produits','secteurs','Psecteur'));
        }
        
        return redirect()->route('accueil')->with('error','Désolé! Le panier est vide');
    }

    public function viderPanier()
    {
        Cart::destroy();
        return back()->with('success','Panier totalement vidé');
    }

    public function retirerProduitPanier($rowId)
    { 
        Cart::remove($rowId);
        return back()->with('success','Le produit a bien été retiré du panier');
    }

    //panier 
        public function ajouterPanierStore(Request $request, Produit $produit)
        {
            // dd(1);
            if($produit->stock && $produit->qtyStock >= 1)
            {
                //données
                    $qty = 1;
                    if (isset($request->quantite)) {
                        if (!empty($request->quantite)) {
                            $qty = $request->quantite;
                        }
                    }
                //

                if($qty > $produit->qtyStock)
                {
                    return back()->with('error', "Désolé! La quantité du produit $produit->nom choisi est supperieur au stock restant");
                }

                // Vérifier si le produit est déjà dans le panier
                $duplicata = Cart::search(function ($cartItem) use ($produit) {
                    return $cartItem->id == $produit->id;
                });

                if ($duplicata->isNotEmpty()) {
                    return back()->with('errorP', "L'article a déjà été ajouté au panier");
                }

                //dd($duplicata);
                // Déterminer le prix final (avec promo si applicable)
                $prix_unitaire = $produit->promo > 0 ? $produit->promo : $produit->prix;
                $prix_total = $prix_unitaire * $request->quantite;

                // Ajouter au panier
                Cart::add([
                    'id' => $produit->id,
                    'name' => $produit->nom,
                    'qty' => $qty,
                    'price' => $prix_unitaire,
                    'attributes' => [
                        'image' => $produit->image, // Ajoutez d'autres infos utiles
                        'description' => $produit->description
                    ]
                ])->associate(Produit::class);

                return back()->with('success', "Le produit $produit->nom a bien été ajouté au panier");
            }
            else
            {
                return back()->with('error', "Désolé! Le produit $produit->nom est en manque de stock");
            }
            
        }

        public function updateMultiplePanier(Request $request)
        {
            $updates = $request->input('produit'); // Récupère les données envoyées (array)
            //dd($updates);

            foreach ($updates as $rowId => $details) {
                //dd($details);
                Cart::update($rowId, [
                    'qty' => $details['qty']
                ]);
            }

            return redirect()->back()->with('success', 'Panier mis à jour avec succès.');
        }

}
