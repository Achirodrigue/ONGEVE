<?php

namespace App\Http\Controllers\Commercial;

use App\Models\Client;
use App\Models\Produit;
use App\Models\Clientdevis;
use App\Models\Particulier;
use Illuminate\Http\Request;
use App\Models\Clientdevisprod;
use App\Models\Particulierdevis;
use App\Http\Controllers\Controller;
use App\Models\Particulierdevisprod;
use Illuminate\Support\Facades\Storage;

class CommercialDevisController extends Controller
{
    //devis client
        public function devisClientCreate()
        {
            return view('dashboard.commercial.devis.client.add-devis-client');
        }
        public function devisClientStore(Request $request)
        {
            $this->validate($request, [
                'client' => 'required|min:1',

                // 'date_expiration' => 'required|min:2',
                // 'condition_validite' => 'required|min:2',
                // 'mode_paiement' => 'required|min:2',
                'delai_livraison' => 'required|min:2',
                // 'note_condition' => 'required|min:2',
                'frais' => 'required|min:2',
            ]);
            // dd($request->client);

            //données
                $total_ttc = 0;
                $tva = 0; //18%
            //

            if($request->client === "Nouveau")
            {
                $this->validate($request, [
                    'nom' => 'required|min:2',
                    'prenom' => 'required|min:2',
                    'genre' => 'required|min:4',
                    'naissance' => 'required|min:8',
                    'adresse_postale' => 'required|min:2',
                    'contact' => 'required|unique:clients|min:8|max:12',
                    'email' => 'required|email|unique:clients|min:8',
                ]);

                $client = Client::create([
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'genre' => $request->genre,
                    'naissance' => $request->naissance,
                    'contact' => $request->contact ,
                    'email' => $request->email ,
                    'adresse_postale' => $request->adresse_postale,
                    'commercial_id' => auth()->user()->id,
                ]);
            }
            else
            {
                $client = Client::findOrfail($request->client)->first();
            }

            // Génération de la référence
            $nom = strtoupper(substr(self::removeAccents($client->nom), 0, 3));
            $prenom = strtoupper(substr(self::removeAccents($client->prenom), 0, 3));
            $lastClientdevis = Clientdevis::orderBy('id', 'desc')->first();
            $lastNumber = $lastClientdevis ? $lastClientdevis->id : 0;
            $numero_devis = "{$nom}-{$prenom}-{$lastNumber}";
            // dd($tva);
            $clientdevis = Clientdevis::create([
                'numero_devis' => $numero_devis ,
                'delai_livraison' => $request->delai_livraison,
                'tva' => $tva ,
                'total_ttc' => $total_ttc ,
                'frais' => $request->frais,
                'etat' => null ,
                'isvalide' => 1 ,
                'client_id' => $client->id ,
                'commercial_id' => auth()->user()->id,
            ]);

            $noms = "$client->nom $client->prenom" ;
                
            return redirect()->route('commercial.devis.client.create.deux', compact('clientdevis'))->with('success', "$noms : devis ajouté avec succès");
        }
        public function devisClientCreateDeux(Clientdevis $clientdevis)
        {
            return view('dashboard.commercial.devis.client.add-devis-client-deux', compact('clientdevis'));
        }
        public function devisClientStoreDeux(Request $request, Clientdevis $clientdevis, Produit $produit)
        {
            foreach($clientdevis->clientdevisprods as $clientdevisprod)
            {
                if($clientdevisprod->produit->id == $produit->id)
                {
                    // dd(1);
                    return back()->with('success', "Le produit $produit->nom à déjà été ajouté à cet devis");
                }
            }
                    // dd($clientdevis->clientdevisprods()->count(), $produit->nom);

            $this->validate($request, [
                'quantite'   => 'required|min:1',
            ]);

            //données
                $prix_total = $request->quantite * $produit->prix;
                $total_ttc = $clientdevis->total_ttc + $prix_total;
            //

            $clientdevisprod = Clientdevisprod::create([
                'quantite' => $request->quantite ,
                'unite' => "aucune",
                'prix_unitaire' => $produit->prix ,
                'prix_total' => $prix_total,
                'clientdevis_id' => $clientdevis->id,
                'produit_id' => $produit->id ,
            ]);

            $clientdevis->update([
                'total_ttc' => $total_ttc ,
            ]);

            $noms = $clientdevis->client->nom." ".$clientdevis->client->prenom;
                
            return back()->with('success', "Produit $produit->nom Ajouté au devis de $noms avec succès");
        }
        public function devisProduitPrixUpdate(Request $request, Produit $produit)
        {
            $this->validate($request, [
                'prix' => 'required|min:2',
            ]);

            $produit->update([
                'prix' => $request->prix,
            ]);

            $noms = $produit->nom;
            return back()->with('success', "$noms : prix modifié avec succès");
        }
        public function devisProduitQtyUpdate(Request $request, Clientdevisprod $clientdevisprod)
        {
            $this->validate($request, [
                'quantite'   => 'required|min:1',
            ]);

            //données
                $noms = $clientdevisprod->produit->nom;
                $prix_total = $request->quantite * $clientdevisprod->produit->prix;
                $total_ttc = $clientdevisprod->clientdevis->total_ttc + $prix_total - $clientdevisprod->prix_total;
            //

            $clientdevisprod->update([
                'quantite' => $request->quantite ,
                'prix_total' => $prix_total,
            ]);

            $clientdevisprod->clientdevis->update([
                'total_ttc' => $total_ttc ,
            ]);
                
            return back()->with('success', "Quantité du produit $noms modifié avec succès");
        }
        public function devisProduitDestroy(Clientdevisprod $clientdevisprod)
        {
            //données
                $produit = $clientdevisprod->produit->nom ;
                $total_ttc = $clientdevisprod->clientdevis->total_ttc - $clientdevisprod->prix_total;
            //
            
            $clientdevisprod->clientdevis->update([
                'total_ttc' => $total_ttc ,
            ]);

            $clientdevisprod->delete();

            return back()->with('success', "Produit $produit retiré avec succès");
        }
    //

