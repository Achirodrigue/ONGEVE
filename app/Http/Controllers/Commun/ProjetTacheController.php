<?php

namespace App\Http\Controllers\Commun;

use App\Models\Projet;
use App\Models\Projettache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ProjetTacheController extends Controller
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

    public function store(Request $request, )
    {
        //
    }

    public function edit(Fournisseur $fournisseur)  
    {
        // 
    }

    public function update(Request $request, Projettache $projettache)
    {
        $this->validate($request, [
            'tache'   => 'required|unique:projettaches,tache,' . $projettache->id . '|min:2'
        ]);
        
        $projettache->update($request->post());
        
        return back()->with('success', "Tache modifié avec succès");
    }

    public function destroy(Projettache $projettache)
    {
        $projettache->delete();
        return back()->with('success', "Tache supprimé avec succès");
    }

    public function projetTacheStore(Request $request, Projet $projet)
    {
        $this->validate($request, [
            'tache' => 'required|min:2',
        ]);
        
        $projettache = Projettache::create([
            'tache' => $request->tache,
            'etat' => 0,
            'projet_id' => $projet->id ,
        ]);

        return back()->with('success', "nouvelle tache ajouté avec succès");
    }

    // public function projetTacheEtatUpdate(Request $request, Projet $projet)
    // {
    //     // dd($request->projettache);
    //     // if(count($request->projettache) > 0)
    //     // {
    //         foreach($request->projettache as $projettaches)
    //         {
    //             $projettache = Projettache::findOrFail($projettaches)->first();
    //             if(!$projettache->etat)
    //             {
    //                 $projettache->update([
    //                     'etat' => !$projettache->etat,
    //                 ]);
    //             }
    //             // dd($projettache->id);
    //         }
    //         $projetAllTaches = $projet->projettaches()->get()->except($request->projettache);
    //         // dd($projetAllTaches->count());
    //         // dd($projetAllTaches);
    //         if($projetAllTaches->count() > 0)
    //         {
    //             foreach($projetAllTaches as $projetAllTache)
    //             {
    //                 $projetAllTache->update([
    //                     'etat' => 0,
    //                 ]);
    //             }
    //         }

    //         return back()->with('success', "Modification des taches effectuées avec succès");
    //     // }

    //     // return back()->with('success', "Desolé! Aucune modification des taches n'a été effectué");
    // }

    public function projetTacheEtatUpdate(Request $request, Projet $projet) 
    {
        // Récupère les IDs des tâches cochées
        $tachesSelectionnees = $request->input('projettache', []); // tableau ou vide si rien coché

        // Met toutes les tâches du projet à 0 par défaut
        foreach ($projet->projettaches as $tache) {
            $etat = in_array($tache->id, $tachesSelectionnees) ? 1 : 0;
            $tache->update(['etat' => $etat]);
        }

        return back()->with('success', "Modification des tâches effectuée avec succès");
    }

}
