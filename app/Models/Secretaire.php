<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Secretaire extends Authenticatable
{
    use HasFactory;

    protected $guard = "secretaire";

    protected $fillable = [
        'nom',
        'prenom',
        'contact',
        'email',
        'isvalide',
        'photo',
        'statut',
        'connexion',
        'identifiant',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
