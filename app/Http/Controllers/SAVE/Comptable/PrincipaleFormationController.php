<?php

namespace App\Http\Controllers\Principale;

use App\Models\Formation;
use App\Models\Pformation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;


class PrincipaleFormationController extends Controller
{
    use ValidatesRequests;

    public function allFormation()
    {
        $formations = Formation::orderBy('updated_at','desc')->where('isvalide', 1)->where('terminer', 0)->paginate(20);
        return view ('principale.formation.all-formation', compact('formations'));
    }

    public function postFormation(Formation $formation)
    {
        return view ('principale.formation.post-formation', compact('formation'));
    }

    public function postFormationStore(Request $request, Formation $formation)
    {
        $this->validate($request, [
            'contact'   => 'required|min:8|max:12',
            'email'   => 'required|email|min:8',
            'nom'   => 'required|min:4',
            'prenom'   => 'required|min:4',
            'adresse'   => 'required|min:4',
        ]);

        $pformation = Pformation::create([
            'nom' => $request->nom ,
            'prenom' => $request->prenom ,
            'contact' => $request->contact ,
            'email' => $request->email ,
            'adresse' => $request->adresse,
            'formation_id' => $formation->id,
        ]);

        $noms = $pformation->nom.' '.$pformation->prenom ;

        return redirect()->route('all.formation')->with('success', "$noms : votre inscription à bien été enregistré avec succes. Nous vous contacterons bientôt.");
    }
}