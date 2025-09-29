<?php

namespace App\Http\Controllers\Geststock;

use App\Models\Rgeststock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;

class GeststockGestionnaireStockController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('geststock.home')->with('error',"Désolé! vous n'êtes pas un responsable pour effectuer cette opération");
        } 

        $geststocks = Rgeststock::orderBy('updated_at','desc')->get()->except(auth()->user()->id);
        return view('dashboard.geststock.geststock.all-geststock', compact('geststocks'));
    }

    public function create()
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('geststock.home')->with('error',"Désolé! vous n'êtes pas un responsable pour effectuer cette opération");
        } 

        return view('dashboard.geststock.geststock.add-geststock');
    }

    public function store(Request $request)
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('geststock.home')->with('error',"Désolé! vous n'êtes pas un responsable pour effectuer cette opération");
        } 

        $request->validate([
            'nom' => 'required|min:2',
            'prenom' => 'required|min:2',
            'contact' => 'required|unique:rgeststocks|min:8|max:12',
            'email' => 'required|email|unique:rgeststocks|min:8',
            'role' => 'required',
            'identifiant'   => 'required|unique:rgeststocks|min:3',
            'password'   => 'required|unique:rgeststocks|min:6',
        ]);

        // Création du geststock
        $geststock = Rgeststock::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'contact' => $request->contact ,
            'email' => $request->email ,
            'role' => $request->role,
            'isvalide' => 1,
            'photo' => null,
            'statut' => 0,
            'connexion' => "geststock",
            'identifiant' => $request->identifiant,
            'password' => Hash::make($request->password),
        ]);

        //données
            $noms = "$geststock->nom $geststock->prenom" ;
        //

        return redirect()->route('geststock.rgeststock.index')->with('success', "$noms ajouté avec succès");
    }

    public function show (Rgeststock $rgeststock)  
    {
        //
    }

    public function edit (Rgeststock $rgeststock)  
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('geststock.home')->with('error',"Désolé! vous n'êtes pas un responsable pour effectuer cette opération");
        } 

        return view('dashboard.geststock.geststock.edit-geststock', compact('rgeststock'));
    }

    public function update(Request $request, Rgeststock $rgeststock)
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('geststock.home')->with('error',"Désolé! vous n'êtes pas un responsable geststock pour effectuer cette opération");
        } 

        // Validation
        $request->validate([
            'nom' => 'required|min:2',
            'prenom' => 'required|min:2',
            'contact'   => 'required|unique:rgeststocks,contact,' . $rgeststock->id . '|min:8|max:12',
            'email'   => 'required|email|unique:rgeststocks,email,' . $rgeststock->id . '|min:8',
            'role' => 'required',
            'identifiant'   => 'required|unique:rgeststocks,identifiant,' . $rgeststock->id . '|min:3',
        ]);

        //données
            $noms = "$rgeststock->nom $rgeststock->prenom" ;
            $password = $rgeststock->password;
        //  

        if(!empty($request->password))
        {
            $this->validate($request, [
                'password'   => 'required|unique:rgeststocks,password,' . $rgeststock->id . '|min:6',
            ]);
            $password = Hash::make($request->password);
        }
        
        $rgeststock->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'contact' => $request->contact ,
            'email' => $request->email ,
            'role' => $request->role ,
            'identifiant' => $request->identifiant,
            'password' => $password,
        ]);
        
        return redirect()->route('geststock.rgeststock.index')->with('success', "$noms modifié avec succès");
    }

    public function destroy(Rgeststock $rgeststock)
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('geststock.home')->with('error',"Désolé! vous n'êtes pas un responsable pour effectuer cette opération");
        } 

        //données
            $noms = "$rgeststock->nom $rgeststock->prenom" ;
        //

        return back()->with('error','Désolé! Impossible de supprimer ce gestionnaire.');
    }

    public function geststockCompteUpdate(Rgeststock $rgeststock)
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('geststock.home')->with('error',"Désolé! vous n'êtes pas un responsable pour effectuer cette opération");
        } 
        
        $rgeststock->update([
            'isvalide' => !$rgeststock->isvalide,
        ]);

        $etat = "bloqué";
        if($rgeststock->isvalide)
        {
            $etat = "activé";
        }
        
        return back()->with('success', "Compte de $rgeststock->nom $rgeststock->prenom $etat avec succès.");
    }
}