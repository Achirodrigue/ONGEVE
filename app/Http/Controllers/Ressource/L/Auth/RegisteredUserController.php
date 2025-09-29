<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Affiche la vue d'inscription.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Gère la requête d'inscription.
     */
    public function store(Request $request): RedirectResponse
    {
$request->validate([
    'nom' => ['required', 'string', 'max:100'],
    'prenoms' => ['nullable', 'string', 'max:150'],
    'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
    'role' => ['required', 'in:DG,Administrateur,RH,Manager,Employé'],
    'poste' => ['nullable', 'string', 'max:255'],
    'departement' => ['nullable', 'string', 'max:255'],
    'genre' => ['nullable', 'in:Homme,Femme,Autre'],
    'telephone' => ['nullable', 'string', 'max:20'],
    'adresse' => ['nullable', 'string'],
    'date_naissance' => ['nullable', 'date'],
    'photo_profil' => ['nullable', 'image', 'max:2048'],
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
]);

$photoPath = null;
if ($request->hasFile('photo_profil')) {
    $photoPath = $request->file('photo_profil')->store('photos', 'public');
}

$user = User::create([
    'nom' => $request->nom,
    'prenoms' => $request->prenoms,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'role' => $request->role,
    'poste' => $request->poste,
    'departement' => $request->departement,
    'genre' => $request->genre,
    'telephone' => $request->telephone,
    'adresse' => $request->adresse,
    'date_naissance' => $request->date_naissance,
    'photo_profil' => $photoPath,
    'actif' => true,
]);

        event(new Registered($user));
        Auth::login($user);

        // Redirection selon rôle
        return match ($user->role) {
            'RH' => redirect('/'),
            'Employé' => redirect('parcking'),
            default => redirect('/menu'),
        };
    }
}
