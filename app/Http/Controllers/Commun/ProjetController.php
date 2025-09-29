<?php

namespace App\Http\Controllers\Commun;

use App\Models\Projet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ProjetController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        //
    }

    public function create()
    {
        // 
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titre' => 'required|min:2',
            'description' => 'nullable|min:2',
            'service' => 'required|min:2',
        ]);
        
        $projet = Projet::create([
            'titre' => $request->titre,
            'description' => $request->description ,
            'finalite' => null ,
            'service' => $request->service ,
        ]);

        return back()->with('success', "Nouveau projet ajouté avec succès");
    }

    public function edit(Projet $projet)  
    {
        //
    }

    public function update(Request $request, Projet $projet)
    {
        $this->validate($request, [
            'titre'   => 'required|unique:projets,titre,' . $projet->id . '|min:2',
            'description' => 'nullable|min:2',
        ]);
        
        $projet->update($request->post());
        
        return back()->with('success', "Projet modifié avec succès");
    }

    public function destroy(Projet $projet)
    {
        $projet->delete();
        return back()->with('success', "Projet supprimé avec succès");
    }
}
