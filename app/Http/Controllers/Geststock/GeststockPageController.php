<?php

namespace App\Http\Controllers\Geststock;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Projet;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Produitse;
use App\Models\Clientdevis;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Fournisseurfacturecomptable;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;

class GeststockPageController extends Controller
{
    use ValidatesRequests;

    public function logout(Request $request) {
        // dd(5);
        Auth::logout();
        return redirect(route('geststock.login'));
    }
    
    public function home()
    {
        //categorie et produit
            $categories = Categorie::orderBy('updated_at','desc')->get();
            $produits = Produit::orderBy('updated_at','desc')->get();
        //
        //client
            $clients = Client::orderBy('updated_at','desc')->get();
        //
        //facture client
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->orderBy('updated_at','desc')->get();
            $clientdevisM = 0 ;
            foreach($clientdevis as $clientdevis)
            {
                $clientdevisM += $clientdevis->total_payer ;
            }
        //
        //fournisseur
            $fournisseurs = Fournisseur::orderBy('updated_at','desc')->get();
        //
        //facture fournisseur
            $fournisseurfacturecomptables = Fournisseurfacturecomptable::orderBy('updated_at','desc')->get();
            $fournisseurfacturecomptablesM = 0 ;
            foreach($fournisseurfacturecomptables as $fournisseurfacturecomptable)
            {
                $fournisseurfacturecomptablesM += $fournisseurfacturecomptable->total_payer ;
            }
        //

        return  view('dashboard.geststock.home', 
                compact('produits','categories','clients','fournisseurs','clientdevis',
                        'clientdevisM','fournisseurfacturecomptables','fournisseurfacturecomptablesM'));
    }

    //projet   
        public function projet()
        { 
            $projets = Projet::orderBy('updated_at','desc')->get();
            return  view('dashboard.geststock.projet.projet', compact('projets'));
        }
        public function projetTache(Projet $projet)
        { 
            return  view('dashboard.geststock.projet.projet-tache', compact('projet'));
        }
    //

    //fournisseur facture comptable
        //Fournisseur facture add produit et detail
            public function fournisseurFactureAddProduit(Fournisseurfacturecomptable $fournisseurfacturecomptable)
            {
                return view('dashboard.geststock.fournisseur.facture.add-produit-facture', compact('fournisseurfacturecomptable'));
            }
            public function factureFournisseurDetail(Fournisseurfacturecomptable $fournisseurfacturecomptable)
            {
                return view('dashboard.geststock.fournisseur.facture.facture-detail', compact('fournisseurfacturecomptable'));
            }
        //
        //fournisseur facture emise et receptionné
            //fournisseur
                public function factureFournisseurReceptionEncours(Fournisseur $fournisseur)
                {
                    $fournisseurfacturecomptables = $fournisseur->fournisseurfacturecomptables()->orderBy('updated_at','desc')->get();
                    return view('dashboard.geststock.fournisseur.facture.fournisseur.encours', compact('fournisseurfacturecomptables','fournisseur'));
                }
                public function factureFournisseurReceptionValide(Fournisseur $fournisseur)
                {
                    $fournisseurfacturecomptables = $fournisseur->fournisseurfacturecomptables()->orderBy('updated_at','desc')->get();
                    return view('dashboard.geststock.fournisseur.facture.fournisseur.valide', compact('fournisseurfacturecomptables','fournisseur'));
                }
            //
            //generale
                public function generaleFactureFournisseurReceptionEncours()
                {
                    $fournisseurfacturecomptables = Fournisseurfacturecomptable::orderBy('updated_at','desc')->get();
                    return view('dashboard.geststock.fournisseur.facture.generale.encours', compact('fournisseurfacturecomptables'));
                }
                public function generaleFactureFournisseurReceptionValide()
                {
                    $fournisseurfacturecomptables = Fournisseurfacturecomptable::orderBy('updated_at','desc')->get();
                    return view('dashboard.geststock.fournisseur.facture.generale.valide', compact('fournisseurfacturecomptables'));
                }
            //
        //
    //

