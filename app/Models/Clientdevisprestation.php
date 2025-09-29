<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevisprestation extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'unite',
        'nbre_passage',
        'quantite',
        'prix_unitaire',
        'prix_total',
        'clientdevis_id',
    ];

    //Client devis
        public function clientdevis()
        {
            return $this->belongsTo('App\Models\Clientdevis');
        }
        
        public function clientdevisavoirprestation()
        {
            return $this->hasOne('App\Models\Clientdevisavoirprestation');
        }
    //
}
