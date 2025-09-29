<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Clientinfo;
use App\Models\Clientdevis;
use Illuminate\Http\Request;
use App\Models\Clientdevisbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AdminClientController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        // dd(5);
        $clients = Client::orderBy('updated_at','desc')->get();
        return view('dashboard.admin.client.all-client', compact('clients'));
    }

    public function create()
    {
        // return view('dashboard.comptable.client.add-client');
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Client $client)  
    {
        //
    }

    public function update(Request $request, Client $client)
    {
        //
    }

    public function destroy(Client $client)
    {
        //
    }

    //commande client
        public function clientCommandeImpaye(Client $client)
        {
            $clientdevis = $client->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', null)->where('versement', null)->orderBy('updated_at','desc')->get();
            return view('dashboard.admin.client.commande.commande-impaye', compact('client','clientdevis'));
        }
        public function clientCommandePaye(Client $client)
        {
            $clientdevis = $client->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 1)->where('versement','=','total_payer')->orderBy('updated_at','desc')->get();
            return view('dashboard.admin.client.commande.commande-paye', compact('client','clientdevis'));
        }
        public function clientCommandePartielle(Client $client)
        {
            $clientdevis = $client->clientdevis()->whereHas('clientdevisinfo', function ($query) {
                    $query->where('isvalide', 1);
                })->where('statut', 2)->where('versement','<','total_payer')->where('versement','>',0)->orderBy('updated_at','desc')->get();
            return view('dashboard.admin.client.commande.commande-partielle', compact('client','clientdevis'));
        }
    //
}
