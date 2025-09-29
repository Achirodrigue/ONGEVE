<?php

namespace App\Http\Controllers\Commun;

use Carbon\Carbon;
use App\Models\Employe;
use App\Models\Produit;
use App\Models\Produitse;
use App\Models\Clientdevis;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\Clientdevisbon;
use App\Models\Employepresence;

use Illuminate\Support\Facades\DB;
use App\Imports\ListeProduitImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Clientdevistransaction;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CommunPageController extends Controller
{
    // use ValidatesRequests;
    
    //transfert facture magasinier et location retour
        public function factureTransfertMagasinier(Clientdevis $clientdevis)
        { 
            $clientdevis->clientdevisinfo->update([
                'magasinier' => 1,
            ]);
            
            return back()->with('success', "Facture transferé avec succes au magasinier pour la livraison");
        }
        public function factureLocationLivreConfirmeRetour(Clientdevis $clientdevis)
        { 
            $clientdevis->clientdevisinfo->update([
                'livraison_retour' => 1,
            ]);
            
            return back()->with('success', "Confirmation des articles de location de la facture $clientdevis->numero_devis enregistré avec succes.");
        }
    //
    //confirme livraison
        public function factureConfirmeLivraison(Clientdevis $clientdevis)
        { 
            foreach($clientdevis->clientdevisprods() as $clientdevisprod)
            {
                $qty = $clientdevisprod->quantite;
                $qtyProduit = $clientdevisprod->produit->qtyStock - $clientdevisprod->quantite;
                
                if ($qty > $clientdevisprod->produit->qtyStock) {
                    return back()->with('success', "Désolé! Opération impossible");
                }

                //cal
                    $cal = ($qtyProduit * 25) / 100 ;
                    $SM = floor($cal);

                    $sortie = $clientdevisprod->produit->qtyStock - $qty;
                    $sortieT = $qty + $clientdevisprod->produit->produitstat->sortie;
                //

                // Mise à jour
                    $clientdevisprod->produit->update([
                        'qtyStock' => $qtyProduit,
                    ]);

                    $clientdevisprod->produit->produitstat->update([
                        'stock_min' => $SM,
                        'sortie' => $sortieT
                    ]);

                    Produitse::create([
                        'quantite' => $qty,
                        'entree_sortie' => 0,
                        'produit_id' => $clientdevisprod->produit->id,
                    ]);

                    $clientdevis->clientdevisinfo->update([
                        'livraison' => 1,
                    ]);
                //

            }
            
            return back()->with('success', "Livraison effectuer avec succes");
        }
    //

    //presence
        public function formulairePresence()
        {
            $employes = Employe::orderBy('nom','asc')->get();
            return view('dashboard.principale.presence.formulaire', compact('employes'));
        }
        public function formulairePresenceStore(Request $request)
        {
            $request->validate([
                'employe_id' => 'required|exists:employes,id',
                'email' => 'required|email',
            ]);

            // Récupérer l'employé
            $employe = Employe::findOrFail($request->employe_id);

            if ($employe->email !== $request->email) {
                return back()->with('error', 'Email incorrect pour cet employé');
            }

            // Date du jour au format Y-m-d (standard base)
            $date = Carbon::now()->format('Y-m-d');

            // Heure ajustée +1h au format HH:mm:ss
            $heureActuelle = Carbon::now()->addHour()->toTimeString();

            DB::transaction(function () use ($request, $employe, $date, $heureActuelle) {
                // Vérifier si présence existante pour l'employé aujourd'hui
                $presence = Employepresence::where('employe_id', $employe->id)
                    ->where('date', $date)
                    ->first();

                if ($presence) {
                    // Si départ déjà enregistré -> on refuse une nouvelle entrée
                    if ($presence->depart) {
                        return back()->with('error', "Présence déjà complétée pour aujourd'hui.");
                    }

                    // Enregistrer l'heure de départ
                    $presence->update(['depart' => $heureActuelle]);
                } else {
                    // Créer une nouvelle présence avec heure d'arrivée
                    Employepresence::create([
                        'employe_id' => $employe->id,
                        'date' => $date,
                        'arrive' => $heureActuelle,
                        'depart' => null,
                    ]);
                }
            });

            $presence = Employepresence::where('employe_id', $employe->id)
                ->where('date', $date)
                ->first();

            // Messages de succès selon présence
            if (isset($presence) && $presence->depart) {
                return back()->with('success', "Départ enregistré. Bonne soirée M./Mme {$employe->nom}");
            }

            return back()->with('success', "Bienvenue M./Mme {$employe->nom}, votre présence a bien été enregistré.");
        }
        // public function formulairePresenceStore(Request $request)
        // {
        //     $request->validate([
        //         'employe_id' => 'required',
        //         'email' => 'required|email',
        //     ]);

        //     $employe = Employe::findOrFail($request->employe_id)->first();

        //     if ($employe->email != $request->email) {
        //         return back()->with('error', 'Email incorrect pour cet employé');
        //     }

        //     //données
        //         $date = Carbon::now()->format('d/m/Y');
        //         $arriveOrDepart = Carbon::now()->addHour()->toTimeString();
        //     //

        //     $employeVerifyPresence = Employepresence::where('employe_id', $request->employe_id)->where('date', $date)->first();
        //     if($employeVerifyPresence)
        //     {
        //         if($employeVerifyPresence->depart)
        //         {
        //             return back()->with('error', "Présence déjà enregistrée pour aujourd'hui.");
        //         }

        //         $employeVerifyPresence->update([
        //             'depart' => $arriveOrDepart,
        //         ]);
        //     }else{
        //         $employepresence = Employepresence::firstOrNew([
        //             'date' => $date,
        //             'arrive' => $arriveOrDepart,
        //             'depart' => null,
        //             'employe_id' => $employe->id,
        //         ]);

        //         return back()->with('success', "Bienvenue M./Mme $employe->nom");
        //     }

        //     return back()->with('success', "Départ enregistré. Bonne soirée M./Mme $employe->nom");
        // }
    //

    //import excel produit
        public function importProduitExcel(Request $request)
        {
            // dd(1);
            Excel::import(new ListeProduitImport, $request->file('fichier'));

            return back()->with('success', 'Importation réussie !');
        }
    //
    
    //clientdevis 
        public function produitPrixUpdate(Request $request, Produit $produit)
        {
            if(empty($request->prix) && empty($request->qtyStock))
            {
                return back()->with('success', "Desolé! Veillez remplir l'un des deux champs du formulaire");
            }

            $this->validate($request, [
                'prix' => 'nullable|min:1',
                'qtyStock' => 'nullable|min:1',
            ]);

            $produit->update([
                'prix' => $request->prix,
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

            $noms = $produit->nom;
            return back()->with('success', "$noms : prix modifié avec succès");
        }
        public function clientDevisAddBon(Request $request, Clientdevis $clientdevis)
        {
            $request->validate([
                'fichier' => 'required|mimes:pdf,jpg,jpeg,png',
            ]);
            
            if($clientdevis->clientdevisbon) { Storage::disk('public')->delete($clientdevis->clientdevisbon->bon); }
            $bon = storeImage($request->file('fichier'), "ClientDevisBon");

            // Update the 'fichier' field with the stored file's path
            Clientdevisbon::create([
                'bon' => $bon,
                'note' => null,
                'etat' => 1,
                'clientdevis_id' => $clientdevis->id,
            ]);

            return back()->with('success', "Bon associé à la commande avec succès");
        }
        public function clientDevisUpdate(Request $request, Clientdevis $clientdevis)
        {
            //données
                $noms = $clientdevis->numero_devis ;
            //
            // dd(4);
  
            $this->validate($request, [
                'delai_livraison' => 'nullable|min:2',
                'frais' => 'nullable|min:1',

                'apptva' => 'required|in:0,1|max:1',

                'airsi' => 'nullable|min:1|max:100',
                // 'timbre' => 'nullable|min:1|max:100',
                'timbre_montant' => 'nullable|min:1',
                'date_emission' => 'nullable|min:2',
                'daterecfacture' => 'nullable|min:2',
                'delai_paiement' => 'nullable|min:2',

                'objet' => 'required|min:2',
                'chantier' => 'nullable|min:2',
                
                'fichier' => 'nullable|mimes:pdf,jpg,jpeg,png',
            ]);

            if($clientdevis->TDF != null)
            {
                $this->validate($request, [
                    'debut' => 'required',
                    'fin' => 'required',
                ]);
            }
            
            //calcul à faire
                // $numero_facture = null;
                // $total_ttc = 0;
                // $tva = 0; //18%
                // $delai_livraison = null;
                // $frais = null;

                $airsiCalcul = ($clientdevis->total_ttc + $clientdevis->tva) * ($request->airsi/100); //des fois 1% 5% 3% en fonction de la tva
                $airsiMontant = round($airsiCalcul);
                if(empty($request->airsi)) {$airsiMontant = null;}

                $timbreMontant = $request->timbre_montant; 
                
                $tva = $clientdevis->tva;
                $total_ttc = $clientdevis->total_ttc;
                if($request->apptva == 1)
                {
                    $tva = round($total_ttc * (18/100));
                }
                if($request->apptva == 0)
                {
                    $tva = null;
                }
                $timbreMontant = $clientdevis->MP == "Espèce" ? MontantTimbre($total_ttc) : null ;
                
                $total_payer = $clientdevis->total_payer - ($clientdevis->tva + $clientdevis->frais + $clientdevis->airsi_montant + $clientdevis->timbre_montant) + ($tva + $request->frais + $airsiMontant + $timbreMontant);
                // dd($clientdevis->timbre_montant , $request->timbre_montant , $total_payer);
            //

            // $clientdevis->update($request->post());
            $clientdevis->update([
                'tva' => $tva ,
                'apptva' => $request->apptva ,
                // 'total_ttc' => $total_ttc ,
                'frais' => $request->frais,
                'delai_livraison' => $request->delai_livraison,

                'total_payer' => $total_payer ,

                'airsi' => $request->airsi ,
                'airsi_montant' => $airsiMontant ,
                // 'timbre' => $request->timbre ,
                'timbre_montant' => $timbreMontant ,
                'date_emission' => $request->date_emission ,
                'daterecfacture' => $request->daterecfacture ,
                'delai_paiement' => $request->delai_paiement ,

                'objet' => $request->objet ,
                'chantier' => $request->chantier ,
            ]);

            if($clientdevis->TDF != null)
            {
                $clientdevis->clientdevisinfo->update([
                    'debut' => $request->debut,
                    'fin' => $request->fin,
                ]);
            }

            //bon de commande
                if(!empty($request->fichier))
                {
                    if($clientdevis->clientdevisbon)
                    {
                        Storage::disk('public')->delete($clientdevis->clientdevisbon->bon);
                        $bon = storeImage($request->file('fichier'), "ClientDevisBon");
                        
                        $clientdevis->clientdevisbon->update([
                            'bon' => $bon,
                        ]);
                    }
                    else
                    {
                        $bon = storeImage($request->file('fichier'), "ClientDevisBon");
                        
                        Clientdevisbon::create([
                            'bon' => $bon,
                            'note' => null,
                            'etat' => 1,
                            'clientdevis_id' => $clientdevis->id,
                        ]);
                    }
                }
            //
            
            return back()->with('success', "$noms modifié avec succès");
        }
        public function clientDevisTransactionStore(Request $request, Clientdevis $clientdevis)
        {
            $this->validate($request, [
                'reference' => 'required|min:1',
                'montant' => 'required|min:1',
                'decaissement' => 'required|min:1',
            ]);

            //données
                $noms = $clientdevis->client->nom ;
                $versement = $clientdevis->versement + $request->montant ;
                if($versement == $clientdevis->total_payer) {
                    $statut = 1;
                }else{
                    $statut = 2;
                }

                if($versement > $clientdevis->total_payer) {
                    return back()->with('error', "Desolé! le montant renseillé est superieur au reste à payer.");
                }
            //

            $clientdevistransaction = Clientdevistransaction::create([
                'reference' => $request->reference,
                'montant' => $request->montant,
                'date' => date('d/m/Y H:i'),
                'description' => null,
                'decaissement' => $request->decaissement,
                'clientdevis_id' => $clientdevis->id,
            ]);

            $clientdevis->update([
                'statut' => $statut,
                'versement' => $versement,
            ]);
                
            return redirect()->route('comptable.commande.client.versement', compact('clientdevis'))->with('success', "Nouvelle transaction ajoutée avec succès");
        }
        public function ClientdevisDestroy(Clientdevis $clientdevis)
        {
            $noms = $clientdevis->numero_devis ;
            // dd($noms);
            $clientdevis->delete();
            return back()->with('success', "$noms supprimé avec succès");
        }
    //

    //Fournisseur facture
        
    //
}
