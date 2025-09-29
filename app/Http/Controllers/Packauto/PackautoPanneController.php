<?php

namespace App\Http\Controllers\Packauto;

use App\Models\Ppanne;
use App\Models\Pvehicule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Pentretien;

class PackautoPanneController extends Controller
{
    //Panne
        public function panneEncours()
        {
            $ppannes = Ppanne::where('statut', 0)->orderBy('updated_at','desc')->get();
            return view('dashboard.packauto.panne.panne-en-attente', compact('ppannes'));
        }
        public function panneEntretenu()
        {
            $ppannes = Ppanne::where('statut', 1)->orderBy('updated_at','desc')->get();
            return view('dashboard.packauto.panne.panne-entretenu', compact('ppannes'));
        }
    //

    //opération
        public function panneAttester(Request $request, Ppanne $ppanne)
        {
            // dd($ppanne->id);
            $ppanne = Ppanne::findOrFail($ppanne->id);
            $request->validate([
                'date_entretien' => 'required|date',
                'description' => 'nullable|min:2',
                'cout' => 'required|numeric',
                'garage' => 'nullable|min:2',
                // 'pchauffeur_id' => 'required|exists:pchauffeurs,id',
                // 'employe_id' => 'required|exists:employes,id',
                // 'pvehicule_id' => 'required|exists:pvehicules,id',
                // 'ppanne_id' => 'required|exists:ppannes,id',
            ]);

            $pentretien = Pentretien::create([
                'description' => $request->description,
                'type' => null,
                'date_entretien' => $request->date_entretien,
                'kilometrage' => null,
                'cout' => $request->cout,
                'garage' => $request->garage,
                'ppanne_id' => $ppanne->id,
                'pvehicule_id' => $ppanne->pvehicule_id,
            ]);

            $ppanne->update(['statut' => 1]);

            if($ppanne->pchauffeur){$noms = $ppanne->pchauffeur->nom." ".$ppanne->pchauffeur->prenom;}
            else{$noms = auth()->user()->nom." ".auth()->user()->prenom;}

            return back()->with('success', "Panne signalé par $noms entretenu avec succes.");
        }
        public function panneAttesterUpdate(Request $request, Pentretien $pentretien)
        {
            // dd($request->description);
            $pentretien = Pentretien::findOrFail($pentretien->id);
            $request->validate([
                'date_entretien' => 'required|date',
                'description' => 'nullable|min:2',
                'cout' => 'required|numeric',
                'garage' => 'nullable|min:2',
            ]);

            $pentretien->update([
                'description' => $request->description,
                'type' => null,
                'date_entretien' => $request->date_entretien,
                'kilometrage' => null,
                'cout' => $request->cout,
                'garage' => $request->garage,
            ]);

            if($pentretien->ppanne->pchauffeur){$noms = $pentretien->ppanne->pchauffeur->nom." ".$pentretien->ppanne->pchauffeur->prenom;}
            else{$noms = auth()->user()->nom." ".auth()->user()->prenom;}

            return back()->with('success', "Entretien de la panne signalé par $noms modifié avec succes.");
        }
    //

    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        //
    }

    public function show(Pvehicule $pvehicule)
    {
        //
    }
    
    public function edit(string $id)
    {
        //
    }
    
    public function update(Request $request, Ppanne $ppanne)
    {
        $request->validate([
            'date_panne' => 'required|date',
            'description' => 'required|min:2',
            'pchauffeur_id' => 'nullable|exists:pchauffeurs,id',
            // 'employe_id' => 'required|exists:employes,id',
            'pvehicule_id' => 'required|exists:pvehicules,id',
        ]);
        
        // modifier l'emprunt
        if($ppanne->pchauffeur){$noms = $ppanne->pchauffeur->nom." ".$ppanne->pchauffeur->prenom;}
        else{$noms = auth()->user()->nom." ".auth()->user()->prenom;}
        
        $ppanne->update($request->post());

        return back()->with('success', "Panne signalé par $noms modifié avec succes.");
    }

    public function destroy(Ppanne $ppanne)
    {
        if($ppanne->pchauffeur){$noms = $ppanne->pchauffeur->nom." ".$ppanne->pchauffeur->prenom;}
        else{$noms = auth()->user()->nom." ".auth()->user()->prenom;}

        $nom = "Panne signalé par ".$noms." du ".$ppanne->created_at->format('d/m/Y H:i');
        $ppanne->delete();
        return back()->with('success',  "$nom supprimé avec succès");
    }
}
