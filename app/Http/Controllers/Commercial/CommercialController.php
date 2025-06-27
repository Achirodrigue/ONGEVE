<?php

namespace App\Http\Controllers\Commercial;

use App\Models\Commercial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CommercialController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        $Rcommercial = PageAccessibleCommercial() ;

        $commercials = Commercial::orderBy('updated_at','desc')->get()->except(auth()->user()->id);
        return view('dashboard.commercial.commercial.all-commercial', compact('commercials'));
    }

    public function create()
    {
        $Rcommercial = PageAccessibleCommercial() ;

        return view('dashboard.commercial.commercial.add-commercial');
    }

    public function store(Request $request)
    {
        $Rcommercial = PageAccessibleCommercial() ;

        $request->validate([
            'nom' => 'required|min:2',
            'prenom' => 'required|min:2',
            'contact' => 'required|unique:commercials|min:8|max:12',
            'email' => 'required|email|unique:commercials|min:8',
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
            'isvalide' => 1,
            'photo' => $photo,
            'role' => 0,
            'identifiant' => $request->identifiant,
            'password' => Hash::make($request->password),
        ]);

        //données
            $noms = "$commercial->nom $commercial->prenom" ;
        //

        return redirect()->route('commercial.commercial.index')->with('success', "$noms ajouté avec succès");
    }

    public function edit (Commercial $commercial)  
    {
        $Rcommercial = PageAccessibleCommercial() ;

        return view('dashboard.commercial.commercial.edit-commercial', compact('commercial'));
    }

    public function update(Request $request, Commercial $commercial)
    {
        $Rcommercial = PageAccessibleCommercial() ;

        // Validation
        $request->validate([
            'nom' => 'required|min:2',
            'prenom' => 'required|min:2',
            'contact'   => 'required|unique:commercials,contact,' . $commercial->id . '|min:8|max:12',
            'email'   => 'required|email|unique:commercials,email,' . $commercial->id . '|min:8',
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
            'photo' => $photo,
            'identifiant' => $request->identifiant,
            'password' => $password,
        ]);
        
        return redirect()->route('commercial.commercial.index')->with('success', "$noms modifié avec succès");
    }

    public function destroy(Commercial $commercial)
    {
        $Rcommercial = PageAccessibleCommercial() ;

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
}
