<?php

namespace App\Http\Controllers\Comptable\newFonction;

use App\Models\Depense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ComptableDepenseController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        $depenses = Depense::orderBy('updated_at','desc')->get();
        return view('dashboard.comptable.depense.all-depense', compact('depenses'));
    }

    public function create()
    {
        // return view('dashboard.comptable.depense.add-depense');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'designation' => 'required|min:2',
            'montant' => 'required|min:2',
        ]);
        
        $depense = Depense::create([
            'date' => date('d/m/Y H:i'),
            'montant' => $request->montant ,
            'designation' => $request->designation ,
            'motif' => null,
            'comptable_id' => auth()->user()->id
        ]);

        //données
            $noms = $depense->designation ;
        //

        return redirect()->route('comptable.depense.index')->with('success', "$noms ajouté avec succès");
    }

    public function edit(depense $depense)  
    {
        // return view('dashboard.comptable.depense.edit-depense', compact('depense'));
    }

    public function update(Request $request, depense $depense)
    {
        //données
            $noms = $depense->designation ;
        //

        $this->validate($request, [
            'designation' => 'required|min:2',
            'montant' => 'required|min:2',
        ]);
        
        $depense->update($request->post());
        
        return back()->with('success', "$noms modifié avec succès");
    }

    public function destroy(depense $depense)
    {
        //données
            $noms = $depense->designation ;
        //
        $depense->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
}
