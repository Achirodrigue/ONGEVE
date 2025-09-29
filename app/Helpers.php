<?php

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Projet;
use App\Models\Depense;
use App\Models\Employe;
use App\Models\Produit;
use App\Models\Delaipay;
use App\Models\Moyenpay;
use App\Models\Categorie;
use App\Models\Pvehicule;
use App\Models\Pchauffeur;
use App\Models\Clientdevis;
use App\Models\Fournisseur;
use App\Models\Categorieprod;
use App\Models\Entrepotcateg;
use App\Models\Pvehiculedocname;
use App\Models\Pchauffeurdocname;
use App\Models\Pcategorievehicule;
use App\Models\Fournisseurfacturecomptable;

//Fournisseur facture
    //individuel
        function FFI(Fournisseur $fournisseur)
        {
            $fournisseurfacturecomptables = $fournisseur->fournisseurfacturecomptables()->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
            $TTC = 0;
            foreach($fournisseurfacturecomptables as $fournisseurfacturecomptable)
            {
                $TTC += $fournisseurfacturecomptable->total_payer;
            }   
            return getpricefr($TTC);
        }  
        function FFPT(Fournisseur $fournisseur)
        {
            $fournisseurfacturecomptables = $fournisseur->fournisseurfacturecomptables()->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            $TTC = 0;
            foreach($fournisseurfacturecomptables as $fournisseurfacturecomptable)
            {
                $TTC += $fournisseurfacturecomptable->total_payer;
            }   
            return getpricefr($TTC);
        }   
        function FFPY(Fournisseur $fournisseur)
        {
            $fournisseurfacturecomptables = $fournisseur->fournisseurfacturecomptables()->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
            $TTC = 0;
            foreach($fournisseurfacturecomptables as $fournisseurfacturecomptable)
            {
                $TTC += $fournisseurfacturecomptable->total_payer;
            }   
            return getpricefr($TTC);
        }  
    //

    //generale
        function FFIG()
        {
            $fournisseurfacturecomptables = Fournisseurfacturecomptable::where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
            $TTC = 0;
            foreach($fournisseurfacturecomptables as $fournisseurfacturecomptable)
            {
                $TTC += $fournisseurfacturecomptable->total_payer;
            }   
            return getpricefr($TTC);
        }  
        function FFPTG()
        {
            $fournisseurfacturecomptables = Fournisseurfacturecomptable::where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            $TTC = 0;
            foreach($fournisseurfacturecomptables as $fournisseurfacturecomptable)
            {
                $TTC += $fournisseurfacturecomptable->total_payer;
            }   
            return getpricefr($TTC);
        }   
        function FFPYG()
        {
            $fournisseurfacturecomptables = Fournisseurfacturecomptable::where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
            $TTC = 0;
            foreach($fournisseurfacturecomptables as $fournisseurfacturecomptable)
            {
                $TTC += $fournisseurfacturecomptable->total_payer;
            }  
            return getpricefr($TTC); 
        }  
    //

    //chiffre d'affaire 
        //individuel
            function CAFPT(Fournisseur $fournisseur)
            {
                $fournisseurfacturecomptables = $fournisseur->fournisseurfacturecomptables()->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
                $TTC = 0;
                foreach($fournisseurfacturecomptables as $fournisseurfacturecomptable)
                {
                    $TTC += $fournisseurfacturecomptable->versement;
                }   
                return getpricefr($TTC);
            }   
            function CAFPY(Fournisseur $fournisseur)
            {
                $fournisseurfacturecomptables = $fournisseur->fournisseurfacturecomptables()->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
                $TTC = 0;
                foreach($fournisseurfacturecomptables as $fournisseurfacturecomptable)
                {
                    $TTC += $fournisseurfacturecomptable->versement;
                }  
                return getpricefr($TTC); 
            }
        //   
        //generale
            function CAFPTG()
            {
                $fournisseurfacturecomptables = Fournisseurfacturecomptable::where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
                $TTC = 0;
                foreach($fournisseurfacturecomptables as $fournisseurfacturecomptable)
                {
                    $TTC += $fournisseurfacturecomptable->versement;
                }   
                return getpricefr($TTC);
            }   
            function CAFPYG()
            {
                $fournisseurfacturecomptables = Fournisseurfacturecomptable::where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
                $TTC = 0;
                foreach($fournisseurfacturecomptables as $fournisseurfacturecomptable)
                {
                    $TTC += $fournisseurfacturecomptable->versement;
                }  
                return getpricefr($TTC); 
            }
        //  
    //
