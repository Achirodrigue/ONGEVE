<?php

namespace App\Http\Controllers\Admin;

use App\Models\Formateur;
use App\Models\Formation;
use App\Models\Pformation;
use Illuminate\Http\Request;
use App\Models\Formationformateur;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\FonctionPersonnelle\FonctionPersonnelle;

class AdminFormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations = Formation::where('affecte', 0)->where('terminer', 0)->orderBy('updated_at','desc')->paginate(15);
        $formateurs = Formateur::where('isvalide', 1)->orderBy('nom','asc')->get();
        return view ('dashboard.admin.formation.all-formation-encours', compact('formations','formateurs'));
    }

    public function formationFormateurEncours()
    {
        $formationformateurs = Formationformateur::where('isvalide', 0)->orderBy('created_at','asc')->get();
        return view('dashboard.admin.formation.formation-formateur-encours', compact('formationformateurs'));
    }

    public function formationFinalise()
    {
        //dd(5);
        $formations = Formation::where('affecte', 1)->where('terminer', 1)->orderBy('updated_at','desc')->paginate(15);
        $formateurs = Formateur::where('isvalide', 1)->orderBy('nom','asc')->get();
        return view ('dashboard.admin.formation.all-formation-termine', compact('formations','formateurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        return view ('dashboard.admin.formation.add-formation');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        $this->validate($request, [
            'nom'   => 'required|min:4',
            'description'   => 'required|min:4',
            'lieu'   => 'required|min:4',
            'prix'   => 'required|min:4',
            'date_debut'   => 'required|min:4',
            'date_fin'   => 'required|min:4',
            'heure'   => 'required|min:4',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        if (!empty($request->image))
        {
            $filename = time() . '.' . $request->image->extension();
            $image = $request->file('image')->storeAs(
                'FormationImage', $filename, 'public'
            );
        }
        else{
            return back()->with('error',"Veillez entrer une image svp.");
        }

        $formation = Formation::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'lieu' => $request->lieu,
            'prix' => $request->prix,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'heure' => $request->heure,
            'image' => $image,
            'affecte' => 0,
            'isvalide' => 1
        ]);

        $nom = $request->nom;
        return redirect()->route('admin.formation.index')->with('success',"Formation en $formation->nom créer avec succès");
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
    public function edit(Formation $formation) //string $id
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        return view ('dashboard.admin.formation.edit-formation', compact('formation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formation $formation) //string $id
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        //donnée
            $nom = $formation->nom;
        //

        $this->validate($request, [
            'nom'   => 'required|min:4',
            'description'   => 'required|min:4',
            'lieu'   => 'required|min:4',
            'prix'   => 'required|min:4',
            // 'date_debut'   => 'required|min:4',
            // 'date_fin'   => 'required|min:4',
            'heure'   => 'required|min:4',
        ]);

        if (!empty($request->image))
        {
            $this->validate($request, [
                'image' => 'required|mimes:png,jpg,jpeg',
            ]);

            Storage::disk('public')->delete($formation->image);
            $filename = time() . '.' . $request->image->extension();
            $image = $request->file('image')->storeAs(
                'FormationImage', $filename, 'public'
            );
        }
        else{
            $image = $formation->image;
        }

        $formation->update([
            'image' => $image
        ]);
        
        $formation->update($request->post());

        return redirect()->route('admin.formation.index')->with('success',"Formation en $nom modifiée avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation) //string $id
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        $nom = $formation->nom;

        if ($formation->pformations()->count() > 0)
        {
            return back()->with('error','Desolé! Impossible de supprimer cette formation car des inscriptions ont déjà eu lieu.');
        }
        else
        {
            Storage::disk('public')->delete($formation->image);
            $formation->delete();
            return redirect()->route('admin.formation.index')->with('success', "Formation en $nom supprimée avec succès");
        }
    }
    
    public function postulationFormationDestroy(Pformation $pformation) //string $id
    {
        if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
            return $redirect;
        }

        $nom = $pformation->nom.' '.$pformation->prenom;
    
        $pformation->delete();
        return back()->with('success', "Postulation de $nom supprimée avec succès");

    }

    //affectation, finalisation formateur formation  
        public function affectationFormateurStore(Request $request, Formation $formation)
        {
            if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
                return $redirect;
            }

            $this->validate($request, [
                'formateur_id' => 'required|min:1'
            ]);

            // dd(4);

            $formationformateur = Formationformateur::create([
                'formation_id' => $formation->id,
                'formateur_id' => $request->formateur_id,
                'isvalide' => 0,
            ]);

            $formation->update([
                'affecte' => 1,
            ]);
                
            return redirect()->route('admin.formation.formateur.encours')->with('success', "Formation $formation->nom affecté avec succès");
        } 
        public function confirmationFormationFinaliserStore(Request $request, Formation $formation)
        {
            if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
                return $redirect;
            }

            $formation->formationformateur->update([
                'isvalide' => 1,
            ]);

            $formation->update([
                'terminer' => 1,
            ]);
                
            return redirect()->route('admin.formation.formateur.encours')->with('success', "Formation $formation->nom finalisé avec succès");
        }
    //
    
    //post formation
        public function postulationFormation(Formation $formation)
        {
            $formateurs = Formateur::where('isvalide', 1)->orderBy('nom','asc')->get();
            
            if($formation->pformations->count() > 0)
            {        
                return view('dashboard.admin.formation.postulation-formation', compact('formation','formateurs'));
            }

            return back()->with("error", "Désolé! aucune postulation disponible pour la formation $formation->nom");
        }
    //

    //action
        public function etatFormationUpdate(Formation $formation)
        {
            if ($redirect = FonctionPersonnelle::pageAccessibleAdmin()) {
                return $redirect;
            }

            //donnée
                $noms = $formation->nom;
            //

            $formation->update([
                'isvalide' => !$formation->isvalide
            ]);

            //dd($formation->isvalide);
            if($formation->isvalide)
            {
                return back()->with('success', "$noms : activé avec succès");
            }
            else
            {
                return back()->with('success', "$noms désactivé avec succès");
            }

        }
    //
 //
}
