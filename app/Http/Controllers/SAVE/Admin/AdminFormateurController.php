<?php

namespace App\Http\Controllers\Admin;

use App\Models\Formateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\FonctionPersonnelle\FonctionPersonnelle;

class AdminFormateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formateurs = Formateur::orderBy('nom','asc')->paginate(20);
        return view('dashboard.admin.formateur.all-formateur', compact('formateurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        return view('dashboard.admin.formateur.add-formateur');
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
            'contact'   => 'required|unique:formateurs|min:8|max:12',
            'email'   => 'required|email|unique:formateurs|min:8',
            'nom'   => 'required|min:3',
            'prenom'   => 'required|min:4',
            'adresse'   => 'required|min:4',
            'domaine'   => 'required|min:4',
            'photo' => 'required|mimes:png,jpg,jpeg',
        ]);

        $filename = time() . '.' . $request->photo->extension();
        $photo = $request->file('photo')->storeAs(
            'FormateurPhoto',
            $filename,
            'public'
        );

        $formateur = Formateur::create([
            'nom' => $request->nom ,
            'prenom' => $request->prenom ,
            'contact' => $request->contact ,
            'email' => $request->email ,
            'photo' => $photo ,
            'isvalide' => 1 ,
            'adresse' => $request->adresse,
            'domaine' => $request->domaine,
        ]);

        $noms = "$formateur->nom $formateur->prenom" ;
            
        return redirect()->route('admin.formateur.index')->with('success', "$noms ajouté avec succès");
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
    public function edit(Formateur $formateur)     //(string $id)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }
        
        return view('dashboard.admin.formateur.edit-formateur', compact('formateur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formateur $formateur)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        //donnée
            $noms = "$formateur->nom $formateur->prenom" ;
            $photo = $formateur->photo;
        //
        
        $this->validate($request, [
            'contact'   => 'required|unique:formateurs,contact,' . $formateur->id . '|min:8|max:12',
            'email'   => 'required|email|unique:formateurs,email,' . $formateur->id . '|min:8',
            'nom'   => 'required|min:3',
            'prenom'   => 'required|min:4',
            'adresse'   => 'required|min:4',
            'domaine'   => 'required|min:4',
        ]);

        if (!empty($request->photo))
        {
            $this->validate($request, [
                'photo' => 'required|mimes:png,jpg,jpeg',
            ]);
            
            if($formateur->photo){Storage::disk('public')->delete($formateur->photo);}
            $filename = time() . '.' . $request->photo->extension();
            $photo = $request->file('photo')->storeAs(
                'FormateurPhoto',
                $filename,
                'public'
            );
        }

        $formateur->update([
            'photo' => $photo
        ]);

        $formateur->update($request->post());

        return redirect()->route('admin.formateur.index')->with('success', "$noms modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formateur $formateur)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }
        
        //donnée
            $noms = "$formateur->nom $formateur->prenom" ;
            $photo = $formateur->photo;
        //

        $formateurFormation = $formateur->formationformateurs()->count();

        if($formateurFormation > 0)
        {
            return back()->with('error','Désolé! Ce formateur possède des formations en cours donc impossible de le supprimer.');
        }
        else
        {
            if (!empty($formateur->photo))
            {
                Storage::disk('public')->delete($formateur->photo);
            }
            $formateur->delete();
            return back()->with('success', "$noms supprimé avec succès");
        }
    }
}
