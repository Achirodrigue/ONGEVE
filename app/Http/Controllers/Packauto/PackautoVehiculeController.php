<?php

namespace App\Http\Controllers\Packauto;

use App\Models\Pvehicule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PackautoVehiculeController extends Controller
{
    public function index()
    {
        $pvehicules = Pvehicule::orderBy('updated_at','desc')->get();
        return view('dashboard.packauto.vehicule.all-vehicule', compact('pvehicules'));
    }
    public function vehiculeDisponible()
    {
        // dd(5);
        $pvehicules = Pvehicule::where('statut','actif')->where('ES', 1)->orderBy('updated_at','desc')->get();
        return view('dashboard.packauto.vehicule.all-vehicule-disponible', compact('pvehicules'));
    }
    public function vehiculeEmprunte()
    {
        $pvehicules = Pvehicule::where('statut','actif')->where('ES', 0)->orderBy('updated_at','desc')->get();
        return view('dashboard.packauto.vehicule.all-vehicule-emprunte', compact('pvehicules'));
    }
    public function vehiculeMaintenance()
    {
        $pvehicules = Pvehicule::where('statut','maintenance')->orderBy('updated_at','desc')->get();
        return view('dashboard.packauto.vehicule.all-vehicule-maintenance', compact('pvehicules'));
    }
    
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'marque' => 'required|min:1',
            'modele' => 'required|min:1',
            'immatriculation' => 'required|unique:pvehicules|min:1',
            'annee' => 'nullable|min:1',
            'kilometrage' => 'nullable|min:1',
            'date_achat' => 'nullable|min:1',
            'statut' => 'required|in:actif,maintenance,vendu,accidenté',
            'photo' => 'nullable|mimes:png,jpg,jpeg,pdf',
            'pcategorievehicule_id' => 'required|min:1',
        ]);

        // Sauvegarde d'images
            $photo = null;
            if($request->hasFile('photo')){ $photo = storeImage($request->file('photo'), "VehiculePhoto"); }  
        //

        // Création du vehicule
            $pvehicule = Pvehicule::create([
                'marque' => $request->marque,
                'modele' => $request->modele,
                'immatriculation' => $request->immatriculation,
                'annee' => $request->annee,
                'kilometrage' => $request->kilometrage,
                'statut' => $request->statut,
                'date_achat' => $request->date_achat,
                'ES' => 1,
                'isvalide' => 1,
                'photo' => $photo,
                'pcategorievehicule_id' => $request->pcategorievehicule_id,
            ]);
        //

        return back()->with('success', "$pvehicule->marque ajouté avec succès");
    }

    public function show(Pvehicule $pvehicule)
    {
        return view('dashboard.packauto.vehicule.vehicule-document', compact('pvehicule'));
    }
    
    public function edit(string $id)
    {
        //
    }
    
    public function update(Request $request, Pvehicule $pvehicule)
    {
        $request->validate([
            'marque' => 'required|min:1',
            'modele' => 'required|min:1',
            // 'immatriculation' => 'required|unique|min:1',
            'immatriculation' => [
                'required',
                'min:3',
                Rule::unique('pvehicules', 'immatriculation')->ignore($pvehicule->id),
            ],
            'annee' => 'nullable|min:1',
            'kilometrage' => 'nullable|min:1',
            'date_achat' => 'nullable|min:1',
            'photo' => 'nullable|mimes:png,jpg,jpeg,pdf',
            'statut' => 'required|in:actif,maintenance,vendu,accidenté',
            'pcategorievehicule_id' => 'required|min:1',
        ]);

        // Sauvegarde d'images
            // Stocker les anciennes images
            $photo = $pvehicule->photo;
        
            // Mise à jour des images si nouvelles versions fournies
            if ($request->hasFile('photo')) {
                if($pvehicule->photo){ Storage::disk('public')->delete($pvehicule->photo); }  
                $photo = storeImage($request->file('photo'), "VehiculePhoto");
            }
        //

        $noms = $pvehicule->marque;
        $pvehicule->update($request->post());
        $pvehicule->update([
            'photo' => $photo,
        ]);

        return back()->with('success', "$noms ajouté avec succès");
    }

    public function destroy(Pvehicule $pvehicule)
    {
        $noms = $pvehicule->marque;
        if($pvehicule->photo){ Storage::disk('public')->delete($pvehicule->photo); }  
        $pvehicule->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }
}
