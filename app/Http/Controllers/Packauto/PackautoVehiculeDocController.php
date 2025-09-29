<?php

namespace App\Http\Controllers\Packauto;

use App\Models\Pvehicule;
use Illuminate\Http\Request;
use App\Models\Pvehiculedoc;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PackautoVehiculeDocController extends Controller
{
    public function vehiculerDocumentStore(Request $request, Pvehicule $pvehicule)
    {
        $request->validate([
            'date_expiration' => 'required|min:1',
            'fichier' => 'required|mimes:png,jpg,jpeg,pdf',
            'pvehiculedocname_id' => 'required|min:1',
        ]);
        
        // Sauvegarde d'images
            $fichier = null;
            if($request->hasFile('fichier')){ $fichier = storeImage($request->file('fichier'), "VehiculeDocument"); }  
        //

        // Création du vehicule
            $pvehiculedoc = Pvehiculedoc::create([
                'date_expiration' => $request->date_expiration,
                'fichier' => $fichier,
                'pvehicule_id' => $pvehicule->id,
                'pvehiculedocname_id' => $request->pvehiculedocname_id,
            ]);
        //

        return back()->with('success', "Nouveau document ajouté avec succès");
    }

    public function vehiculerDocumentUpdate(Request $request, Pvehiculedoc $pvehiculedoc)
    {
        $request->validate([
            'date_expiration' => 'required|min:1',
            'fichier' => 'required|mimes:png,jpg,jpeg,pdf',
        ]);

        // Sauvegarde d'images
            // Stocker les anciennes images
            $fichier = $pvehiculedoc->fichier;
        
            // Mise à jour des images si nouvelles versions fournies
            if ($request->hasFile('fichier')) {
                if($pvehiculedoc->fichier){ Storage::disk('public')->delete($pvehiculedoc->fichier); } 
                $fichier = storeImage($request->file('fichier'), "VehiculeDocument");
            }
        //

        $noms = $pvehiculedoc->pvehiculedocname->nom;
        $pvehiculedoc->update($request->post());
        $pvehiculedoc->update([
            'fichier' => $fichier,
        ]);

        return back()->with('success', "$noms modifié avec succès");
    }

    public function vehiculerDocumentDestroy( Pvehiculedoc $pvehiculedoc)
    {
        $noms = $pvehiculedoc->pvehiculedocname->nom;
        if($pvehiculedoc->fichier){ Storage::disk('public')->delete($pvehiculedoc->fichier); }  
        $pvehiculedoc->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
}
