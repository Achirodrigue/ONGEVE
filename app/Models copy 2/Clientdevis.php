<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevis extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_devis',
        'delai_livraison',
        'tva',
        'total_ttc',
        'frais',
        'etat',
        'isvalide',
        'livraison',
        'paye',
        'motif_rejet',
        'client_id',
        'commercial_id',
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
