<?php

namespace App\Http\Controllers\Comptable;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Projet;
use App\Models\Moyenpay;
use App\Models\Clientdevis;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Client\ClientdevisExport;
use App\Models\Fournisseurfacturecomptable;
use App\Exports\Client\ClientdevisGeneralExport;
use App\Exports\Client\ClientdevisGeneralCAExport;

use App\Exports\Client\ClientdevisIndividuelExport;
use App\Exports\Fournisseur\FournisseurFactureExport;

use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Exports\Fournisseur\FournisseurFactureGeneralExport;
use App\Exports\Fournisseur\FournisseurFactureIndividuelExport;

class ComptablePageController extends Controller
{
    use ValidatesRequests;

    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('comptable.login'));
    }
    
    public function home()
    {
        // dd(null + null);
        //depense
            $depenses = Client::orderBy('updated_at','desc')->get();
            $depensesM = 0 ;
            foreach($depenses as $depense)
            {
                $depensesM += $depense->montant ;
            }
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

        return  view('dashboard.comptable.home', 
                compact('clients','fournisseurs','clientdevis','clientdevisM','fournisseurfacturecomptables','fournisseurfacturecomptablesM','depenses','depensesM'));
    }

    //projet   
        public function projet()
        { 
            $projets = Projet::orderBy('updated_at','desc')->get();
            return  view('dashboard.comptable.projet.projet', compact('projets'));
        }
        public function projetTache(Projet $projet)
        { 
            return  view('dashboard.comptable.projet.projet-tache', compact('projet'));
        }
    //

    //client rappel vente 
        public function clientRappelVente15Jours()
        {
            $clients = Client::whereDoesntHave('clientdevis', function ($query) {
                $query->where('created_at', '>=', Carbon::now()->subDays(15));
            })->get();

            return  view('dashboard.comptable.rappel-client.rappel-15-jours', compact('clients'));
        }
        public function clientRappelVente1Mois()
        {
            $clients = Client::whereDoesntHave('clientdevis', function ($query) {
                $query->where('created_at', '>=', Carbon::now()->subMonth());
            })->get();

            return  view('dashboard.comptable.rappel-client.rappel-1-mois', compact('clients'));
        }
        public function clientsRappelParPeriode($periode = '1m')
        {
            $now = Carbon::now();

            // 🔹 Définition de la date de début selon la période
            switch ($periode) {
                case '1s': // 1 semaine
                    $dateDebut = $now->subWeek()->startOfDay();
                    $titre = '1 semaine';
                    break;

                case '1m': // 1 mois
                    $dateDebut = $now->subMonth()->startOfDay();
                    $titre = '1 mois';
                    break;

                case '3m': // 3 mois
                    $dateDebut = $now->subMonths(3)->startOfDay();
                    $titre = '3 mois';
                    break;

                case '6m': // 6 mois
                    $dateDebut = $now->subMonths(6)->startOfDay();
                    $titre = '6 mois';
                    break;

                default:
                    abort(404, "Période invalide !");
            }

            // 🔹 Clients n’ayant pas de devis depuis la date définie
            $clients = Client::whereDoesntHave('clientdevis', function ($query) use ($dateDebut) {
                $query->where('created_at', '>=', $dateDebut);
            })->get();

            return view('dashboard.comptable.rappel-client.rappel', compact('clients', 'titre', 'periode'));
        }
    //

    //excel
        //client
            public function clientFactureExport()
            {
                $fileName = 'utilisateurs.xlsx';
                return Excel::download(new ClientdevisExport, $fileName);

                /*
                    $fileName = 'facture-client-' . now()->format('Y-m-d_H-i-s') . '.xlsx';

                    // Enregistrer le fichier dans storage/app/public/factures/
                    Excel::store(new ClientdevisExport, 'public/factures/' . $fileName);

                    // Générer l'URL publique vers le fichier
                    $url = Storage::url('factures/' . $fileName);

                    // Rediriger l’utilisateur vers ce lien (le navigateur proposera l’ouverture)
                    return redirect($url);
                */
            }
            public function clientFactureIndividuelExport(Client $client, $statut)
            {
                if($statut == 0) {$titre = "Impayé";} elseif($statut == 1) {$titre = "Finalisé";} else {$titre = "Partiellement_Payé";}

                $fileName = 'Facture_Client_'.$client->nom.'_'.$titre.'.xlsx';
                return Excel::download(new ClientdevisIndividuelExport($client, $statut), $fileName);
            }
            public function clientFactureGeneralExport($statut)
            {
                if($statut == 0) {$titre = "Impayé";} elseif($statut == 1) {$titre = "Finalisé";} else {$titre = "Partiellement_Payé";}
                $fileName = 'Facture_Clients_'.$titre.'.xlsx';
                return Excel::download(new ClientdevisGeneralExport($statut), $fileName);
            }
            public function clientFactureGeneralCAExport($statut)
            {
                if($statut == 0) {$titre = "Impayé";} elseif($statut == 1) {$titre = "Finalisé";} else {$titre = "Partiellement_Payé";}
                $fileName = 'Chiffre_Affaire_Facture_Clients_'.$titre.'.xlsx';
                return Excel::download(new ClientdevisGeneralCAExport($statut), $fileName);
            }
        //
        //fournisseur
            public function fournisseurFactureExport()
            {
                $fileName = 'utilisateurs.xlsx';
                return Excel::download(new FournisseurFactureExport, $fileName);
            }
            public function fournisseurFactureIndividuelExport(Fournisseur $fournisseur, $statut)
            {
                // dd($statut);
                if($statut == 0) {$titre = "Impayé";} elseif($statut == 1) {$titre = "Finalisé";} else {$titre = "Partiellement_Payé";}
                $fileName = 'Facture_Fournisseur_'.$fournisseur->nom.'_'.$titre.'.xlsx';
                return Excel::download(new FournisseurFactureIndividuelExport($fournisseur, $statut), $fileName);
            }
            public function fournisseurFactureGeneralExport($statut)
            {
                if($statut == 0) {$titre = "Impayé";} elseif($statut == 1) {$titre = "Finalisé";} else {$titre = "Partiellement_Payé";}
                $fileName = 'Facture_Fournisseur_'.$titre.'.xlsx';
                return Excel::download(new FournisseurFactureGeneralExport($statut), $fileName);
            }
        //
        // //param
        //     public function fournisseurFactureExports(Fournisseur $fournisseur)
        //     {
        //         $fileName = 'utilisateurs_'.$id.'.xlsx';
        //         return Excel::download(new FournisseurFactureExport($fournisseur), $fileName);
        //     }
        // //
    //

    //fournisseur facture add produit
        public function fournisseurFactureAddProduit(Fournisseurfacturecomptable $fournisseurfacturecomptable)
        {
            return view('dashboard.comptable.fournisseur.add-produit-facture', compact('fournisseurfacturecomptable'));
        }
    //

    //archive
        public function allArchiveFacture() 
        {
            $clientdevis = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                $query->where('isvalide', 1);
            })->where('archive', 1)->orderBy('updated_at','desc')->get();

            return view('dashboard.comptable.archive-facture.all-archive', compact('clientdevis'));
        }
    //

    //frais detail
        public function clientDevisFraisDetail(Clientdevis $clientdevis) 
        {
            $clientdevisfraisdetails = $clientdevis->clientdevisfraisdetails()->orderBy('updated_at','desc')->get();

            return view('dashboard.comptable.commande.commande-frais-detail', compact('clientdevis','clientdevisfraisdetails'));
        }
    //

    //reglage
        public function MoyenPaiement()
        {
            $moyenpays = Moyenpay::orderBy('updated_at','desc')->get();
            return  view('dashboard.comptable.reglage.moyen-paiement', compact('moyenpays'));
        }
    //


















    //Recette
        public function suiviRecette() 
        {
            return view('dashboard.comptable.recette.recette');
        }
    //

    //Exports et éditions
        public function exportComptable()
        {
            return view('dashboard.comptable.export-edition.export-comptable');
        }
        public function filtrageDonnee()
        {
            return view('dashboard.comptable.export-edition.filtrage-donnee');
        }
        public function journauxComptable()
        {
            return view('dashboard.comptable.export-edition.journaux-comptable');
        }
    //

    //Intégration avec un cabinet comptable
        public function fichierComptable()
        {
            return view('dashboard.comptable.cabinet-comptable.fichier-comptable');
        }
        public function exportFichier()
        {
            return view('dashboard.comptable.cabinet-comptable.export-fichier');
        }
    //
}
