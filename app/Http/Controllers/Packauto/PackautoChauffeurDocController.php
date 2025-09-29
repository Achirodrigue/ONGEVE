<?php

namespace App\Http\Controllers\Packauto;

use App\Models\Pchauffeur;
use Illuminate\Http\Request;
use App\Models\Pchauffeurdoc;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PackautoChauffeurDocController extends Controller
{
    public function chauffeurDocumentStore(Request $request, Pchauffeur $pchauffeur)
    {
        $request->validate([
            'date_expiration' => 'required|min:1',
            'fichier' => 'required|mimes:png,jpg,jpeg,pdf',
            'pchauffeurdocname_id' => 'required|min:1',
        ]);

        // Sauvegarde d'images
            $fichier = null;
            if($request->hasFile('fichier')){ $fichier = storeImage($request->file('fichier'), "ChauffeurDocument"); }  
        //

        // Création du vehicule
            $pchauffeurdoc = Pchauffeurdoc::create([
                'date_expiration' => $request->date_expiration,
                'fichier' => $fichier,
                'pchauffeur_id' => $pchauffeur->id,
                'pchauffeurdocname_id' => $request->pchauffeurdocname_id,
            ]);
        //

        return back()->with('success', "Nouveau document ajouté avec succès");
    }

    public function chauffeurDocumentUpdate(Request $request, Pchauffeurdoc $pchauffeurdoc)
    {
        $request->validate([
            'date_expiration' => 'required|min:1',
            'fichier' => 'required|mimes:png,jpg,jpeg,pdf',
        ]);

        // Sauvegarde d'images
            // Stocker les anciennes images
            $fichier = $pchauffeurdoc->fichier;
        
            // Mise à jour des images si nouvelles versions fournies
            if ($request->hasFile('fichier')) {
                if($pchauffeurdoc->fichier){ Storage::disk('public')->delete($pchauffeurdoc->fichier); } 
                $fichier = storeImage($request->file('fichier'), "ChauffeurDocument");
            }
        //

        $noms = $pchauffeurdoc->pchauffeurdocname->nom;
        $pchauffeurdoc->update($request->post());
        $pchauffeurdoc->update([
            'fichier' => $fichier,
        ]);

        return back()->with('success', "$noms modifié avec succès");
    }

    public function chauffeurDocumentDestroy( Pchauffeurdoc $pchauffeurdoc)
    {
        $noms = $pchauffeurdoc->pchauffeurdocname->nom;
        if($pchauffeurdoc->fichier){ Storage::disk('public')->delete($pchauffeurdoc->fichier); }  
        $pchauffeurdoc->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
}
