<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Particulierdevisprod extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'prix_unitaire',
        'prix_total',
        'particulierdevis_id',
        'produit_id',
    ];

    //Particulier devis
        public function particulierdevis()
        {
            return $this->belongsTo('App\Models\Particulierdevis');
        }
    //

    //produit devis
        public function produit()
        {
            return $this->belongsTo('App\Models\Produit');
        }
    //

    //Particulier remise
        public function particulierremise()
        {
            return $this->hasOne('App\Models\Particulierremise');
        }
    //
}
