<?php

namespace App\Http\Controllers\Comptable;

use App\Models\Client;
use App\Models\Clientinfo;
use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Models\Clientdevisbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ComptableClientController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        $clients = Client::orderBy('updated_at','desc')->get();
        return view('dashboard.comptable.client.all-client', compact('clients'));
    }
    public function comptableClient()
    {
        $clients = Client::where('commercial_id', null)->orderBy('updated_at','desc')->get();
        return view('dashboard.comptable.client.all-client-comptable', compact('clients'));
    }
    public function commercialClient()
    {
        $clients = Client::where('commercial_id','!=', null)->orderBy('updated_at','desc')->get();
        return view('dashboard.comptable.client.all-client-commercial', compact('clients'));
    }


    public function create()
    {
        return view('dashboard.comptable.client.add-client');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|min:2',
            'adresse_postale' => 'nullable|min:2',
            'Pachat' => 'nullable|min:2',
            'contact' => 'required|unique:clients|min:8|max:12',
            'email' => 'nullable|email|unique:clients|min:8',
            'NCC' => 'nullable|unique:clients|min:3|max:30',
            'reference' => 'nullable|unique:clients|min:1|max:30',

            'interlocuteur' => 'nullable|min:2',
            'forme_juridique' => 'nullable|min:2',
            'numero_identifie' => 'nullable|min:2',
            'domaine' => 'nullable|min:2',
            'siege_social' => 'nullable|min:2',
            'genre' => 'nullable|min:4',
            'naissance' => 'nullable|min:8',
        ]);

        // Génération de la référence
            $nom = $request->nom;
            $nomFormater = strtoupper(substr(removeAccents($nom), 0, 3));
            $reference = "411{$nomFormater}";
        //

        $client = Client::create([
            'nom' => $request->nom,
            'email' => $request->email ,
            'contact' => $request->contact ,
            'NCC' => $request->NCC ,
            'Pachat' => $request->Pachat,
            'adresse_postale' => $request->adresse_postale,
            'TC' => $request->TC,
            'reference' => $reference,
            // 'commercial_id' => auth()->user()->id,
        ]);

        $clientinfo = Clientinfo::create([
            'genre' => $request->genre,
            'naissance' => $request->naissance,
            'interlocuteur' => $request->interlocuteur,
            'forme_juridique' => $request->forme_juridique,
            'numero_identifie' => $request->numero_identifie,
            'domaine' => $request->domaine,
            'siege_social' => $request->siege_social,
            'client_id' => $client->id,
        ]);

        //données
            $noms = $client->nom ;
        //

        return redirect()->route('comptable.client.index')->with('success', "$noms ajouté avec succès");
    }

    public function edit(Client $client)  
    {
        return view('dashboard.comptable.client.edit-client', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        // Validation
        //données
            $noms = $client->nom ;
        //

        $this->validate($request, [
            'nom' => 'required|min:2',
            'adresse_postale' => 'nullable|min:2',
            'Pachat' => 'nullable|min:2',
            'contact'   => 'required|unique:clients,contact,' . $client->id . '|min:8|max:12',
            'email'   => 'nullable|email|unique:clients,email,' . $client->id . '|min:8',
            'NCC' => 'nullable|unique:clients,NCC,' . $client->id . '|min:3|max:30',
            'reference' => 'nullable|unique:clients,reference,' . $client->id . '|min:1|max:30',
            
            'interlocuteur' => 'nullable|min:2',
            'forme_juridique' => 'nullable|min:2',
            'numero_identifie' => 'nullable|min:2',
            'domaine' => 'nullable|min:2',
            'siege_social' => 'nullable|min:2',
            'genre' => 'nullable|min:4',
            'naissance' => 'nullable|min:8',
        ]);
        
        // Génération de la référence
            $nom = $request->nom;
            $nomFormater = strtoupper(substr(removeAccents($nom), 0, 3));
            $reference = "411{$nomFormater}";
        //

        $client->update($request->post());
        $client->update([
            'reference' => $reference,
        ]);
        
        $client->clientinfo->update($request->post());
        
        return redirect()->route('comptable.client.index')->with('success', "$noms modifié avec succès");
    }

    public function destroy(Client $client)
    {
        //données
            $noms = $client->nom ;
        //
        $client->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }

    public function commandeClient(Client $client)
    {
        return view('dashboard.comptable.client.commande-client', compact('client'));
    }

    //commande client
        public function clientCommandeImpaye(Client $client)
        {
            $clientdevis = $client->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.client.commande.commande-impaye', compact('client','clientdevis'));
        }
        public function clientCommandePaye(Client $client)
        {
            $clientdevis = $client->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.client.commande.commande-paye', compact('client','clientdevis'));
        }
        public function clientCommandePartielle(Client $client)
        {
            $clientdevis = $client->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            return view('dashboard.comptable.client.commande.commande-partielle', compact('client','clientdevis'));
        }
    //

    //client devis
        public function commandeClientAddBon(Request $request, Clientdevis $clientdevis)
        {
            $request->validate([
                'fichier' => 'required|mimes:pdf,jpg,jpeg,png',
            ]);
            
            if($clientdevis->clientdevisbon) { Storage::disk('public')->delete($clientdevis->clientdevisbon->bon); }
            $bon = storeImage($request->file('fichier'), "ClientDevisBon");

            // Generate a unique filename
            // $filename = time() . '_' . uniqid() . '.' . $request->file('fichier')->extension();

            // Store the file and get its public path
            // $filePath will contain the path like 'FournisseurFactureFichier/1678888888_abcde.pdf'
            // $filePath = $request->file('fichier')->storeAs("FournisseurFactureFichier", $filename, 'public');

            // dd($request->fichier);
            // Optional: If you had a previous file and wanted to delete it
            // if ($fournisseurfacture->fichier) {
            //     Storage::disk('public')->delete($fournisseurfacture->fichier);
            // }

            // Update the 'fichier' field with the stored file's path
            Clientdevisbon::create([
                'bon' => $bon,
                'note' => null,
                'etat' => 1,
                'clientdevis_id' => $clientdevis->id,
            ]);

            return back()->with('success', "Bon associé à la commande avec succès");
        }
        public function commandeClientUpdate(Request $request, Clientdevis $clientdevis)
        {
            //données
                $noms = $clientdevis->numero_devis ;
            //
            // dd(4);commun.client.devis.update
  
            $this->validate($request, [
                'delai_livraison' => 'nullable|min:2',
                'frais' => 'nullable|min:1',

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
                // $timbreCalcul = ($clientdevis->total_ttc + $clientdevis->tva) * ($request->timbre/100); //des fois 1% 5% 3% en fonction de la tva
                // $timbreMontant = round($timbreCalcul); 
                $timbreMontant = $request->timbre_montant; 
                
                if(empty($request->airsi)) {$airsiMontant = null;}

                // $timbre = $request->timbre; //en fonction de la tva
                
                $total_payer = $clientdevis->total_payer - ($clientdevis->frais + $clientdevis->airsi_montant + $clientdevis->timbre_montant) + ($request->frais + $airsiMontant + $timbreMontant);
                // dd($clientdevis->timbre_montant , $request->timbre_montant , $total_payer);
            //

            // $clientdevis->update($request->post());
            $clientdevis->update([
                // 'tva' => $tva ,
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
    //
}
