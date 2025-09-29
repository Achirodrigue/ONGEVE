<?php

namespace App\Http\Controllers\Comptable;

use App\Models\Comptable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ComptableController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('comptable.home')->with('error',"Désolé! vous n'êtes pas un responsable comptable pour effectuer cette opération");
        } 

        $comptables = Comptable::orderBy('updated_at','desc')->get()->except(auth()->user()->id);
        return view('dashboard.comptable.comptable.all-comptable', compact('comptables'));
    }

    public function create()
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('comptable.home')->with('error',"Désolé! vous n'êtes pas un responsable comptable pour effectuer cette opération");
        } 

        return view('dashboard.comptable.comptable.add-comptable');
    }

    public function store(Request $request)
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('comptable.home')->with('error',"Désolé! vous n'êtes pas un responsable comptable pour effectuer cette opération");
        } 

        $request->validate([
            'nom' => 'required|min:2',
            'prenom' => 'required|min:2',
            'contact' => 'required|unique:comptables|min:8|max:12',
            'email' => 'required|email|unique:comptables|min:8',
            'role' => 'required',
            'identifiant'   => 'required|unique:comptables|min:3',
            'password'   => 'required|unique:comptables|min:6',
        ]);

        // Création du comptable
        $comptable = Comptable::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'contact' => $request->contact ,
            'email' => $request->email ,
            'isvalide' => 1,
            'photo' => null,
            'statut' => 0,
            'role' => $request->role,
            'identifiant' => $request->identifiant,
            'password' => Hash::make($request->password),
        ]);

        //données
            $noms = "$comptable->nom $comptable->prenom" ;
        //

        return redirect()->route('comptable.comptable.index')->with('success', "$noms ajouté avec succès");
    }

    public function show (Comptable $comptable)  
    {
        //
    }

    public function edit (Comptable $comptable)  
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('comptable.home')->with('error',"Désolé! vous n'êtes pas un responsable comptable pour effectuer cette opération");
        } 

        return view('dashboard.comptable.comptable.edit-comptable', compact('comptable'));
    }

    public function update(Request $request, Comptable $comptable)
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('comptable.home')->with('error',"Désolé! vous n'êtes pas un responsable comptable pour effectuer cette opération");
        } 

        // Validation
        $request->validate([
            'nom' => 'required|min:2',
            'prenom' => 'required|min:2',
            'contact'   => 'required|unique:comptables,contact,' . $comptable->id . '|min:8|max:12',
            'email'   => 'required|email|unique:comptables,email,' . $comptable->id . '|min:8',
            'role' => 'required',
            'identifiant'   => 'required|unique:comptables,identifiant,' . $comptable->id . '|min:3',
        ]);

        //données
            $noms = "$comptable->nom $comptable->prenom" ;
            $password = $comptable->password;
        //  

        if(!empty($request->passwords))
        {
            $this->validate($request, [
                'password'   => 'required|unique:comptables,password,' . $comptable->id . '|min:6',
            ]);
            $password = Hash::make($request->passwords);
        }
        
        $comptable->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'contact' => $request->contact ,
            'email' => $request->email ,
            'role' => $request->role ,
            'identifiant' => $request->identifiant,
            'password' => $password,
        ]);
        
        return redirect()->route('comptable.comptable.index')->with('success', "$noms modifié avec succès");
    }

    public function destroy(Comptable $comptable)
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('comptable.home')->with('error',"Désolé! vous n'êtes pas un responsable comptable pour effectuer cette opération");
        } 

        //données
            $noms = "$comptable->nom $comptable->prenom" ;
        //

        return back()->with('error','Désolé! Impossible de supprimer ce comptable.');


        // $noms = "$comptable->nom $comptable->prenom";
        // $comptable->delete();
        // return back()->with('success', "$noms supprimé avec succès");
    }

    public function comptableCompteUpdate(Comptable $comptable)
    {
        if(!auth()->user()->role) 
        {
            return redirect()->route('comptable.home')->with('error',"Désolé! vous n'êtes pas un responsable comptable pour effectuer cette opération");
        } 
        
        $comptable->update([
            'isvalide' => !$comptable->isvalide,
        ]);

        $etat = "bloqué";
        if($comptable->isvalide)
        {
            $etat = "activé";
        }
        
        return back()->with('success', "Compte de $comptable->nom $comptable->prenom $etat avec succès.");
    }
}