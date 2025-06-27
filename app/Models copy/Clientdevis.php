<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevis extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_devis',
        'date_expiration',
        'condition_validite',
        'mode_paiement',
        'delai_livraison',
        'note_condition',
        'total_ttc',
        'frais',
        'etat',
        'isvalide',
        'client_id',
    ];

    //Client devis produit
        public function clientdevisprods()
        {
            return $this->hasMany('App\Models\Clientdevisprod');
        }
    //

    //Client
        public function client()
        {
            return $this->belongsTo('App\Models\Client');
        }
    //
}
