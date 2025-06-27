<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Secteur;
use App\Models\Adminsecteur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AdminController extends Controller
{
    use ValidatesRequests;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all()->except(auth()->user()->id);
        return view('dashboard.admin.administrateur.all-admin', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $secteurs = Secteur::all();
        if(auth()->user()->role)
        {
            return view('dashboard.admin.administrateur.add-admin', compact('secteurs'));
        }

        return redirect()->route('admin.admin.index')->with('message',"Désolé! vous n'êtes pas un super admin");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom'   => 'required|min:4',
            'prenom'   => 'required|min:4',
            'contact'   => 'required|unique:admins|min:8|max:12',
            'email'   => 'required|email|unique:admins|min:8',
            'role'   => 'required|min:5',
            'identifiant'   => 'required|unique:admins|min:4',
            'password'   => 'required|unique:admins|min:6|max:12',
            'photo'   => 'mimes:png,jpg,jpeg',
        ]);

        //données
            $photo = null;
        //

        if($request->role === "super_admin"){
            $role = 1; 
        }else{  
            // $this->validate($request, [
            //     'secteur'   => 'required',
            // ]);
            $role = 0; 
        }

        if (!empty($request->photo))
        {
            $this->validate($request, [
                'photo' => 'required|mimes:png,jpg,jpeg',
            ]);

            $filename = time() . '.' . $request->photo->extension();
            $photo = $request->file('photo')->storeAs(
                'AdminPhoto',
                $filename,
                'public'
            );
        }

        $admin = Admin::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'contact' => $request->contact,
            'email' => $request->email,
            'isvalide' => 1,
            'photo' => $photo,
            'role' => $role,
            'autorise' => 1,
            'identifiant' => $request->identifiant,
            'password' => Hash::make($request->password)
        ]);

        if(!$admin->role)
        { 
            $adminsecteur = Adminsecteur::create([
                'admin_id' => $admin->id,
                'secteur_id' => $request->secteur ?? null,
            ]);
        }

        return redirect()->route('admin.admin.index')->with('success', "$admin->nom $admin->prenom ajouté avec succès");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)     //(string $id)
    {
        if(auth()->user()->role)
        {
            $secteurs = Secteur::all();
            if(!$admin->role && Auth()->user()->adminsecteur && Auth()->user()->adminsecteur->secteur_id){
                $secteurs = Secteur::all()->except($admin->adminsecteur->secteur->id);
            }
            // if (
            //     !$admin->role &&
            //     Auth()->user()->adminsecteur &&
            //     Auth()->user()->adminsecteur->secteur_id
            // ) {
            //     $secteurs = Secteur::all()->except($admin->adminsecteur && $admin->adminsecteur->secteur ? $admin->adminsecteur->secteur->id : null);
            // }
            return view('dashboard.admin.administrateur.edit-admin', compact('admin','secteurs'));
        }

        return redirect()->route('admin.admin.index')->with('message',"Désolé! vous n'êtes pas un super admin");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $this->validate($request, [
            'nom'   => 'required|min:4',
            'prenom'   => 'required|min:4',
            'contact'   => 'required|unique:admins,contact,' . $admin->id . '|min:8|max:12',
            'email'   => 'required|email|unique:admins,email,' . $admin->id . '|min:8',
            'roles'   => 'required|min:5',
            'identifiant'   => 'required|unique:admins,identifiant,' . $admin->id . '|min:4',
            // 'photo'   => 'mimes:png,jpg,jpeg',
        ]);
        //dd(1);
        //données
            $noms = "$admin->nom $admin->prenom";
            $photo = $admin->photo;
            $password = $admin->password;
        //

        if($request->roles === "super_admin"){ 
            $role = 1; 
        }else{  
            // $this->validate($request, [
            //     'secteur'   => 'required',
            // ]);
            $role = 0; 
        }

        if (!empty($request->photo))
        {
            $this->validate($request, [
                'photo' => 'required|mimes:png,jpg,jpeg',
            ]);
            
            if($admin->photo){ Storage::disk('public')->delete($admin->photo); }

            $filename = time() . '.' . $request->photo->extension();
            $photo = $request->file('photo')->storeAs(
                'AdminPhoto',
                $filename,
                'public'
            );
        }

        if(!empty($request->passwords))
        {
            $this->validate($request, [
                'passwords'   => 'required|min:6|max:12',
            ]);
            $password = Hash::make($request->passwords);
        }
        
        $admin->update([
            'photo' => $photo,
            'password' => $password,
            'role' => $role,
        ]);

        $admin->update($request->post());

        if(!$admin->role)
        { 
            if($admin->adminsecteur)
            { 
                $admin->adminsecteur->update([
                    'secteur_id' => $request->secteur ?? null,
                ]);
            }
            else
            {
                $adminsecteur = Adminsecteur::create([
                    'admin_id' => $admin->id,
                    'secteur_id' => $request->secteur ?? null,
                ]);
            }
        }

        return redirect()->route('admin.admin.index')->with('success', "Modification de $noms effectuée avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        if(auth()->user()->role)
        {
            $noms = "$admin->nom $admin->prenom";
            if($admin->photo){ Storage::disk('public')->delete($admin->photo); }
            $admin->delete();
            return back()->with('success', "$noms supprimé avec succès");
        }

        return redirect()->route('admin.admin.index')->with('message',"Désolé! vous n'êtes pas un super admin");
        
    }

}