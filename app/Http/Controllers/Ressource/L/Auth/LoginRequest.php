<?php

namespace App\Http\Requests\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;  // Autoriser la requête
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function authenticate()
    {
         $credentials = $this->only('email', 'password');
    Log::info('Tentative connexion avec:', $credentials);

    if (! Auth::attempt($credentials, $this->boolean('remember'))) {
        Log::warning('Auth attempt failed for email: ' . $credentials['email']);
        throw ValidationException::withMessages([
            'email' => __('Ces informations d\'identification ne correspondent pas à nos dossiers.'),
        ]);
    }
    }
}
