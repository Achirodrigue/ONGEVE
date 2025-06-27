<?php

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Clientdevis;
use App\Models\Particulier;
use App\Models\Souscategorie;

//commercial verification
    function PageAccessibleCommercial()
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('commercial.home')->with('error',"Désolé! vous n'êtes pas un responsable commercial pour effectuer cette opération");
        } 
    }
//

//Client et Particulier Commande Impayé
    function ClientCommandeImpaye($client)
    {
        $clientdevisTTC = 0;
        foreach($client->clientdevis->where('paye', 0) as $clientdevis)
        {
            $clientdevisTTC += $clientdevis->total_ttc;
        }   
    }   
    function ParticulierCommandeImpaye($particulier)
    {
        $particulierdevisTTC = 0;
        foreach($particulier->particulierdevis->where('paye', 0) as $particulierdevis)
        {
            $particulierdevisTTC += $particulierdevis->total_ttc;
        }   
    }   
//

function storeImage($image, $dossier)
{
    $filename = time() . '_' . uniqid() . '.' . $image->extension();
    return $image->storeAs($dossier, $filename, 'public');
}

// Fonction pour supprimer les accents
    function removeAccents($string)
    {
        return strtr(utf8_decode($string), 
            utf8_decode('ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝŸàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'),
            'AAAAAAACEEEEIIIIDNOOOOOOUUUUYYaaaaaaaceeeeiiiidnoooooouuuuyy'
        );
    }
//

//clientdevis
    function clientdevis()
    {
        $clientdevis = Clientdevis::where('etat', null)->orderBy('updated_at','desc')->get();
        return $clientdevis;
    }
    function clientdevisvalide()
    {
        $clientdevis = Clientdevis::where('etat', '1')->orderBy('updated_at','desc')->get();
        return $clientdevis;
    }
    function clientdevisrefuse()
    {
        $clientdevis = Clientdevis::where('etat', '2')->orderBy('updated_at','desc')->get();
        return $clientdevis;
    }
//

//catégorie
    function categories()
    {
        $categories = Categorie::orderBy('nom','asc')->get();
        return $categories;
    }
    function prixCategorieProduit(Categorie $categorie)
    {
        $totalTTC = 0;

        foreach($categorie->produits as $produit)
        {
            $totalTTC = $totalTTC + $produit->prix_unitaire;
        }

        return getprice($totalTTC);
    }
//

//client
    function clients()
    {
        $clients = Client::orderBy('nom','asc')->get();
        return $clients;
    }
//

//particulier
    function particuliers()
    {
        $particuliers = Particulier::orderBy('nom','asc')->get();
        return $particuliers;
    }
//

//produit
    function produits()
    {
        $produits = Produit::orderBy('nom','asc')->get();
        return $produits;
    }
//

function getprice($price)
{
    // Remplace les virgules éventuelles par rien pour éviter les erreurs de conversion
    $price = str_replace(',', '', $price);
    
    // Convertir en float
    $price = floatval($price);

    // Formater en entier avec espace comme séparateur des milliers
    return number_format($price, 0, '.', ' ');
}













// function dateFormate($ooo)
// {
//     $date = Carbon::parse($ooo)->format('d-m-Y');

//     return $date;
// }


// function vendeurs()
// {
//     $vendeurs = Vendeur::orderBy('nom_entreprise','asc')->get();
//     return $vendeurs;
// }

// //commande
//     function TNC()
//     {
//         $TNC = 0;

//         if(Auth()->user()->role)
//         {
//             $commandesecteurs = Commandesecteur::all();
//             foreach($commandesecteurs as $commandesecteur)
//             {
//                 if(!$commandesecteur->commande->isvalide)
//                 {
//                     $TNC++;
//                 }
//             }
//         }
//         else
//         {
//             if(Auth()->user()->adminsecteur->secteur_id)
//             {
//                 $commandesecteurs = Commandesecteur::where('secteur_id', Auth()->user()->adminsecteur->secteur_id)->get();
//                 foreach($commandesecteurs as $commandesecteur)
//                 {
//                     if(!$commandesecteur->commande->isvalide)
//                     {
//                         $TNC++;
//                     }
//                 }
//             }
//             else
//             {
//                 $commandesecteurs = Commandesecteur::all();
//                 foreach($commandesecteurs as $commandesecteur)
//                 {
//                     if(!$commandesecteur->commande->isvalide)
//                     {
//                         $TNC++;
//                     }
//                 }
//             }
//         }
        
//         return $TNC;
//     }
//     function TCL()
//     {   
//         $TCL = 0;

//         if(Auth()->user()->role)
//         {
//             $commandesecteurs = Commandesecteur::all();
//             foreach($commandesecteurs as $commandesecteur)
//             {
//                 if($commandesecteur->commande->isvalide)
//                 {
//                     $TCL++;
//                 }
//             }
//         }
//         else
//         {
//             if(Auth()->user()->adminsecteur->secteur_id)
//             {
//                 $commandesecteurs = Commandesecteur::where('secteur_id', Auth()->user()->adminsecteur->secteur_id)->get();
//                 foreach($commandesecteurs as $commandesecteur)
//                 {
//                     if($commandesecteur->commande->isvalide)
//                     {
//                         $TCL++;
//                     }
//                 }
//             }
//             else
//             {
//                 $commandesecteurs = Commandesecteur::all();
//                 foreach($commandesecteurs as $commandesecteur)
//                 {
//                     if($commandesecteur->commande->isvalide)
//                     {
//                         $TCL++;
//                     }
//                 }
//             }
//         }

