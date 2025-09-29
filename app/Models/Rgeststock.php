<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Rgeststock extends Authenticatable
{
    use HasFactory;

    protected $guard = "geststock";

    protected $fillable = [
        'nom',
        'prenom',
        'contact',
        'email',
        'role',
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

    //
        public function fournisseurfactures()
        {
            return $this->hasMany('App\Models\Fournisseurfacture');
        }
        public function clientdevis()
        {
            return $this->hasMany('App\Models\Clientdevis');
        }
    //
}
