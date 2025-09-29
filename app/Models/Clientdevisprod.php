<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevisprod extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'prix_unitaire',
        'nbre_jour',
        'prix_total',
        'clientdevis_id',
        'produit_id',
    ];

    //Client devis
        public function clientdevis()
        {
            return $this->belongsTo('App\Models\Clientdevis');
        }
        
        public function clientdevisavoirprod()
        {
            return $this->hasOne('App\Models\Clientdevisavoirprod');
        }
    //

    //produit devis
        public function produit()
        {
            return $this->belongsTo('App\Models\Produit');
        }
        public function produitvendu()
        {
            return $this->hasOne('App\Models\Produitvendu');
        }
    //

    //Client devis remise
        public function clientdevisremise()
        {
            return $this->hasOne('App\Models\Clientdevisremise');
        }
    //

    //Client remise
        public function clientremise()
        {
            return $this->hasOne('App\Models\Clientremise');
        }
    //
}
