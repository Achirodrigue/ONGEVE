<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

    $validated = $request->validate([
        'nom' => 'required|string|max:100',
        'prenoms' => 'nullable|string|max:150',
        'email' => 'required|email|max:100|unique:users,email,' . $user->id,
        'poste' => 'nullable|string|max:255',
        'departement' => 'nullable|string|max:255',
        'date_embauche' => 'nullable|date',
        'genre' => 'nullable|in:Homme,Femme,Autre',
        'telephone' => 'nullable|string|max:20',
        'adresse' => 'nullable|string',
        'date_naissance' => 'nullable|date',
        'photo_profil' => 'nullable|image|max:2048',
    ]);

    // Si une nouvelle photo a été uploadée
    if ($request->hasFile('photo_profil')) {
        $path = $request->file('photo_profil')->store('photos', 'public');
        $validated['photo_profil'] = $path;
    }

    $user->update($validated);

    return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