//

//Client facture
    //individuel
        function CFI(Client $client)
        {
            $clientdevis = $client->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
            $TTC = 0;
            foreach($clientdevis as $clientdevis)
            {
                $TTC += $clientdevis->total_payer;
            }   
            return getpricefr($TTC);
        }  
        function CFPT(Client $client)
        {
            $clientdevis = $client->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            $TTC = 0;
            foreach($clientdevis as $clientdevis)
            {
                $TTC += $clientdevis->total_payer;
            }   
            return getpricefr($TTC);
        }   
        function CFPY(Client $client)
        {
            $clientdevis = $client->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
            $TTC = 0;
            foreach($clientdevis as $clientdevis)
            {
                $TTC += $clientdevis->total_payer;
            }   
            return getpricefr($TTC);
        }  
    //
    //generale
        function CFIG()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
            $TTC = 0;
            foreach($clientdevis as $clientdevis)
            {
                $TTC += $clientdevis->total_payer;
            }   
            return getpricefr($TTC);
        }  
        function CFPTG()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            $TTC = 0;
            foreach($clientdevis as $clientdevis)
            {
                $TTC += $clientdevis->total_payer;
            }   
            return getpricefr($TTC);
        }   
        function CFPYG()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
            $TTC = 0;
            foreach($clientdevis as $clientdevis)
            {
                $TTC += $clientdevis->total_payer;
            }  
            return getpricefr($TTC); 
        }  
    //
    //chiffre d'affaire
        // individuel
            function CAPT(Client $client)
            {
                $clientdevis = $client->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
                $TTC = 0;
                foreach($clientdevis as $clientdevis)
                {
                    $TTC += $clientdevis->versement;
                }   
                return getpricefr($TTC);
            }   
            function CAPY(Client $client)
            {
                $clientdevis = $client->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
                $TTC = 0;
                foreach($clientdevis as $clientdevis)
                {
                    $TTC += $clientdevis->versement;
                }  
                return getpricefr($TTC); 
            }  
        //
        // generale
            function CAPTG()
            {
                $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
                $TTC = 0;
                foreach($clientdevis as $clientdevis)
                {
                    $TTC += $clientdevis->versement;
                }   
                return getpricefr($TTC);
            }   
            function CAPYG()
            {
                $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
                $TTC = 0;
                foreach($clientdevis as $clientdevis)
                {
                    $TTC += $clientdevis->versement;
                }  
                return getpricefr($TTC); 
            }  
        //
    //
    //alerte
        function AFPTG()
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            return $clientdevis;
        } 
    //
//

//Depense interne
    function DI()
    {
        $depenses = Depense::all();
        $TTC = 0;
        foreach($depenses as $depenses)
        {
            $TTC += $depenses->montant;
        }   
        return getpricefr($TTC);
    } 
//

//fournisseur
    function fournisseurs()
    {
        $fournisseurs = Fournisseur::orderBy('nom','asc')->get();
        return $fournisseurs;
    }
//

//client
    function clients()
    {
        $clients = Client::orderBy('nom','asc')->get();
        return $clients;
    }
//

//produit
    function produits()
    {
        $produits = Produit::orderBy('updated_at','desc')->get();
        return $produits;
    }
//

//bilan periode produit
    function RechercheProduit($id)
    {
        $produit = Produit::find($id);
        return $produit;
    }
//

//Commercial
    //facture client general
        function ComCFIG()
        {
            if(auth()->user()->role)
            {
                $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                    $query->where('isvalide', 1);
                                })->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();      
            }else{
                $clientdevis = auth()->user()->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                                    $query->where('isvalide', 1);
                                })->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();      
            }
            
            $TTC = 0;
            foreach($clientdevis as $clientdevis)
            {
                $TTC += $clientdevis->total_payer;
            }   
            return getpricefr($TTC);
        }  
        function ComCFPTG()
        {
            if(auth()->user()->role)
            {
                $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                    $query->where('isvalide', 1);
                                })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            }else{
                $clientdevis = auth()->user()->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                                    $query->where('isvalide', 1);
                                })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            }

            $TTC = 0;
            $TTG = 0;
            foreach($clientdevis as $clientdevis)
            {
                $TTC += $clientdevis->versement;
                $TTG += $clientdevis->total_payer;
            }   
            return getpricefr($TTC)." / ".getpricefr($TTG);
        }   
        function ComCFPYG()
        {
            if(auth()->user()->role)
            {
                $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                                    $query->where('isvalide', 1);
                                })->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();  
            }else{
                $clientdevis = auth()->user()->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                                    $query->where('isvalide', 1);
                                })->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();  
            }

            $TTC = 0;
            $TTG = 0;
            foreach($clientdevis as $clientdevis)
            {
                $TTC += $clientdevis->versement;
                $TTG += $clientdevis->total_payer;
            }   
            return getpricefr($TTC)." / ".getpricefr($TTG);
        }  
    //