//         return $TCL;
//     }
//     function TCEC()
//     {   
//         $commandelivreurs = Commandelivreur::all();
//         $TCEC = 0;

//         if(Auth()->user()->role)
//         {
//             $TCEC = 20;
//         }
//         else
//         {
//             if(Auth()->user()->adminsecteur->secteur_id)
//             {
//                 foreach($commandelivreurs as $commandelivreur)
//                 {
//                     if ($commandelivreur->commande->commandesecteur->secteur_id === Auth()->user()->adminsecteur->secteur_id) {
//                         $TCEC++ ;
//                     }
//                 }
//             }
//             else
//             {
//                 $TCEC = 20;
//             }
//         }
        
//         return $TCEC;
//     }
// //

// function commandes()
// {
//     $commandes = Commande::where('isvalide',0)->orderBy('updated_at','desc')->get();

//     $commandeTotal = 0;
//     $commandeTotalAdmin = null;
//     if($commandes->count() > 0)
//     {
//         foreach($commandes as $commande)
//         {
//             if($commande->commandelivreur)
//             {
//                 $commandeTotal++;
//             }
            
//             if(!Auth()->user()->role)
//             {
//                 if(Auth()->user()->adminsecteur->secteur_id)
//                 {
//                     if($commande->commandesecteurs->secteur_id === Auth()->user()->adminsecteur->secteur_id)
//                     {
//                         $commandeTotalAdmin++;
//                     }
//                 }
//             }
//         }
//     }

//     return $commandeTotal;
// }

// //produit
//     function produit()
//     {
//         $produits = Produit::orderBy('updated_at','desc')->where('isvalide', 1)->get()->take(12);//->where('stock', 1)->where('qtyStock','>=', 1)
//         return $produits;
//     }
//     function produitpromo()
//     {
//         $produits = Produit::orderBy('updated_at','desc')->where('isvalide', 1)->where('stock', 1)->where('qtyStock','>=', 1)->where('promo','!=',null)->get();
//         return $produits;
//     }
//     function produitAncien()
//     {
//         $produits = Produit::where('isvalide', 1)->where('stock', 1)->where('qtyStock','>=', 1)->get()->take(12);
//         return $produits;
//     }

//     function etoileProduit(Produit $produit)
//     {
//         $prodTotalEtoile = 0;

//         if($produit->avisprods->count() > 0)
//         {
//             $totalEtoile = 0;

//             foreach($produit->avisprods as $avisproduit)
//             {
//                 $totalEtoile += $avisproduit->etoile ;
//             }

//             $prodTotalEtoile = round($totalEtoile / $produit->avisprods->count());  
//         }

//         return $prodTotalEtoile;
//     }

//     function poucentageReduction(Produit $produit)
//     {
//         $reduction = $produit->prix - $produit->promo;
//         $pourcent = ($reduction / $produit->prix) * 100;
//         $pourcentage = round($pourcent);
//         return $pourcentage;
//     }
// //

// function souscategories()
// {
//     $souscategories = Souscategorie::orderBy('updated_at','desc')->get();
//     return $souscategories;
// }

// function getprice($price)
// {
//     // Remplace les virgules éventuelles par rien pour éviter les erreurs de conversion
//     $price = str_replace(',', '', $price);
    
//     // Convertir en float
//     $price = floatval($price);

//     // Formater en entier avec espace comme séparateur des milliers
//     return number_format($price, 0, '.', ' ') . ' Fcfa';
// }

// function getpriceSF($price)
// {
//     // Remplace les virgules éventuelles par rien pour éviter les erreurs de conversion
//     $price = str_replace(',', '', $price);
    
//     // Convertir en float
//     $price = floatval($price);

//     // Formater en entier avec espace comme séparateur des milliers
//     return number_format($price, 0, '.', '');
// }
// function getpriceSFpdf($price)
// {
//     // Remplace les virgules éventuelles par rien pour éviter les erreurs de conversion
//     $price = str_replace(',', '', $price);
    
//     // Convertir en float
//     $price = floatval($price);

//     // Formater en entier avec espace comme séparateur des milliers
//     return number_format($price, 0, '.', ' ');
// }

// //navbar
//     function CategScateg(Categorie $categorie)
//     {
//         $ss = $categorie->souscategories->count();
//         $total = 0;
//         if($ss > 0)
//         {
//             foreach($categorie->souscategories as $souscategorie)
//             {
//                 if($souscategorie->produits->where('isvalide', 1)->count() > 0)
//                 {
//                     $total++;
//                 }
//             }
//         }

//         return $total;
//     }

// //auth
//     function modifAccessibleAdmin()
//     {
        
//         $accessible = null;

//         if(auth()->user()->role)
//         {
//             $accessible = 1;
//         }
//         else
//         {
//             if(auth()->user()->autorise && auth()->user()->adminsecteur?->secteur_id === null)
//             {
//                 $accessible = 1;
//             }
//         }

//         return $accessible;
//     }
// //