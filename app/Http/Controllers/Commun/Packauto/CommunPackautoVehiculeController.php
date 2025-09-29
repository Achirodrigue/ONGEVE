<?php

namespace App\Http\Controllers\Commun\Packauto;

use Carbon\Carbon;
use App\Models\Ppanne;
use App\Models\Employe;
use App\Models\Pvehicule;

use App\Models\Pchauffeur;
use App\Models\Paffectation;
use Illuminate\Http\Request;
use App\Models\Employepresence;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CommunPackautoVehiculeController extends Controller
{
    // use ValidatesRequests;
    
    //Vehicule emprunt et panne
        public function empruntVehiculeGenerale()
        {
            return view('dashboard.principale.vehicule.emprunt-VG');
        }
        public function empruntVehicule(Pvehicule $pvehicule)
        {
            return view('dashboard.principale.vehicule.emprunt-V', compact('pvehicule'));
        }
        public function empruntVehiculeStore(Request $request)
        {
            $request->validate([
                'date_debut' => 'required|date',
                'date_fin'   => 'nullable|date|after_or_equal:date_debut',
                'mission' => 'required|min:2',
                'email' => 'required|email',
                'pchauffeur_id' => 'required|exists:pchauffeurs,id',
                // 'employe_id' => 'required|exists:employes,id',
                'pvehicule_id' => 'required|exists:pvehicules,id',
            ], [
                'date_fin.after_or_equal' => 'La date de fin doit être supérieure ou égale à la date de début.',
            ]);
            
            // Récupérer l'employé ou le chauffeur
            // $employe = Employe::findOrFail($request->employe_id);
            $pchauffeur = Pchauffeur::findOrFail($request->pchauffeur_id);

            if ($pchauffeur) {
                if ($pchauffeur->email !== $request->email) {
                    return back()->with('error', 'Email incorrect pour cet chauffeur');
                }
            }else{
                return back()->with('error', "Désolé! chauffeur introuvable.");
            }

            // Enregistrer l'emprunt
            $paffectation = Paffectation::create([
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
                'mission' => $request->mission,

                'etat' => 0,
                'type' => 0,
                'statut' => 0,

                'employe_id' => null,
                'pchauffeur_id' => $pchauffeur->id,
                'pvehicule_id' => $request->pvehicule_id,
            ]);

            $noms = "$pchauffeur->nom $pchauffeur->prenom";

            return back()->with('success', "M./Mme $noms, votre emprunt a bien été enregistré avec succes.");
        }

        public function panneVehiculeGenerale()
        {
            return view('dashboard.principale.vehicule.panne-VG');
        }
        public function panneVehicule(Pvehicule $pvehicule)
        {
            return view('dashboard.principale.vehicule.panne-V', compact('pvehicule'));
        }
        public function panneVehiculeStore(Request $request)
        {
            // dd($request->pchauffeur_id);

            $request->validate([
                'date_panne' => 'required|date',
                'description' => 'required|min:2',
                'email' => 'nullable|email',
                'pchauffeur_id' => 'nullable|exists:pchauffeurs,id',
                // 'employe_id' => 'required|exists:employes,id',
                'pvehicule_id' => 'required|exists:pvehicules,id',
            ]);

            $noms = null;

            if($request->pchauffeur_id){
                $request->validate([
                    'email' => 'required|email',
                ]);

                // Récupérer l'employé ou le chauffeur
                    $pchauffeur = Pchauffeur::findOrFail($request->pchauffeur_id);

                    if ($pchauffeur) {
                        if ($pchauffeur->email !== $request->email) {
                            return back()->with('error', 'Email incorrect pour cet chauffeur');
                        }
                    }else{
                        return back()->with('error', "Désolé! chauffeur introuvable.");
                    }

                    $noms = "M./Mme $pchauffeur->nom $pchauffeur->prenom, ";
                //
            }

            // Enregistrer l'emprunt
            $ppanne = Ppanne::create([
                'description' => $request->description,
                'date_panne' => $request->date_panne,
                'cout' => null,
                'statut' => 0,
                // 'employe_id' => null,
                'pchauffeur_id' => $request->pchauffeur_id,
                'pvehicule_id' => $request->pvehicule_id,
            ]);

            return back()->with('success', "{$noms}votre signalisation de panne a bien été enregistré avec succes.");
           
        }
    //
}