//

//projet
    function projets()
    {
        $projets = Projet::orderBy('updated_at','desc')->get();
        return $projets;
    }  
//

//commercial verification
    function PageAccessibleCommercial()
    {
        if(auth()->user()->role) 
        {
            // dd(auth()->user()->role);
            // return redirect()->route('commercial.home')->with('error',"Désolé! vous n'êtes pas un responsable commercial pour effectuer cette opération");
            return true;
        } 

        return false;
    }
//

//stockage fichier
    function storeImage($image, $dossier)
    {
        $filename = time() . '_' . uniqid() . '.' . $image->extension();
        return $image->storeAs($dossier, $filename, 'public');
    }
//

//retrait accent ou utf8_decode
    function removeAccents($string)
    {
        return strtr(utf8_decode($string), 
            utf8_decode('ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝŸàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'),
            'AAAAAAACEEEEIIIIDNOOOOOOUUUUYYaaaaaaaceeeeiiiidnoooooouuuuyy'
        );
    }
//

//catégorie produit
    function categories()
    {
        $categories = Categorie::orderBy('nom','asc')->get();
        return $categories;
    }
    function categorieprods()
    {
        $categorieprods = Categorieprod::orderBy('nom','asc')->get();
        return $categorieprods;
    }
    function entrepotcategs()
    {
        $entrepotcategs = Entrepotcateg::orderBy('updated_at','desc')->get();
        return $entrepotcategs;
    }
    function entrepotCategorieProduitPrix(Entrepotcateg $entrepotcateg)
    {
        $totalTTC = 0;
        
        foreach($entrepotcateg->produits as $produit)
        {
            $totalTTC = $totalTTC + $produit->prix;
        }
        
        return getprice($totalTTC);
    }
//

//délai de paiement
    function delaipays()
    {
        $delaipays = Delaipay::orderBy('delaipay','asc')->get();
        return $delaipays;
    }
//

//moyen de paiement
    function moyenpays()
    {
        $moyenpays = Moyenpay::orderBy('nom','asc')->get();
        return $moyenpays;
    }
//

//formatage de prix
    function getprice($price)
    {
        // Remplace les virgules éventuelles par rien pour éviter les erreurs de conversion
        $price = str_replace(',', '', $price);
        
        // Convertir en float
        $price = floatval($price);

        // Formater en entier avec espace comme séparateur des milliers
        return number_format($price, 0, '.', ' ');
    }
    function getpricefr($price)
    {
        $price = str_replace(',', '', $price);
        $price = floatval($price);
        return number_format($price, 0, '.', ' ') . 'F';
    }
//

//formatage de date
    function formatDate($date)
    {
        // Formats que ta fonction peut accepter
        $formats = [
            'Y-m-d',
            'Y/m/d',
            'd-m-Y',
            'd/m/Y',
        ];

        foreach ($formats as $format) {
            try {
                // On essaie de parser avec chaque format
                $carbonDate = Carbon::createFromFormat($format, $date);

                // Si ça marche → on renvoie au format d/m/Y
                return $carbonDate->format('d/m/Y');
            } catch (\Exception $e) {
                // Si ça échoue, on passe au format suivant
                continue;
            }
        }

        // Si aucun format ne marche
        return "Format de date invalide";
    }
//
// //date formaté
//     function formatDate($date)
//     {
//         $date = \Carbon\Carbon::parse($date)->format('d/m/Y') ;

//         return $date;
//     }
// //

//Client et Particulier Commande Impayé
    function ClientCommandeImpaye($client)
    {
        $clientdevis = $client->clientdevis()->whereHas('clientdevisinfo')->get();

        $restePayer = 0;
        foreach($clientdevis as $clientdevis)
        {
            $restePayer += ($clientdevis->total_payer - $clientdevis->versement);
        }   

        return $restePayer;
    }    
