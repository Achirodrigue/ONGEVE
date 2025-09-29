<?php

namespace App\Http\Controllers\Commercial;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Commercial;
use App\Models\Clientdevis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CommercialController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        if(!PageAccessibleCommercial()) 
        {
            return redirect()->route('commercial.home')->with('error',"Désolé! vous n'êtes pas un responsable commercial pour effectuer cette opération");
        } 

        $commercials = Commercial::orderBy('updated_at','desc')->get()->except(auth()->user()->id);
        return view('dashboard.commercial.commercial.all-commercial', compact('commercials'));
    }

    public function create()
    {
        if(!PageAccessibleCommercial()) 
        {
            return redirect()->route('commercial.home')->with('error',"Désolé! vous n'êtes pas un responsable commercial pour effectuer cette opération");
        } 

        return view('dashboard.commercial.commercial.add-commercial');
    }

    public function store(Request $request)
    {
        if(!PageAccessibleCommercial()) 
        {
            return redirect()->route('commercial.home')->with('error',"Désolé! vous n'êtes pas un responsable commercial pour effectuer cette opération");
        } 

        // dd($request->contact);
        $request->validate([
            'nom' => 'required|min:2',
            'prenom' => 'required|min:2',
            'contact' => 'required|unique:commercials|min:8|max:12',
            'email' => 'required|email|unique:commercials|min:8',
            'premise' => 'required|min:1',
            'identifiant'   => 'required|unique:commercials|min:3',
            'password'   => 'required|unique:commercials|min:6',
        ]);
        
        $photo = null;    
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'required|mimes:png,jpg,jpeg',
            ]);
            $photo = storeImage($request->file('photo'), "CommercantPhoto");
        }

        // Création du commercial
        $commercial = Commercial::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'contact' => $request->contact ,
            'email' => $request->email ,
            'premise' => $request->premise ,
            'isvalide' => 1,
            'photo' => $photo,
            'role' => 0,
            'statut' => 0,
            'identifiant' => $request->identifiant,
            'password' => Hash::make($request->password),
        ]);

        //données
            $noms = "$commercial->nom $commercial->prenom" ;
        //

        return redirect()->route('commercial.commercial.index')->with('success', "$noms ajouté avec succès");
    }

    public function show (Commercial $commercial)  
    {
        //
    }

    public function edit (Commercial $commercial)  
    {
        if(!PageAccessibleCommercial()) 
        {
            return redirect()->route('commercial.home')->with('error',"Désolé! vous n'êtes pas un responsable commercial pour effectuer cette opération");
        } 

        return view('dashboard.commercial.commercial.edit-commercial', compact('commercial'));
    }

    public function update(Request $request, Commercial $commercial)
    {
        if(!PageAccessibleCommercial()) 
        {
            return redirect()->route('commercial.home')->with('error',"Désolé! vous n'êtes pas un responsable commercial pour effectuer cette opération");
        } 

        // Validation
        $request->validate([
            'nom' => 'required|min:2',
            'prenom' => 'required|min:2',
            'contact'   => 'required|unique:commercials,contact,' . $commercial->id . '|min:8|max:12',
            'email'   => 'required|email|unique:commercials,email,' . $commercial->id . '|min:8',
            'premise' => 'required|min:1',
            'identifiant'   => 'required|unique:commercials,identifiant,' . $commercial->id . '|min:3',
        ]);

        //données
            $noms = "$commercial->nom $commercial->prenom" ;
            $photo = $commercial->photo;
            $password = $commercial->password;
        //  

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'required|mimes:png,jpg,jpeg',
            ]);
            if($commercial->photo){Storage::disk('public')->delete($commercial->photo);}
            $photo = storeImage($request->file('photo'), "CommercantPhoto");
        }
        

        if(!empty($request->passwords))
        {
            $this->validate($request, [
                'password'   => 'required|unique:commercials,password,' . $commercial->id . '|min:6',
            ]);
            $password = Hash::make($request->passwords);
        }
        
        $commercial->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'contact' => $request->contact ,
            'email' => $request->email ,
            'premise' => $request->premise ,
            'photo' => $photo,
            'identifiant' => $request->identifiant,
            'password' => $password,
        ]);
        
        return redirect()->route('commercial.commercial.index')->with('success', "$noms modifié avec succès");
    }

    public function destroy(Commercial $commercial)
    {
        if(!PageAccessibleCommercial()) 
        {
            return redirect()->route('commercial.home')->with('error',"Désolé! vous n'êtes pas un responsable commercial pour effectuer cette opération");
        } 

        //données
            $noms = "$commercial->nom $commercial->prenom" ;
        //

        return back()->with('error','Désolé! Impossible de supprimer ce commercial.');


        // $livreurCommande = $livreur->commandelivreurs()->count();

        // if($livreurCommande > 0)
        // {
        //     return back()->with('error','Désolé! Ce livreur possède des commandes en cours donc impossible de le supprimer.');
        // }
        // else
        // {
        //     if ($livreur->photo)
        //     {
        //         Storage::disk('public')->delete($livreur->photo);
        //     }
        //     $livreur->delete();
        //     return back()->with('success', "$noms supprimé avec succès");
        // }
        // $commercial->delete();
        // return back()->with('success', "$noms supprimé avec succès");
    }

    
    //statistique
        public function commercialStatistique(Commercial $commercial)
        {
            $clients = Client::orderBy('updated_at','desc')->get();
            $CA = 0;
            $MT = 0;

            $AuthClients = $commercial->clients()->orderBy('updated_at','desc')->get();

            $clientdevis = $commercial->clientdevis()->orderBy('updated_at','desc')->get();

            foreach($clientdevis as $ChiffreAffaire)
            {
                $CA += $ChiffreAffaire->versement ;
                $MT += $ChiffreAffaire->total_payer ;
            }

            return  view('dashboard.commercial.commercial.statistique.statistique', 
                    compact('clients','clientdevis','AuthClients','CA','MT','commercial'));
        }
        public function commercialStatistiqueAnnee(Request $request, Commercial $commercial)
        {
            $startYear = 2024;
            $currentYear = now()->year;
            $selectedYear = $request->input('year', $currentYear);

            // Récupération par mois
            $devisData = Clientdevis::whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })
                        ->select(
                            DB::raw('YEAR(created_at) as year'),
                            DB::raw('MONTH(created_at) as month'),
                            DB::raw('COUNT(*) as total')
                        )
                        ->where('commercial_id', $commercial->id)
                        ->whereYear('created_at', $selectedYear)
                        ->groupBy('year', 'month')
                        ->orderBy('month')
                        ->get();

            // Structure pour le graphe
            $chartData = [];
            foreach (range(1, 12) as $m) {
                $monthName = Carbon::create()->month($m)->format('F');
                $chartData[$monthName] = 0;
            }
            foreach ($devisData as $row) {
                $monthName = Carbon::create()->month($row->month)->format('F');
                $chartData[$monthName] = $row->total;
            }

            return view('dashboard.commercial.commercial.statistique.statistique-annee', [
                'startYear'   => $startYear,
                'currentYear' => $currentYear,
                'selectedYear'=> $selectedYear,
                'chartData'   => $chartData,
                'commercial'   => $commercial
            ]);
        }
        public function commercialStatistiqueMois(Commercial $commercial, $year, $month)
        {
            $clientdevis = Clientdevis::where('commercial_id', $commercial->id)
                        ->whereHas('clientdevisinfo', function ($query) {
                            $query->where('isvalide', 1);
                        })
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get();

            $monthName = Carbon::create()->month($month)->translatedFormat('F');

            return view('dashboard.commercial.commercial.statistique.statistique-mois', [
                'clientdevis' => $clientdevis,
                'year'  => $year,
                'month' => $month,
                'monthName' => $monthName,
                'commercial'   => $commercial
            ]);
        }
    //
}
