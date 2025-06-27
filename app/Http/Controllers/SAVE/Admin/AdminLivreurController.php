<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Livreur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\FonctionPersonnelle\FonctionPersonnelle;

class AdminLivreurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livreurs = Livreur::orderBy('nom','asc')->paginate(20);
        return view('dashboard.admin.livreur.all-livreur', compact('livreurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        $admins = Admin::orderBy('nom','asc')->where('role', 0)->get();
        $admin = Admin::where('role', 1)->first();
        
        return view('dashboard.admin.livreur.add-livreur', compact('admins','admin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        //données
            $photo = null;
        //

        $this->validate($request, [
            'contact'   => 'required|unique:livreurs|min:8|max:12',
            'email'   => 'required|email|unique:livreurs|min:8',
            'nom'   => 'required|min:3',
            'prenom'   => 'required|min:4',
            'adresse'   => 'required|min:4',
            'identifiant'   => 'required|unique:livreurs|min:3',
            'password'   => 'required|unique:livreurs|min:6',
            'photo' => 'required|mimes:png,jpg,jpeg',
            'admin' => 'required|min:1'
        ]);
        

            $filename = time() . '.' . $request->photo->extension();
            $photo = $request->file('photo')->storeAs(
                'LivreurPhoto',
                $filename,
                'public'
            );

        $livreur = livreur::create([
            'nom' => $request->nom ,
            'prenom' => $request->prenom ,
            'contact' => $request->contact ,
            'email' => $request->email ,
            'photo' => $photo ,
            'isvalide' => 1 ,
            'adresse' => $request->adresse,
            'identifiant' => $request->identifiant,
            'password' => Hash::make($request->password),
            'admin_id' => $request->admin
        ]);

        $noms = "$livreur->nom $livreur->prenom" ;
            
        return redirect()->route('admin.livreur.index')->with('success', "$noms ajouté avec succès");
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
    public function edit(Livreur $livreur)     //(string $id)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        $admins = Admin::orderBy('nom','asc')->where('role', 0)->get();
        $admin = Admin::where('role', 1)->first();

        return view('dashboard.admin.livreur.edit-livreur', compact('livreur','admins','admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Livreur $livreur)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        //donnée
            $noms = "$livreur->nom $livreur->prenom" ;
            $photo = $livreur->photo;
            $password = $livreur->password;
        //
        
        $this->validate($request, [
            'contact'   => 'required|unique:livreurs,contact,' . $livreur->id . '|min:8|max:12',
            'email'   => 'required|email|unique:livreurs,email,' . $livreur->id . '|min:8',
            'nom'   => 'required|min:3',
            'prenom'   => 'required|min:3',
            'adresse'   => 'required|min:4',
            'identifiant'   => 'required|unique:admins,identifiant,' . $livreur->id . '|min:3',
        ]);

        if (!empty($request->photo))
        {
            $this->validate($request, [
                'photo' => 'required|mimes:png,jpg,jpeg',
            ]);
            
            if($livreur->photo){Storage::disk('public')->delete($livreur->photo);}
            $filename = time() . '.' . $request->photo->extension();
            $photo = $request->file('photo')->storeAs(
                'LivreurPhoto',
                $filename,
                'public'
            );
        }

        if(!empty($request->passwords))
        {
            $this->validate($request, [
                'passwords'   => 'required|unique:admins,password,' . $livreur->id . '|min:6',
            ]);
            $password = Hash::make($request->passwords);
        }
        
        $livreur->update([
            'photo' => $photo,
            'password' => $password,
        ]);

        $livreur->update($request->post());

        return redirect()->route('admin.livreur.index')->with('success', "$noms modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livreur $livreur)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }
        
        //donnée
            $noms = "$livreur->nom $livreur->prenom" ;
            $photo = $livreur->photo;
        //

        $livreurCommande = $livreur->commandelivreurs()->count();

        if($livreurCommande > 0)
        {
            return back()->with('error','Désolé! Ce livreur possède des commandes en cours donc impossible de le supprimer.');
        }
        else
        {
            if ($livreur->photo)
            {
                Storage::disk('public')->delete($livreur->photo);
            }
            $livreur->delete();
            return back()->with('success', "$noms supprimé avec succès");
        }
    }
}
