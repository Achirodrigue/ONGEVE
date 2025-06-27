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
            'adresse_postale' => 'required|min:2',
            'Pachat' => 'required|min:2',
            'contact' => 'required|unique:clients|min:8|max:12',
            'email' => 'required|email|unique:clients|min:8',
        ]);
        
        $client = Client::create([
            'nom' => $request->nom,
            'email' => $request->email ,
            'contact' => $request->contact ,
            'Pachat' => $request->Pachat,
            'adresse_postale' => $request->adresse_postale,
            'TC' => $request->TC,
            'commercial_id' => auth()->user()->id,
        ]);

        if($request->TC === "0")
        {
            $this->validate($request, [
                'forme_juridique' => 'required|min:2',
                'numero_identifie' => 'required|min:2',
                'domaine' => 'required|min:2',
                'siege_social' => 'required|min:2',
            ]);

            $clientinfo = Clientinfo::create([
                'genre' => null,
                'naissance' => null,
                'forme_juridique' => $request->forme_juridique,
                'numero_identifie' => $request->numero_identifie,
                'domaine' => $request->domaine,
                'siege_social' => $request->siege_social,
                'client_id' => $client->id,
            ]);
        }else{
            $this->validate($request, [
                'genre' => 'required|min:4',
                'naissance' => 'required|min:8',
            ]);

            $clientinfo = Clientinfo::create([
                'genre' => $request->genre,
                'naissance' => $request->naissance,
                'forme_juridique' => null,
                'numero_identifie' => null,
                'domaine' => null,
                'siege_social' => null,
                'client_id' => $client->id,
            ]);
        }

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
        // Validation
        //données
            $noms = $client->nom ;
        //

        $this->validate($request, [
            'nom' => 'required|min:2',
            'adresse_postale' => 'required|min:2',
            'Pachat' => 'required|min:2',
            'contact'   => 'required|unique:clients,contact,' . $client->id . '|min:8|max:12',
            'email'   => 'required|email|unique:clients,email,' . $client->id . '|min:8',
        ]);
        
        $client->update($request->post());

        if($request->TC === "0")
        {
            $this->validate($request, [
                'forme_juridique' => 'required|min:2',
                'numero_identifie' => 'required|min:2',
                'domaine' => 'required|min:2',
                'siege_social' => 'required|min:2',
            ]);
        }else{
            $this->validate($request, [
                'genre' => 'required|min:4',
                'naissance' => 'required|min:8',
            ]);
        }
        
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