    //confirme livraison   
        public function factureEmise()
        { 
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1)->where('magasinier', 0)->where('livraison', 0);
                })->orderBy('updated_at','desc')->get();
            return  view('dashboard.geststock.facture-client.emise', compact('clientdevis'));
        }
        public function factureEncoursLivraison()
        { 
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1)->where('magasinier', 1)->where('livraison', 0);
                })->orderBy('updated_at','desc')->get();
            return  view('dashboard.geststock.facture-client.encours-livraison', compact('clientdevis'));
        } 
        public function factureLivre()
        { 
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1)->where('magasinier', 1)->where('livraison', 1);
                })->orderBy('updated_at','desc')->get();
            return  view('dashboard.geststock.facture-client.livre', compact('clientdevis'));
        }
        public function factureClientDetail(Clientdevis $clientdevis)
        {
            return view('dashboard.geststock.facture-client.commande-detail', compact('clientdevis'));
        }
    //

    //facture location livrés
        public function factureLocationLivreSansRetour()
        { 
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1)->where('livraison', 1)->where('livraison_retour', 0);
                })->where('TD', 1)->orderBy('updated_at','desc')->get();
            return  view('dashboard.geststock.facture-client.location.livre-sans-retour', compact('clientdevis'));
        }
        public function factureLocationLivreAvecRetour()
        { 
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1)->where('livraison', 1)->where('livraison_retour', 1);
                })->where('TD', 1)->orderBy('updated_at','desc')->get();
            return  view('dashboard.geststock.facture-client.location.livre-avec-retour', compact('clientdevis'));
        }
    // 
      
    //Bilans comptables automatisés
        public function bilanFactureFiltrer(Request $request)
        {
            // Validation
                $request->validate([
                    'PouSP' => 'required|in:P,SP',
                    'TB' => 'required|in:BC,BL,BS,BE,FT',
                    'TF' => 'required|in:all,vente,location,prestation',
                ]);

                //données
                    $startDate = null ;
                    $endDate   = null ;
                    $type      = $request->input('TF');
                    $TB      = $request->input('TB');
                //

                if($request->PouSP == "P")
                {
                    $request->validate([
                        'start_date' => 'required|date',
                        'end_date'   => 'nullable|date|after_or_equal:start_date',
                    ], [
                        'end_date.after_or_equal' => 'La date de fin doit être supérieure ou égale à la date de début.',
                    ]);

                    //données
                        $startDate = $request->input('start_date');
                        $endDate   = $request->input('end_date');
                    //
                }
            //

            //Periode ou San Periode
                $query = Clientdevis::query();
                if($request->PouSP == "P")
                {
                    // Cas 1 : Une seule date (factures de ce jour)
                        if ($startDate && !$endDate) {
                            $date = Carbon::parse($startDate);
                            $query->whereDate('created_at', $date);
                        }
                    //

                    // Cas 2 : Deux dates (factures entre start et end)
                        if ($startDate && $endDate) {
                            $start = Carbon::parse($startDate)->startOfDay();
                            $end   = Carbon::parse($endDate)->endOfDay();
                            $query->whereBetween('created_at', [$start, $end]);
                        }
                    //
                }
            //

            // ✅ Filtrer par type
                if ($type !== 'all') {
                    if ($type === 'vente') {
                        $query->whereNull('TDF');   // Vente => TD = null
                    } elseif ($type === 'location') {
                        $query->where('TDF', 1);    // Location => TD = 1
                    } elseif ($type === 'prestation') {
                        $query->where('TDF', 2);    // Prestation => TD = 2
                    }
                }
            //

            $factures = $query->orderBy('created_at', 'asc')->get();

            return view('dashboard.geststock.bilan.bilan-periode-final', [
                'clientdevis' => $factures,
                'startDate' => $startDate,
                'endDate'   => $endDate,
                'type'      => $type,
                'TB'      => $TB,
            ]);
        }
    //
    //classement Produit Vendu par periode
        public function classementProduitVendu(Request $request)
        {
            //   PouSPprod
            //   start_date
            //   end_date
            //   TS

            // 1. Validation des entrées
                $request->validate([
                    'PouSPprod' => 'required|in:P,SP', // Période ou Sans Période
                    'TS'    => 'required|in:all,vente,location', // Type
                ]);

                //Variables
                    $startDate = null ;
                    $endDate   = null ;
                    $TS      = $request->input('TS');
                //

                if($request->PouSPprod == "P")
                {
                    $request->validate([
                        'start_date' => 'required|date',
                        'end_date'   => 'nullable|date|after_or_equal:start_date',
                    ], [
                        'end_date.after_or_equal' => 'La date de fin doit être supérieure ou égale à la date de début.',
                    ]);

                    //Variables
                        $startDate = $request->input('start_date');
                        $endDate   = $request->input('end_date');
                    //
                }
            //

            // 2. Construction de la requête
                $query = DB::table('produitvendus')
                    ->join('produits', 'produits.id', '=', 'produitvendus.produit_id')
                    ->select(
                        'produits.id',
                        'produits.nom',
                        'produits.reference',
                        'produits.prix',
                        DB::raw('SUM(produitvendus.quantite) as total_vendu')
                    )
                    ->groupBy('produits.id', 'produits.nom', 'produits.reference', 'produits.prix');
            //

            // 3. Filtrer par période
                if ($request->PouSPprod == "P") {
                    // Cas 1 : une seule date
                    if ($startDate && !$endDate) {
                        $date = Carbon::parse($startDate);
                        $query->whereDate('produitvendus.created_at', $date);
                    }

                    // Cas 2 : deux dates
                    if ($startDate && $endDate) {
                        $start = Carbon::parse($startDate)->startOfDay();
                        $end   = Carbon::parse($endDate)->endOfDay();
                        $query->whereBetween('produitvendus.created_at', [$start, $end]);
                    }
                }
            //

            // 4. Filtrer par type (vente ou location)
                if ($TS === 'vente') {
                    $query->where('produits.reference', 'LIKE', 'V%');
                } elseif ($TS === 'location') {
                    $query->where('produits.reference', 'LIKE', 'P%');
                }
            //

            // 5. Exécuter la requête
                $produits = $query->orderByDesc('total_vendu')->get();
            //

            // 6. Retourner la vue
                return view('dashboard.geststock.produit.classement.bilan-periode-produit', [
                    'produits' => $produits,
                    'startDate' => $startDate,
                    'endDate'   => $endDate,
                    'TS'      => $TS,
                ]);
            //
        }

        // public function classementProduitVendu(Request $request)
        // {
        //     // Validation
        //         $request->validate([
        //             'PouSP' => 'required|in:P,SP',
        //             'TB' => 'required|in:BC,BL,BS,BE,FT',
        //             'TF' => 'required|in:all,vente,location,prestation',
        //         ]);

        //         //données
        //             $startDate = null ;
        //             $endDate   = null ;
        //             $type      = $request->input('TF');
        //             $TB      = $request->input('TB');
        //         //

        //         if($request->PouSP == "P")
        //         {
        //             $request->validate([
        //                 'start_date' => 'required|date',
        //                 'end_date'   => 'nullable|date|after_or_equal:start_date',
        //             ], [
        //                 'end_date.after_or_equal' => 'La date de fin doit être supérieure ou égale à la date de début.',
        //             ]);

        //             //données
        //                 $startDate = $request->input('start_date');
        //                 $endDate   = $request->input('end_date');
        //             //
        //         }
        //     //

        //     //Periode ou San Periode
        //         $query = Clientdevis::query();
        //         if($request->PouSP == "P")
        //         {
        //             // Cas 1 : Une seule date (factures de ce jour)
        //                 if ($startDate && !$endDate) {
        //                     $date = Carbon::parse($startDate);
        //                     $query->whereDate('created_at', $date);
        //                 }
        //             //

        //             // Cas 2 : Deux dates (factures entre start et end)
        //                 if ($startDate && $endDate) {
        //                     $start = Carbon::parse($startDate)->startOfDay();
        //                     $end   = Carbon::parse($endDate)->endOfDay();
        //                     $query->whereBetween('created_at', [$start, $end]);
        //                 }
        //             //
        //         }
        //     //

        //     // ✅ Filtrer par type
        //         if ($type !== 'all') {
        //             if ($type === 'vente') {
        //                 $query->whereNull('TDF');   // Vente => TD = null
        //             } elseif ($type === 'location') {
        //                 $query->where('TDF', 1);    // Location => TD = 1
        //             } elseif ($type === 'prestation') {
        //                 $query->where('TDF', 2);    // Prestation => TD = 2
        //             }
        //         }
        //     //

        //     $factures = $query->orderBy('created_at', 'asc')->get();

        //     return view('dashboard.geststock.bilan.bilan-periode-final', [
        //         'clientdevis' => $factures,
        //         'startDate' => $startDate,
        //         'endDate'   => $endDate,
        //         'type'      => $type,
        //         'TB'      => $TB,
        //     ]);
        // }
        // public function produitsPlusVendus(Request $request)
        // {
        //     $request->validate([
        //         'start_date' => 'required|date',
        //         'end_date'   => 'nullable|date|after_or_equal:start_date',
        //     ], [
        //         'end_date.after_or_equal' => 'La date de fin doit être supérieure ou égale à la date de début.',
        //     ]);

            
        //     //   PouSPprod
        //     //   start_date
        //     //   end_date
        //     //   TS

        //     // Récupérer les dates du formulaire
        //     $debut = $request->input('start_date');
        //     $fin = $request->input('end_date');

        //     $produits = DB::table('produitvendus')
        //         ->join('produits', 'produits.id', '=', 'produitvendus.produit_id')
        //         ->select(
        //             'produits.nom',
        //             DB::raw('SUM(produitvendus.quantite) as total_vendu')
        //         )
        //         ->when($debut && $fin, function ($query) use ($debut, $fin) {
        //             return $query->whereBetween('produitvendus.created_at', [$debut, $fin]);
        //         })
        //         ->groupBy('produits.id', 'produits.nom')
        //         ->orderByDesc('total_vendu')
        //         ->get();

        //     return view('dashboard.geststock.produit.classement.bilan-periode-final', compact('produits', 'debut', 'fin'));
        // }
        // public function produitsPlusVendus(Request $request)
        // {
        //     // Récupérer les dates du formulaire
        //     $debut = $request->input('date_debut');
        //     $fin = $request->input('date_fin');
        //     $type = $request->input('type'); // "vente" ou "location"

        //     $produits = DB::table('produitvendus')
        //         ->join('produits', 'produits.id', '=', 'produitvendus.produit_id')
        //         ->select(
        //             'produits.nom',
        //             DB::raw('SUM(produitvendus.quantite) as total_vendu')
        //         )
        //         // filtre par date
        //         ->when($debut && $fin, function ($query) use ($debut, $fin) {
        //             return $query->whereBetween('produitvendus.created_at', [$debut, $fin]);
        //         })
        //         // filtre par type (vente ou location)
        //         ->when($type === 'vente', function ($query) {
        //             return $query->where('produits.reference', 'LIKE', 'V%');
        //         })
        //         ->when($type === 'location', function ($query) {
        //             return $query->where('produits.reference', 'LIKE', 'P%');
        //         })
        //         ->groupBy('produits.id', 'produits.nom')
        //         ->orderByDesc('total_vendu')
        //         ->get();

        //     return view('rapport.produits_plus_vendus', compact('produits', 'debut', 'fin', 'type'));
        // }

    //
}