    //devis particulier (entreprise)
        public function devisParticulierCreate()
        {
            return view('dashboard.commercial.devis.particulier.add-devis-particulier');
        }
        public function devisParticulierStore(Request $request)
        {
            $this->validate($request, [
                'client' => 'required|min:1',

                'delai_livraison' => 'required|min:2',
                'frais' => 'required|min:2',
            ]);
            // dd($request->client);

            //données
                $total_ttc = 0;
                $tva = 0; //18%
            //

            if($request->client === "Nouveau")
            {
                $this->validate($request, [
                    'nom' => 'required|min:2',
                    'forme_juridique' => 'required|min:2',
                    'numero_identifie' => 'required|min:2',
                    'domaine' => 'required|min:2',
                    'siege_social' => 'required|min:2',
                    'contact' => 'required|unique:particuliers|min:8|max:12',
                    'email' => 'required|email|unique:particuliers|min:8',
                    'adresse' => 'required|min:2',
                ]);

                $particulier = Particulier::create([
                    'nom' => $request->nom,
                    'forme_juridique' => $request->forme_juridique,
                    'numero_identifie' => $request->numero_identifie,
                    'domaine' => $request->domaine,
                    'siege_social' => $request->siege_social,
                    'contact' => $request->contact ,
                    'email' => $request->email ,
                    'adresse' => $request->adresse,
                    'commercial_id' => auth()->user()->id,
                ]);
            }
            else
            {
                $particulier = Particulier::findOrfail($request->client)->first();
            }

            // Génération de la référence
            $nom = strtoupper(substr(self::removeAccents($particulier->nom), 0, 3));
            $email = strtoupper(substr(self::removeAccents($particulier->email), 0, 3));
            $lastParticulierdevis = Particulierdevis::orderBy('id', 'desc')->first();
            $lastNumber = $lastParticulierdevis ? $lastParticulierdevis->id : 0;
            $numero_devis = "{$nom}-{$email}-{$lastNumber}";
            // dd($tva);
            $particulierdevis = Clientdevis::create([
                'numero_devis' => $numero_devis ,
                'delai_livraison' => $request->delai_livraison,
                'tva' => $tva ,
                'total_ttc' => $total_ttc ,
                'frais' => $request->frais,
                'etat' => null ,
                'isvalide' => 1 ,
                'particulier_id' => $particulier->id ,
                'commercial_id' => auth()->user()->id,
            ]);

            $noms = $particulier->nom ;
                
            return redirect()->route('commercial.devis.particulier.create.deux', compact('particulierdevis'))->with('success', "$noms : devis ajouté avec succès");
        }
        public function devisParticulierCreateDeux(Particulierdevis $particulierdevis)
        {
            return view('dashboard.commercial.devis.particulier.add-devis-particulier-deux', compact('particulierdevis'));
        }
        public function devisParticulierStoreDeux(Request $request, Particulierdevis $particulierdevis, Produit $produit)
        {
            foreach($particulierdevis->particulierdevisprods as $particulierdevisprod)
            {
                if($particulierdevisprod->produit->id == $produit->id)
                {
                    return back()->with('success', "Le produit $produit->nom à déjà été ajouté à cet devis");
                }
            }

            $this->validate($request, [
                'quantite'   => 'required|min:1',
            ]);

            //données
                $prix_total = $request->quantite * $produit->prix;
                $total_ttc = $particulierdevis->total_ttc + $prix_total;
            //

            $particulierdevisprod = Particulierdevisprod::create([
                'quantite' => $request->quantite ,
                'unite' => "aucune",
                'prix_unitaire' => $produit->prix ,
                'prix_total' => $prix_total,
                'particulierdevis_id' => $particulierdevis->id,
                'produit_id' => $produit->id ,
            ]);

            $particulierdevis->update([
                'total_ttc' => $total_ttc ,
            ]);

            $noms = $particulierdevis->particulier->nom ;
                
            return back()->with('success', "Produit $produit->nom Ajouté au devis de $noms avec succès");
        }
        public function devisParticulierProduitQtyUpdate(Request $request, Particulierdevisprod $particulierdevisprod)
        {
            $this->validate($request, [
                'quantite'   => 'required|min:1',
            ]);

            //données
                $noms = $particulierdevisprod->produit->nom;
                $prix_total = $request->quantite * $particulierdevisprod->produit->prix;
                $total_ttc = $particulierdevisprod->particulierdevis->total_ttc + $prix_total - $particulierdevisprod->prix_total;
            //

            $particulierdevisprod->update([
                'quantite' => $request->quantite ,
                'prix_total' => $prix_total,
            ]);

            $particulierdevisprod->particulierdevis->update([
                'total_ttc' => $total_ttc ,
            ]);
                
            return back()->with('success', "Quantité du produit $noms modifié avec succès");
        }
        public function devisParticulierProduitDestroy(Particulierdevisprod $particulierdevisprod)
        {
            //données
                $produit = $particulierdevisprod->produit->nom ;
                $total_ttc = $particulierdevisprod->particulierdevis->total_ttc - $particulierdevisprod->prix_total;
            //
            
            $particulierdevisprod->particulierdevis->update([
                'total_ttc' => $total_ttc ,
            ]);

            $particulierdevisprod->delete();

            return back()->with('success', "Produit $produit retiré avec succès");
        }
    //

