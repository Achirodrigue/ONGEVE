<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Comptable extends Authenticatable
{
    use HasFactory;

    protected $guard = "comptable";

    protected $fillable = [
        'nom',
        'prenom',
        'contact',
        'email',
        'isvalide',
        'photo',
        'statut',
        'role',
        'connexion',
        'identifiant',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    //
        public function fournisseurs()
        {
            return $this->hasMany('App\Models\Fournisseur');
        }
    //
}