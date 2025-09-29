<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->withErrors([
            'email' => 'Erreur d’authentification.',
        ]);
    }

    return match ($user->role) {
        'RH' => redirect()->route('welcome'),      // redirige vers la route nommée 'welcome' = '/'
        'Employé' => redirect()->route('parcking'), // redirige vers dashboard
        'DG' => redirect('/index'), // adapte si besoin, ou crée une route nommée spécifique
        default => redirect()->route('menu'),
    };
}




    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