    //historique
        //client
            public function devisClientEncours()
            {
                $clientdevis = Clientdevis::where('isvalide', 0)->orderBy('updated_at','desc')->get();
                return view('dashboard.commercial.devis.historique.client.devis-encours', compact('clientdevis'));
            }
            public function devisClientFinalite(Clientdevis $clientdevis)
            {
                return view('dashboard.commercial.devis.historique.client.devis-detail', compact(('clientdevis')));
            }
            public function devisClientUpdate(Request $request, Clientdevis $clientdevis)
            {
                $this->validate($request, [
                    'delai_livraison' => 'required|min:2',
                    'frais' => 'required|min:2',
                ]);

                $clientdevis->update([
                    'delai_livraison' => $request->delai_livraison,
                    'frais' => $request->frais,
                ]);

                $noms = $clientdevis->client->nom." ".$clientdevis->client->prenom;
                    
                return back()->with('success', "$noms : devis modifié avec succès");
            }
            public function devisClientDestroy(Clientdevis $clientdevis)
            {
                $noms = $clientdevis->client->nom." ".$clientdevis->client->prenom;
                $clientdevis->delete();
                return back()->with('success', "$noms : devis supprimé avec succès");
            }
            public function devisClientConvertirUpdate(Request $request, Clientdevis $clientdevis)
            {
                $clientdevis->update([
                    'isvalide' => !$clientdevis->isvalide,
                ]);

                $noms = $clientdevis->client->nom." ".$clientdevis->client->prenom;

                $message = "Devis retiré des commandes avec succes" ;
                if($clientdevis->isvalide)
                {
                    $message = "Devis converti en commande avec succes" ;
                }
                return back()->with('success', "$noms : $message");
            }
        //

