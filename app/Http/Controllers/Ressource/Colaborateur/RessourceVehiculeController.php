<?php

namespace App\Http\Controllers\Ressource\Colaborateur;

use App\Models\Emprunt;
use App\Models\Vehicule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RessourceVehiculeController extends Controller
{
  public function index() {
    $vehicules = Vehicule::all();
    return view('vehicules.index', compact('vehicules'));
}

public function create() {
    return view('vehicules.create');
}

public function store(Request $request) {
    $data = $request->validate([
        'marque' => 'required',
        'modele' => 'required',
        'immatriculation' => 'required|unique:vehicules',
        'type' => 'nullable',
        'photo' => 'nullable|image'
    ]);

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('vehicules', 'public');
    }

    Vehicule::create($data);
    return redirect()->route('vehicules.index')->with('success', 'Véhicule ajouté');
}


public function qrParking() {
    return view('vehicules.qrjs');
}

public function emprunterForm($id) {
    $vehicule = Vehicule::findOrFail($id);
    return view('vehicules.emprunter', compact('vehicule'));
}

public function emprunter(Request $request, $id)
{
    $vehicule = Vehicule::findOrFail($id);

    $validated = $request->validate([
        // Informations de l’emprunteur
        'nom' => 'required|string',
        'prenom' => 'required|string',
        'email' => 'required|email',
        'motif' => 'nullable|string',

        // Contrôle véhicule
        'brakeOil' => 'nullable|in:correct,defective',
        'radiator' => 'nullable|in:correct,defective',
        'steeringOil' => 'nullable|in:correct,defective',
        'engineOil' => 'nullable|in:correct,defective',
        'wipers' => 'nullable|in:correct,defective',
        'mirrors' => 'nullable|in:correct,defective',
        'wheels' => 'nullable|in:correct,defective',
        'signaling' => 'nullable|in:correct,defective',
        'cleanliness' => 'nullable|in:correct,defective',
        'noDefect' => 'nullable|in:yes,no',

        // Observations
        'observations' => 'nullable|string',

        // Départ
        'departureTime' => 'nullable',
        'departureKm' => 'nullable|integer',
        'fuelLevelDeparture' => 'nullable|in:plein,3/4,1/2,1/4,reserve',
        'vehicleStateDeparture' => 'nullable|in:bon,moyen,mauvais',

        // Arrivée
        'arrivalTime' => 'nullable',
        'arrivalKm' => 'nullable|integer',
        'distanceTraveled' => 'nullable|integer',
        'fuelLevelArrival' => 'nullable|in:plein,3/4,1/2,1/4,reserve',
        'vehicleStateArrival' => 'nullable|in:bon,moyen,mauvais',
    ]);

    Emprunt::create([
        'vehicule_id' => $vehicule->id,

        'nom' => $validated['nom'],
        'prenom' => $validated['prenom'],
        'email' => $validated['email'],
        'motif' => $validated['motif'] ?? null,

        'brakeOil' => $validated['brakeOil'] ?? null,
        'radiator' => $validated['radiator'] ?? null,
        'steeringOil' => $validated['steeringOil'] ?? null,
        'engineOil' => $validated['engineOil'] ?? null,
        'wipers' => $validated['wipers'] ?? null,
        'mirrors' => $validated['mirrors'] ?? null,
        'wheels' => $validated['wheels'] ?? null,
        'signaling' => $validated['signaling'] ?? null,
        'cleanliness' => $validated['cleanliness'] ?? null,
        'noDefect' => $validated['noDefect'] ?? null,

        'observations' => $validated['observations'] ?? null,

        'departure_time' => $validated['departureTime'] ?? null,
        'departure_km' => $validated['departureKm'] ?? null,
        'fuel_departure' => $validated['fuelLevelDeparture'] ?? null,
        'state_departure' => $validated['vehicleStateDeparture'] ?? null,

        'arrival_time' => $validated['arrivalTime'] ?? null,
        'arrival_km' => $validated['arrivalKm'] ?? null,
        'distance_traveled' => $validated['distanceTraveled'] ?? null,
        'fuel_arrival' => $validated['fuelLevelArrival'] ?? null,
        'state_arrival' => $validated['vehicleStateArrival'] ?? null,

        'date_emprunt' => now()
    ]);

    // Marquer le véhicule comme indisponible
    $vehicule->disponible = false;
    $vehicule->save();

    return redirect()->route('vehicules.index')->with('success', 'Véhicule emprunté avec succès.');
}


public function parcking() {
    $vehiculesDispo = \App\Models\Vehicule::where('disponible', true)->count();
    $vehiculesNonDispo = \App\Models\Vehicule::where('disponible', false)->count();
    $totalVehicules = \App\Models\Vehicule::count();
    return view('/parcking', compact('vehiculesDispo','vehiculesNonDispo','totalVehicules'));
}

public function disponibles()
{
    $vehicules = Vehicule::where('disponible', true)->get();
    return view('vehicules.disponibles', compact('vehicules'));
}

public function indisponibles()
{
    $vehicules = Vehicule::where('disponible', false)->get();
    return view('vehicules.indisponibles', compact('vehicules'));
}


public function retourForm($id)
{
    $vehicule = Vehicule::findOrFail($id);
    $emprunt = $vehicule->emprunts()->latest()->first();

    return view('vehicules.retourner', compact('vehicule', 'emprunt'));
}

public function retourner(Request $request, $id)
{
    $request->validate([
        'arrivalTime' => 'required',
        'arrivalKm' => 'required|integer',
        'distanceTraveled' => 'required|integer',
        'fuelLevelArrival' => 'required',
        'vehicleStateArrival' => 'required',
    ]);

    $vehicule = Vehicule::findOrFail($id);
    $emprunt = $vehicule->emprunts()->latest()->first();

    $emprunt->update([
        'arrival_time' => $request->arrivalTime,
        'arrival_km' => $request->arrivalKm,
        'distance_traveled' => $request->distanceTraveled,
        'fuel_arrival' => $request->fuelLevelArrival,
        'state_arrival' => $request->vehicleStateArrival,
        'date_retour' => now(),
    ]);

    $vehicule->disponible = true;
    $vehicule->save();

    return redirect()->route('vehicules.index')->with('success', 'Véhicule retourné avec succès.');
}

}
