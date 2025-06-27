<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevis extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_devis',
        'tva',
        'frais',
        'total_ttc',
        'delai_livraison',
        
        'remise',
        'motif',
        
        'TD',
        'client_id',
        'commercial_id',
    ];

    //Client devis produit
        public function clientdevisprods()
        {
            return $this->hasMany('App\Models\Clientdevisprod');
        }
    //

    //Client devis remise
        public function clientdevisremise()
        {
            return $this->hasOne('App\Models\Clientdevisremise');
        }
    //

    //Client
        public function client()
        {
            return $this->belongsTo('App\Models\Client');
        }
    //

    //Client devis info
        public function clientdevisinfo()
        {
            return $this->hasOne('App\Models\Clientdevisinfo');
        }
    //
}