//

//chiffre en lettre
    function toWords($number, $locale = 'fr')
    {
        if (class_exists(\NumberFormatter::class)) {
            $formatter = new \NumberFormatter($locale, \NumberFormatter::SPELLOUT);
            return $formatter->format($number);
        }

        return $number; // fallback si l’extension intl n’est pas installée
    }
//

//archive des factures
    function clientdevisarchives()
    {
        $clientdevisarchives = Clientdevis::whereHas('clientdevisinfo', function ($query) {
            $query->where('isvalide', 1);
        })->where('archive', 1)->orderBy('updated_at','desc')->get();
        // })->where('statut', 1)->where('versement','=','total_payer')->where('archive', 1)->orderBy('updated_at','desc')->get();

        return $clientdevisarchives; // fallback si l’extension intl n’est pas installée
    }
//

//montant timbre
    function MontantTimbre($total_ttc)
    {
        if($total_ttc > 5000000) {$timbre_montant = 5000;}
        elseif($total_ttc > 1000000) {$timbre_montant = 2000;}
        elseif($total_ttc > 500000) {$timbre_montant = 1000;}
        elseif($total_ttc > 100000) {$timbre_montant = 500;}
        elseif($total_ttc > 5000) {$timbre_montant = 100;}
        else {$timbre_montant = null;}

        return $timbre_montant;
    }
//

//calcul le totat des produit en commande
    function produitEnCommande(Produit $produit)
    {
        $qtyC = 0;

        foreach($produit->clientdevisprods as $clientdevisprod)
        {
            if($clientdevisprod->clientdevis->clientdevisinfo->isvalide && !$clientdevisprod->clientdevis->clientdevisinfo->livraison)
            {
                $qtyC += $clientdevisprod->quantite;
            }
        }

        return $qtyC;
    }
//

//Pack auto 
    function employes()
    {
        $employes = Employe::orderBy('updated_at','desc')->get();
        return $employes;
    }

    function categorieVehicule()
    {
        $categorievehicules = Pcategorievehicule::orderBy('nom','asc')->get();
        return $categorievehicules; 
    }
    function vehicules()
    {
        $pvehicules = Pvehicule::orderBy('updated_at','desc')->get();
        return $pvehicules;
    }
    function vehiculeDisponibles()
    {
        $pvehicules = Pvehicule::where('statut','actif')->where('ES', 1)->orderBy('updated_at','desc')->get();
        return $pvehicules;
    }
    function vehiculeEmpruntes()
    {
        $pvehicules = Pvehicule::where('statut','actif')->where('ES', 0)->orderBy('updated_at','desc')->get();
        return $pvehicules;
    }
    function vehiculeMaintenances()
    {
        $pvehicules = Pvehicule::where('statut','maintenance')->orderBy('updated_at','desc')->get();
        return $pvehicules;
    }

    
    function chauffeurs()
    {
        $chauffeurs = Pchauffeur::orderBy('updated_at','desc')->get();
        return $chauffeurs;
    }
    function chauffeurdocnames()
    {
        $chauffeurdocnames = Pchauffeurdocname::orderBy('updated_at','desc')->get();
        return $chauffeurdocnames;
    }
    function vehiculedocnames()
    {
        $vehiculedocnames = Pvehiculedocname::orderBy('updated_at','desc')->get();
        return $vehiculedocnames;
    }
//





























//client devis total à payer
    // function total_payer(Clientdevis $clientdevis)
    // {
    //     $total_payer = $clientdevis->total_payer + $clientdevis->timbre_montant + $clientdevis->frais;
    //     return getpricefr($total_payer); 
    // }
    // function total_payers(Clientdevis $clientdevis)
    // {
    //     $total_payer = $clientdevis->total_payer + $clientdevis->timbre_montant + $clientdevis->frais;
    //     return $total_payer; 
    // }
//















// //clientdevis
//     function clientdevis()
//     {
//         $clientdevis = Clientdevis::where('etat', null)->orderBy('updated_at','desc')->get();
//         return $clientdevis;
//     }
//     function clientdevisvalide()
//     {
//         $clientdevis = Clientdevis::where('etat', '1')->orderBy('updated_at','desc')->get();
//         return $clientdevis;
//     }
//     function clientdevisrefuse()
//     {
//         $clientdevis = Clientdevis::where('etat', '2')->orderBy('updated_at','desc')->get();
//         return $clientdevis;
//     }
//