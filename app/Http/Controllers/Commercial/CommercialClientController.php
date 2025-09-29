<?php

namespace App\Http\Controllers\Commercial;

use App\Models\Client;
use App\Models\Clientinfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CommercialClientController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        $clients = Client::orderBy('updated_at','desc')->get();
        return view('dashboard.commercial.client.all-client', compact('clients'));
    }

    public function create()
    {
        return view('dashboard.commercial.client.add-client');
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
            'commercial_id' => auth()->user()->id,
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

        return redirect()->route('commercial.client.index')->with('success', "$noms ajouté avec succès");
    }

    public function edit(Client $client)  
    {
        return view('dashboard.commercial.client.edit-client', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
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
        
        return redirect()->route('commercial.client.index')->with('success', "$noms modifié avec succès");
    }

    public function destroy(Client $client)
    {
        //données
            $noms = $client->nom ;
        //
        $client->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
}
