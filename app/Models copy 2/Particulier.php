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
        'Pachat',
        'remise',
        'commercial_id',
    ];

    //commercial
        public function commercial()
        {
            return $this->belongsTo('App\Models\Commercial');
        }
    //

    //particulier devis
        public function particulierdevis()
        {
            return $this->hasMany('App\Models\Particulierdevis');
        }
    //
}
