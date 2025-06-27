<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vendeur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\FonctionPersonnelle\FonctionPersonnelle;

class AdminVendeurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendeurs = Vendeur::orderBy('updated_at','desc')->paginate(20);
        return view('dashboard.admin.vendeur.all-vendeur', compact('vendeurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }
        
        return view('dashboard.admin.vendeur.add-vendeur');
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
            //$logo = null;
        //

        $this->validate($request, [
            'nom_entreprise'   => 'required|unique:vendeurs|min:4',
            'nom_prenom_gerant'   => 'required|min:4',
            'contact'   => 'required|unique:vendeurs|min:8|max:12',
            'email'   => 'required|email|unique:vendeurs|min:8',
            'logo' => 'required|mimes:png,jpg,jpeg',
            'adresse'   => 'required|min:4',
            'domaine'   => 'required|min:4',
        ]);

        $filename = time() . '.' . $request->logo->extension();
        $logo = $request->file('logo')->storeAs(
            'BoutiqueLogo',
            $filename,
            'public'
        );

        $vendeur = Vendeur::create([
            'nom_entreprise' => $request->nom_entreprise ,
            'nom_prenom_gerant' => $request->nom_prenom_gerant ,
            'contact' => $request->contact ,
            'email' => $request->email ,
            'logo' => $logo ,
            'isvalide' => 1 ,
            'adresse' => $request->adresse,
            'domaine' => $request->domaine
        ]);

        $noms = "$vendeur->nom_prenom_gerant" ;
            
        return redirect()->route('admin.vendeur.index')->with('success', "Boutique de $noms ajouté avec succès");
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
    public function edit(Vendeur $vendeur)     //(string $id)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        return view('dashboard.admin.vendeur.edit-vendeur', compact('vendeur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendeur $vendeur)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        //donnée
            $noms = $vendeur->nom_prenom_gerant ;
            $logo = $vendeur->logo;
        //
        
        $this->validate($request, [
            'nom_entreprise'   => 'required|unique:vendeurs,nom_entreprise,' . $vendeur->id . '|min:4',
            'nom_prenom_gerant'   => 'required|min:4',
            'contact'   => 'required|unique:vendeurs,contact,' . $vendeur->id . '|min:8|max:12',
            'email'   => 'required|email|unique:vendeurs,email,' . $vendeur->id . '|min:8',
            'adresse'   => 'required|min:4',
            'domaine'   => 'required|min:4',
        ]);

        if (!empty($request->logo))
        {
            $this->validate($request, [
                'logo' => 'required|mimes:png,jpg,jpeg',
            ]);
            
            Storage::disk('public')->delete($vendeur->logo);
            $filename = time() . '.' . $request->logo->extension();
            $logo = $request->file('logo')->storeAs(
                'BoutiqueLogo',
                $filename,
                'public'
            );
        }

        $vendeur->update([
            'logo' => $logo
        ]);

        $vendeur->update($request->post());

        return redirect()->route('admin.vendeur.index')->with('success', "Boutique de $noms modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendeur $vendeur)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }
        
        //donnée
            $noms = $vendeur->nom_prenom_gerant ;
            //$logo = $vendeur->logo;
        //
        $vendeurProduit = $vendeur->produits()->count();

        if($vendeurProduit > 0)
        {
            return back()->with('error','Désolé! Cette boutique possède des produits donc impossible de la supprimer.');
        }
        else
        {
            if (!empty($vendeur->logo))
            {
                Storage::disk('public')->delete($vendeur->logo);
            }
            $vendeur->delete();
            return back()->with('success', "Boutique de $noms supprimé avec succès");
        }
    }
}
