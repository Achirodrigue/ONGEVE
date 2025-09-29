<?php

namespace App\Http\Controllers;
use App\Models\Presence;
use App\Models\Employe;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
      public function presence()
    {
        $presences = Presence::with('employe')->whereDate('date', Carbon::today())->get();
        $employes = Employe::all();
        return view('presence', compact('presences', 'employes'));
    }
      public function formulaire()
    {
        $presences = Presence::with('employe')->whereDate('date', Carbon::today())->get();
        $employes = Employe::all();
        return view('presence-formulaire', compact('presences', 'employes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenoms' => 'required',
            'email' => 'required|email',
        ]);

        $employe = Employe::where('nom', $request->nom)
                          ->where('prenoms', $request->prenoms)
                          ->where('email', $request->email)
                          ->first();

        if (!$employe) {
            return back()->withErrors(['email' => 'Email incorrect pour cet employé.']);
        }

        $today = Carbon::today();
        $presence = Presence::firstOrNew([
            'employe_id' => $employe->id,
            'date' => $today
        ]);

        if (!$presence->exists) {
            // matin
            $presence->email = $request->email;
            $presence->heure_arrivee = Carbon::now()->format('H:i:s');
            $presence->save();
            return back()->with('success', 'Bienvenue M./Mme ' . $employe->nom);
        } elseif (is_null($presence->heure_depart)) {
            // soir
            $presence->heure_depart = Carbon::now()->format('H:i:s');
            $presence->save();
            return back()->with('success', 'Départ enregistré. Bonne soirée M./Mme ' . $employe->nom);
        } else {
            return back()->with('info', 'Présence déjà enregistrée pour aujourd\'hui.');
        }
    }
}
