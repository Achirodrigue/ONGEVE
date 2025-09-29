<?php

namespace App\Http\Controllers\Geststock;


use App\Models\Entrepotcateg;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Categorie;

class GeststockEntrepotCategorieController extends Controller
{
    
    public function entrepotCategorieStoreUn(Request $request, Categorie $categorie)
    {
        $this->validate($request, [
            'categorieprod_id' => 'required|min:1'
        ]);

        $entrepotcateg = $categorie->entrepotcategs()->where('categorieprod_id', $request->categorieprod_id)->first();

        if($entrepotcateg)
        {
            return back()->with('error', "La catégorie choisie existe déjà dans l'entrepôt $categorie->nom");
        }

        $entrepotcateg = Entrepotcateg::create([
            'categorie_id' => $categorie->id,
            'categorieprod_id' => $request->categorieprod_id,
        ]);
            
        return redirect()->route('geststock.entrepot.categorie', compact('categorie'))->with('success', "Nouvelle categorie ajouté avec succès");
    }

    public function entrepotCategorieStoreDeux(Request $request)
    {
        $this->validate($request, [
            'categorie_id' => 'required|min:1',
            'categorieprod_id' => 'required|min:1'
        ]);

        $categorie = Categorie::findOrFail($request->categorie_id);
        $entrepotcateg = $categorie->entrepotcategs()->where('categorieprod_id', $request->categorieprod_id)->first();

        if($entrepotcateg)
        {
            return back()->with('error', "La catégorie choisie existe déjà dans l'entrepôt $categorie->nom");
        }

        $entrepotcateg = Entrepotcateg::create([
            'categorie_id' => $request->categorie_id,
            'categorieprod_id' => $request->categorieprod_id,
        ]);

        // $entrepot = $request->categorie_id;
            
        return redirect()->route('geststock.entrepot.categorie', compact('categorie'))->with('success', "Nouvelle categorie ajouté avec succès");
    }

    public function entrepotCategorieDestroy(Entrepotcateg $entrepotcateg)
    {
        $NP = $entrepotcateg->produits()->count();
        if($NP > 0)
        {
            return back()->with('error',"Désolé! vous ne pouvez pas supprimer une catégorie contenant déjà des produits.");
        }
        else
        {
            $entrepot = $entrepotcateg->categorie->nom;
            $categorieprod = $entrepotcateg->categorieprod->nom;
            $entrepotcateg->delete();
            return back()->with('success', "$categorieprod supprimé de l'entrepôt $entrepot avec succès");
        }
    }
}
