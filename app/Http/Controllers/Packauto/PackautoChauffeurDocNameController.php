<?php

namespace App\Http\Controllers\Packauto;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Pchauffeurdocname;
use App\Http\Controllers\Controller;

class PackautoChauffeurDocNameController extends Controller
{

    public function index()
    {
        $pchauffeurdocnames = Pchauffeurdocname::orderBy('updated_at','desc')->get();
        return view('dashboard.packauto.reglage.chauffeur-doc-name', compact('pchauffeurdocnames'));
    }

    public function create()
    {
        // 
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|unique:pchauffeurdocnames|min:1'
        ]);

        $pchauffeurdocname = Pchauffeurdocname::create([
            'nom' => $request->nom
        ]);
            
        return back()->with('success', "$pchauffeurdocname->nom ajouté avec succès");
    }
    
    public function show(Pchauffeurdocname $pchauffeurdocname)
    {
        // return view('dashboard.packauto.categorie-chauffeur.categorie-chauffeur', compact('pchauffeurdocname'));
    }
    
    public function edit(Pchauffeurdocname $pchauffeurdocname)     //(string $id)
    {
        // return view('dashboard.packauto.categorie-chauffeur.edit-categorie', compact('pchauffeurdocname'));
    }

    public function update(Request $request, Pchauffeurdocname $pchauffeurdocname)
    {
        // dd($pchauffeurdocname->id);
        $this->validate($request, [
            'nom' => [
                'required',
                'min:3',
                Rule::unique('pchauffeurdocnames', 'nom')->ignore($pchauffeurdocname->id),
            ],
        ]);
        
        $noms = $pchauffeurdocname->nom;
        $pchauffeurdocname->update($request->post());
        return back()->with('success', "$noms modifié avec succès");
    }

    public function destroy(Pchauffeurdocname $pchauffeurdocname)
    {
        $noms = $pchauffeurdocname->nom;
        if($pchauffeurdocname->pchauffeurdocs->count() > 0)
        {
            return back()->with('error',"Désolé! vous ne pouvez pas supprimer $noms car il est encours d'utilisation.");
        }
        
        $pchauffeurdocname->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
}
