<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Commercial extends Authenticatable
{
    use HasFactory;

    protected $guard = "commercial";

    protected $fillable = [
        'nom',
        'prenom',
        'contact',
        'email',
        'premise',
        'isvalide',
        'statut',
        'photo',
        'role',
        'connexion',
        'identifiant',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthIdentifierName()
    {
        return 'identifiant';
    }

    //client
        public function clients()
        {
            return $this->hasMany('App\Models\Client');
        }
    //
    //particulier
        public function particuliers()
        {
            return $this->hasMany('App\Models\Particulier');
        }
    //

    //Client devis
        public function clientdevis()
        {
            return $this->hasMany('App\Models\Clientdevis');
        }
    //
    //particulier devis
        public function particulierdevis()
        {
            return $this->hasMany('App\Models\Particulierdevis');
        }
    //

    //Client remise
        public function clientremises()
        {
            return $this->hasMany('App\Models\Clientremise');
        }
        public function clientdevisremises()
        {
            return $this->hasMany('App\Models\Clientdevisremise');
        }
    //

    //Particulier remise
        public function particulierremises()
        {
            return $this->hasMany('App\Models\Particulierremise');
        }
    //
    
}