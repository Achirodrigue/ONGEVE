<?php

namespace App\Http\Controllers\Packauto;


use App\Models\Pvehiculedocname;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class PackautoVehiculeDocNameController extends Controller
{

    public function index()
    {
        $pvehiculedocnames = Pvehiculedocname::orderBy('updated_at','desc')->get();
        return view('dashboard.packauto.reglage.vehicule-doc-name', compact('pvehiculedocnames'));
    }

    public function create()
    {
        // 
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|unique:pvehiculedocnames|min:1'
        ]);

        $pvehiculedocname = Pvehiculedocname::create([
            'nom' => $request->nom
        ]);
            
        return back()->with('success', "$pvehiculedocname->nom ajouté avec succès");
    }
    
    public function show(Pvehiculedocname $pvehiculedocname)
    {
        // return view('dashboard.packauto.categorie-vehicule.categorie-vehicule', compact('pvehiculedocname'));
    }
    
    public function edit(Pvehiculedocname $pvehiculedocname)     //(string $id)
    {
        // return view('dashboard.packauto.categorie-vehicule.edit-categorie', compact('pvehiculedocname'));
    }

    public function update(Request $request, Pvehiculedocname $pvehiculedocname)
    {
        // dd($pvehiculedocname->id);
        $this->validate($request, [
            'nom' => [
                'required',
                'min:3',
                Rule::unique('pvehiculedocnames', 'nom')->ignore($pvehiculedocname->id),
            ],
        ]);
        
        $noms = $pvehiculedocname->nom;
        $pvehiculedocname->update($request->post());
        return back()->with('success', "$noms modifié avec succès");
    }

    public function destroy(Pvehiculedocname $pvehiculedocname)
    {
        $noms = $pvehiculedocname->nom;
        if($pvehiculedocname->pvehiculedocs->count() > 0)
        {
            return back()->with('error',"Désolé! vous ne pouvez pas supprimer $noms car il est encours d'utilisation.");
        }
        
        $pvehiculedocname->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
}
