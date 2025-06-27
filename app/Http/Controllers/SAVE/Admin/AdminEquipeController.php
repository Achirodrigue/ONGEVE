<?php

namespace App\Http\Controllers\Admin;

use App\Models\Equipe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\FonctionPersonnelle\FonctionPersonnelle;

class AdminEquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipes = Equipe::orderBy('updated_at','desc')->get();
        return view('dashboard.admin.equipe.all-equipe', compact('equipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }
        
        return view('dashboard.admin.equipe.add-equipe');
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
            'nom'   => 'required|min:3',
            'prenom'   => 'required|min:4',
            'contact'   => 'required|unique:equipes|min:8|max:12',
            'email'   => 'required|email|unique:equipes|min:8',
            'adresse'   => 'required|min:4',
            'photo' => 'required|mimes:png,jpg,jpeg',
        ]);

        $filename = time() . '.' . $request->photo->extension();
        $photo = $request->file('photo')->storeAs(
            'equipePhoto',
            $filename,
            'public'
        );

        $equipe = Equipe::create([
            'nom' => $request->nom ,
            'prenom' => $request->prenom ,
            'contact' => $request->contact ,
            'email' => $request->email ,
            'adresse' => $request->adresse,
            'photo' => $photo ,
            'isvalide' => 1 ,
        ]);

        $noms = "$equipe->nom $equipe->prenom" ;
            
        return redirect()->route('admin.equipe.index')->with('success', "$noms ajouté avec succès");
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
    public function edit(Equipe $equipe)     //(string $id)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        return view('dashboard.admin.equipe.edit-equipe', compact('equipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipe $equipe)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        //donnée
            $noms = "$equipe->nom $equipe->prenom" ;
            $photo = $equipe->photo;
        //
        
        $this->validate($request, [
            'contact'   => 'required|unique:equipes,contact,' . $equipe->id . '|min:8|max:12',
            'email'   => 'required|email|unique:equipes,email,' . $equipe->id . '|min:8',
            'nom'   => 'required|min:3',
            'prenom'   => 'required|min:4',
            'adresse'   => 'required|min:4',
        ]);

        if (!empty($request->photos))
        {
            $this->validate($request, [
                'photos' => 'required|mimes:png,jpg,jpeg',
            ]);
            
            Storage::disk('public')->delete($equipe->photo);
            $filename = time() . '.' . $request->photos->extension();
            $photo = $request->file('photos')->storeAs(
                'equipePhoto',
                $filename,
                'public'
            );
        }
        
        $equipe->update([
            'photo' => $photo,
        ]);

        $equipe->update($request->post());

        return redirect()->route('admin.equipe.index')->with('success', "$noms modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipe $equipe)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        //donnée
            $noms = "$equipe->nom $equipe->prenom" ;
        //

        Storage::disk('public')->delete($equipe->photo);
        $equipe->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
}
