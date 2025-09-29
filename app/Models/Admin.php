<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard = "admin";

    protected $fillable = [
        'nom',
        'prenom',
        'contact',
        'email',
        'isvalide',
        'photo',
        'role',
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

    //admin secteur
        // public function adminsecteur()
        // {
        //     return $this->hasOne('App\Models\Adminsecteur');
        // }
    //
    
    //livreur
        // public function livreurs()
        // {
        //     return $this->hasMany('App\Models\Livreur');
        // }
    //