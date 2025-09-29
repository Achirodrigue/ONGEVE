<?php

namespace App\Http\Controllers\Comptable\reglage;


use App\Models\Delaipay;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ComptableDelaipayController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $delaipays = Delaipay::orderBy('updated_at','desc')->get();
        return  view('dashboard.comptable.reglage.delai-paiement', compact('delaipays'));
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
            'delaipay' => 'required|unique:delaipays|min:3'
        ]);

        $Delaipay = Delaipay::create([
            'delaipay' => $request->delaipay
        ]);
            
        return back()->with('success', "$Delaipay->nom ajouté avec succès");
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
    public function edit(Delaipay $delaipay)     //(string $id)
    {
        // return view('dashboard.geststock.entrepot.edit-entrepot', compact('delaipay'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delaipay $delaipay)
    {
        $this->validate($request, [
            'delaipay' => [
                'required',
                'min:3',
                Rule::unique('delaipays', 'delaipay')->ignore($delaipay->id),
            ],
        ]);
        
        $noms = $delaipay->delaipay;
        $delaipay->update($request->post());
        return redirect()->route('comptable.delaipay.index')->with('success', "$noms modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delaipay $delaipay)
    {
        $noms = $delaipay->delaipay;
        $delaipay->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
}