        //particulier
            public function devisPartenaireEncours()
            {
                $particulierdevis = Particulierdevis::where('isvalide', null)->orderBy('updated_at','desc')->get();
                return view('dashboard.commercial.devis.historique.particulier.devis-encours', compact('particulierdevis'));
            }
            public function devisParticulierFinalite(Particulierdevis $clientdevis)
            {
                return view('dashboard.commercial.devis.historique.particulier.devis-detail', compact(('particulierdevis')));
            }
            public function devisPartenaireUpdate(Request $request, Particulierdevis $particulierdevis)
            {
                $this->validate($request, [
                    'delai_livraison' => 'required|min:2',
                    'frais' => 'required|min:2',
                ]);

                $particulierdevis->update([
                    'delai_livraison' => $request->delai_livraison,
                    'frais' => $request->frais,
                ]);

                $noms = $particulierdevis->particulier->nom ;
                    
                return back()->with('success', "$noms : devis modifié avec succès");
            }
            public function devisParticulierDestroy(Particulierdevis $particulierdevis)
            {
                $noms = $particulierdevis->particulier->nom ;
                $particulierdevis->delete();
                return back()->with('success', "$noms : devis supprimé avec succès");
            }
            public function devisParticulierConvertirUpdate(Request $request, Particulierdevis $particulierdevis)
            {
                $particulierdevis->update([
                    'isvalide' => !$particulierdevis->isvalide,
                ]);

                $noms = $particulierdevis->particulier->nom ;

                $message = "Devis retiré des commandes avec succes" ;
                if($particulierdevis->isvalide)
                {
                    $message = "Devis converti en commande avec succes" ;
                }
                return back()->with('success', "$noms : $message");
            }
        //
    //



































    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientdevis = Clientdevis::where('etat', null)->orderBy('nom','asc')->get();
        return view('dashboard.commercial.demande-devis.all-devis-encours', compact('clientdevis'));
    }
    public function devisValide()
    {
        $clientdevis = Clientdevis::where('etat', 1)->orderBy('nom','asc')->get();
        return view('dashboard.commercial.demande-devis.all-devis-valide', compact('clientdevis'));
    }
    public function devisRefuse()
    {
        $clientdevis = Clientdevis::where('etat', 2)->orderBy('nom','asc')->get();
        return view('dashboard.commercial.demande-devis.all-devis-refuse', compact('clientdevis'));
    }
    public function devisProduit(Clientdevis $clientdevis)
    {
        return view('dashboard.commercial.demande-devis.devis-produit', compact('clientdevis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // Fonction pour supprimer les accents
        public static function removeAccents($string)
        {
            return strtr(utf8_decode($string), 
                utf8_decode('ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝŸàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'),
                'AAAAAAACEEEEIIIIDNOOOOOOUUUUYYaaaaaaaceeeeiiiidnoooooouuuuyy'
            );
        }
    //
    public function create()
    {
        return view('dashboard.commercial.demande-devis.add-devis');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'client' => 'required|min:1',

            'date_expiration' => 'required|min:2',
            'condition_validite' => 'required|min:2',
            'mode_paiement' => 'required|min:2',
            'delai_livraison' => 'required|min:2',
            // 'note_condition' => 'required|min:2',
            'frais' => 'required|min:2',
        ]);

        //données
            $total_ttc = 0;
        //

        if($request->client === "Nouveau")
        {
            $this->validate($request, [
                'nom' => 'required|min:2',
                'prenom' => 'required|min:4',
                'contact' => 'required|unique:clients|min:8|max:12',
                'email' => 'required|email|unique:clients|min:8',
            ]);
            
            //données
                $identifiant = $request->contact;
            //

            $client = Client::create([
                'nom' => $request->nom ,
                'prenom' => $request->prenom ,
                'contact' => $request->contact ,
                'email' => $request->email ,
                'isvalide' => 1,
                'identifiant' => $identifiant,
            ]);
        }
        else
        {
            $client = Client::findOrfail($request->client)->first();
        }

        // Génération de la référence
        $prenom = $request->prenom;
        $nom = strtoupper(substr(self::removeAccents($request->nom), 0, 3));
        $prenom = strtoupper(substr(self::removeAccents($request->prenom), 0, 3));
        $lastClientdevis = Clientdevis::orderBy('id', 'desc')->first();
        $lastNumber = $lastClientdevis ? $lastClientdevis->id : 0;
        $numero_devis = "{$nom}-{$prenom}-{$lastNumber}";

        $clientdevis = Clientdevis::create([
            'numero_devis' => $numero_devis ,
            'date_expiration' => $request->date_expiration ,
            'condition_validite' => $request->condition_validite ,
            'mode_paiement' => $request->mode_paiement ,
            'delai_livraison' => $request->delai_livraison,
            'note_condition' => $request->note_condition,
            'total_ttc' => $total_ttc ,
            'frais' => $request->frais,
            'etat' => null ,
            'isvalide' => 1 ,
            'client_id' => $client->id ,
        ]);

        $noms = "$client->nom $client->prenom" ;
            
        return redirect()->route('commercial.devis.create.deux', compact(('clientdevis')))->with('success', "$noms : devis ajouté avec succès");
    }
    public function devisCreateDeux(Clientdevis $clientdevis)
    {
        return view('dashboard.commercial.demande-devis.add-devis-deux', compact('clientdevis'));
    }
    public function devisStoreDeux(Request $request, Clientdevis $clientdevis, Produit $produit)
    {
        foreach($clientdevis->clientdevisprods as $clientdevisprod)
        {
            if($clientdevisprod->produit->id == $produit->id)
            {
                // dd(1);
                return back()->with('success', "Le produit $produit->nom à déjà été ajouté à cet devis");
            }
        }
                // dd($clientdevis->clientdevisprods()->count(), $produit->nom);

        $this->validate($request, [
            'quantite'   => 'required|min:1',
        ]);

        //données
            $prix_total = $request->quantite * $produit->prix;
            $total_ttc = $clientdevis->total_ttc + $prix_total;
        //

        $clientdevisprod = Clientdevisprod::create([
            'quantite' => $request->quantite ,
            'unite' => "aucune",
            'prix_unitaire' => $produit->prix ,
            'prix_total' => $prix_total,
            'clientdevis_id' => $clientdevis->id,
            'produit_id' => $produit->id ,
        ]);

        $clientdevis->update([
            'total_ttc' => $total_ttc ,
        ]);

        $noms = $clientdevis->client->nom." ".$clientdevis->client->prenom;
            
        return back()->with('success', "Produit $produit->nom Ajouté au devis de $noms avec succès");
    }

    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clientdevis $clientdevis)     //(string $id)
    {
        return view('dashboard.commercial.demande-devis.edit-devis', compact('clientdevis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clientdevis $clientdevis)
    {
        //donnée
            $noms = "$formateur->nom $formateur->prenom" ;
            $photo = $formateur->photo;
        //
        
        $this->validate($request, [
            'contact'   => 'required|unique:formateurs,contact,' . $formateur->id . '|min:8|max:12',
            'email'   => 'required|email|unique:formateurs,email,' . $formateur->id . '|min:8',
            'nom'   => 'required|min:3',
            'prenom'   => 'required|min:4',
            'adresse'   => 'required|min:4',
            'domaine'   => 'required|min:4',
        ]);

        if (!empty($request->photo))
        {
            $this->validate($request, [
                'photo' => 'required|mimes:png,jpg,jpeg',
            ]);
            
            if($formateur->photo){Storage::disk('public')->delete($formateur->photo);}
            $filename = time() . '.' . $request->photo->extension();
            $photo = $request->file('photo')->storeAs(
                'FormateurPhoto',
                $filename,
                'public'
            );
        }

        $formateur->update([
            'photo' => $photo
        ]);

        $formateur->update($request->post());

        return redirect()->route('commercial.formateur.index')->with('success', "$noms modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clientdevis $clientdevis)
    {
        //donnée
            $noms = $clientdevis->client->nom." ".$clientdevis->client->prenom ;
        //

        $formateurFormation = $formateur->formationformateurs()->count();

        if($formateurFormation > 0)
        {
            return back()->with('error','Désolé! Ce formateur possède des formations en cours donc impossible de le supprimer.');
        }
        else
        {
            if (!empty($formateur->photo))
            {
                Storage::disk('public')->delete($formateur->photo);
            }
            $formateur->delete();
            return back()->with('success', "$noms supprimé avec succès");
        }
    }
}
