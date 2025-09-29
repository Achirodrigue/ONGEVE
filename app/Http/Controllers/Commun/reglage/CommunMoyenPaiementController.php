<?php

namespace App\Http\Controllers\Commun\reglage;


use App\Models\Moyenpay;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CommunMoyenPaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // $moyenpays = Moyenpay::orderBy('updated_at','desc')->get();
        // return  view('dashboard.comptable.reglage.moyen-paiement', compact('moyenpays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('dashboard.geststock.entrepot.add-entrepot');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|unique:moyenpays|min:3'
        ]);

        $moyenpay = Moyenpay::create([
            'nom' => $request->nom
        ]);
            
        return back()->with('success', "$moyenpay->nom ajouté avec succès");
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
    public function edit(Moyenpay $moyenpay)     //(string $id)
    {
        // return view('dashboard.geststock.entrepot.edit-entrepot', compact('moyenpay'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Moyenpay $moyenpay)
    {
        $this->validate($request, [
            'nom' => [
                'required',
                'min:3',
                Rule::unique('moyenpays', 'nom')->ignore($moyenpay->id),
            ],
        ]);
        
        $noms = $moyenpay->nom;
        $moyenpay->update($request->post());
        return back()->with('success', "$noms modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Moyenpay $moyenpay)
    {
        $noms = $moyenpay->nom;
        $moyenpay->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
}
