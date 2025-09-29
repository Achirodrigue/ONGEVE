<?php

namespace App\Http\Controllers\Ressource\Colaborateur;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RessourcePagesController extends Controller
{
    use ValidatesRequests;

    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('ressource.login'));
    }
}
