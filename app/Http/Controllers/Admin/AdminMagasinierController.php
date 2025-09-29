<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Produitse;
use App\Models\Clientdevis;
use Illuminate\Routing\Controller;

class AdminMagasinierController extends Controller
{
    //categorie
        public function allCategorie()
        {
            $categories = Categorie::orderBy('updated_at','desc')->get();
            return view('dashboard.admin.magasinier.categorie.all-categorie', compact('categories'));
        }
        public function categorieProduit(Categorie $categorie)
        {
            $produits = $categorie->produits()->orderBy('updated_at','desc')->get();
            return view('dashboard.admin.magasinier.categorie.categorie-produit', compact('categorie','produits'));
        }
    //
    //produit
        public function allProduit()
        {
            $produits = Produit::orderBy('updated_at','desc')->get();
            return view('dashboard.admin.magasinier.produit.all-produit', compact('produits'));
        }
    //
    //stock
        public function StockProduitUn(Categorie $categorie)
        {
            $produits = $categorie->produits()->orderBy('updated_at', 'desc')->get();

            return view('dashboard.admin.magasinier.historique-stock.entrepot', compact('produits','categorie'));
        }
        public function StockProduitDeux()
        {
            $produitses = Produitse::orderBy('updated_at', 'desc')->get();

            return view('dashboard.admin.magasinier.historique-stock.stock2', compact('produitses'));
        }
    //
    //confirme livraison   
        public function factureLivre()
        { 
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1)->where('livraison', 1);
                })->orderBy('updated_at','desc')->get();
            return  view('dashboard.admin.magasinier.facture-client.livre', compact('clientdevis'));
        }
        public function factureNonLivre()
        { 
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1)->where('livraison', 0);
                })->orderBy('updated_at','desc')->get();
            return  view('dashboard.admin.magasinier.facture-client.non-livre', compact('clientdevis'));
        }
    //
}
