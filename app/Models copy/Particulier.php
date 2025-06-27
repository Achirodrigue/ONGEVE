<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Particulier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'forme_juridique',
        'numero_identifie',
        'domaine',
        'siege_social',
        'contact',
        'email',
        'adresse',
        'commercial_id',
    ];

    //commercial
        public function commercial()
        {
            return $this->belongsTo('App\Models\Commercial');
        }
    //
}
// Informations générales sur l’entreprise
// nom complet de l’entreprise

// Forme juridique (SARL, SA, SAS, entreprise individuelle, etc.)

// Numéro d’identification (RCCM, SIREN, NIF ou équivalent selon le pays)



// Secteur d’activité (commerce, BTP, agroalimentaire, etc.)


// Adresse du siège social

// Adresse(s) secondaire(s)

// Téléphone fixe / mobile / fax

// Adresse email professionnelle