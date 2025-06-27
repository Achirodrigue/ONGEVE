<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevisprod extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'unite',
        'prix_unitaire',
        'prix_total',
        'clientdevis_id',
        'produit_id',
    ];

    //Client devis
        public function clientdevis()
        {
            return $this->belongsTo('App\Models\Clientdevis');
        }
    //

    //produit devis
        public function produit()
        {
            return $this->belongsTo('App\Models\Produit');
        }
    //
}
