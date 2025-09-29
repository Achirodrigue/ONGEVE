<?php

namespace App\Http\Controllers\Packauto;


use App\Models\Pcategorievehicule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class PackautoCategorieVehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $pcategorievehicules = Pcategorievehicule::orderBy('updated_at','desc')->get();
        // dd(5);
        return view('dashboard.packauto.categorie-vehicule.all-categorie', compact('pcategorievehicules'));
    }

    public function create()
    {
        // return view('dashboard.packauto.categorie-vehicule.add-categorie');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|unique:pcategorievehicules|min:3'
        ]);

        $pcategorievehicule = Pcategorievehicule::create([
            'nom' => $request->nom
        ]);
            
        return back()->with('success', "$pcategorievehicule->nom ajouté avec succès");
    }
    
    public function show(Pcategorievehicule $pcategorievehicule)
    {
        return view('dashboard.packauto.categorie-vehicule.categorie-vehicule', compact('pcategorievehicule'));
    }
    
    public function edit(Pcategorievehicule $pcategorievehicule)     //(string $id)
    {
        // return view('dashboard.packauto.categorie-vehicule.edit-categorie', compact('pcategorievehicule'));
    }

    public function update(Request $request, Pcategorievehicule $pcategorievehicule)
    {
        // dd($pcategorievehicule->id);
        $this->validate($request, [
            'nom' => [
                'required',
                'min:3',
                Rule::unique('pcategorievehicules', 'nom')->ignore($pcategorievehicule->id),
            ],
        ]);
        
        $noms = $pcategorievehicule->nom;
        $pcategorievehicule->update($request->post());
        return back()->with('success', "$noms modifié avec succès");
    }

    public function destroy(Pcategorievehicule $pcategorievehicule)
    {
        $noms = $pcategorievehicule->nom;
        if($pcategorievehicule->pvehicules->count() > 0)
        {
            return back()->with('error',"Désolé! vous ne pouvez pas supprimer $noms car elle contient des véhicules.");
        }
        
        $pcategorievehicule->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }

    
    //categorie vehicule
        public function categorieVehicule(Pcategorievehicule $pcategorievehicule)
        {
            return view('dashboard.packauto.categorie-vehicule.categorie-vehicule', compact('pcategorievehicule'));
        }
    //
}
