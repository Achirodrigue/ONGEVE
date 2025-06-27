<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'genre',
        'naissance',
        'contact',
        'email',
        'adresse_postale',
        'commercial_id',
    ];

    //commercial
        public function commercial()
        {
            return $this->belongsTo('App\Models\Commercial');
        }
    //
}
// Informations d’identification
// Nom complet 
// Genre (facultatif)

// Date de naissance 


// Numéro de téléphone (fixe et/ou mobile)

// Adresse email

// Adresse postale complète (quartier, ville, pays)