<?php

namespace App\Http\Controllers\Packauto;

use App\Models\Pvehicule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Paffectation;
use Illuminate\Support\Facades\Storage;

class PackautoEmpruntAffectationController extends Controller
{
    //Emprunt
        public function empruntEnAttente()
        {
            $paffectations = Paffectation::where('etat', 0)->where('type', 0)->orderBy('updated_at','desc')->get();
            return view('dashboard.packauto.emprunt-affectation.emprunt.emprunt-en-attente', compact('paffectations'));
        }
        public function empruntEncours()
        {
            $paffectations = Paffectation::where('etat', 1)->where('type', 0)->where('statut', 0)->orderBy('updated_at','desc')->get();
            return view('dashboard.packauto.emprunt-affectation.emprunt.emprunt-encours', compact('paffectations'));
        }
        public function empruntGeneral()
        {
            $paffectations = Paffectation::where('etat', 1)->where('type', 0)->where('statut', 1)->orderBy('updated_at','desc')->get();
            return view('dashboard.packauto.emprunt-affectation.emprunt.emprunt-general', compact('paffectations'));
        }
    //

    //Affectation
        public function affectationEncours()
        {
            $paffectations = Paffectation::where('type', 1)->where('statut', 0)->orderBy('updated_at','desc')->get();
            return view('dashboard.packauto.emprunt-affectation.affectation.affectation-encours', compact('paffectations'));
        }
        public function affectationGeneral()
        {
            $paffectations = Paffectation::where('type', 1)->where('statut', 1)->orderBy('updated_at','desc')->get();
            return view('dashboard.packauto.emprunt-affectation.affectation.affectation-general', compact('paffectations'));
        }
    //
    
    //opération
        public function approuveEmprunt(Request $request, Paffectation $paffectation)
        {
            if ($paffectation->etat == 1) {
                $texte = "refusé avec succes";
            }else{
                $texte = "approuvé avec succes";
            }

            $noms = $paffectation->pchauffeur->nom." ".$paffectation->pchauffeur->prenom;
            $paffectation->update(['etat' => !$paffectation->etat]);

            return back()->with('success', "Emprunt de $noms $texte.");
        }
        public function clotureEmprunt(Request $request, Paffectation $paffectation)
        {
            if ($paffectation->statut == 1) {
                return back()->with('error', "Cet emprunt est déjà finalisé.");
            }

            $noms = $paffectation->pchauffeur->nom." ".$paffectation->pchauffeur->prenom;
            $paffectation->update(['statut' => 1]);

            return back()->with('success', "Emprunt de $noms finalisé avec succes.");
        }
    //


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
    
    public function update(Request $request, Paffectation $paffectation)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin'   => 'nullable|date|after_or_equal:date_debut',
            'mission' => 'required|min:2',
            'pchauffeur_id' => 'required|exists:pchauffeurs,id',
            // 'employe_id' => 'required|exists:employes,id',
            'pvehicule_id' => 'required|exists:pvehicules,id',
        ], [
            'date_fin.after_or_equal' => 'La date de fin doit être supérieure ou égale à la date de début.',
        ]);
        
        // modifier l'emprunt
        $noms = $paffectation->pchauffeur->nom." ".$paffectation->pchauffeur->prenom;
        $paffectation->update($request->post());

        return back()->with('success', "Emprunt de $noms modifié avec succes.");
    }

    public function destroy(Paffectation $paffectation)
    {
        $noms = "Emprunt de ".$paffectation->pchauffeur->nom." ".$paffectation->pchauffeur->prenom." du ".$paffectation->created_at->format('d/m/Y H:i');
        $paffectation->delete();
        return back()->with('success',  "$noms supprimé avec succès");
    }
}
