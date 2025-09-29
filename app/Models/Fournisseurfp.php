<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseurfp extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit',
        'quantite',
        'prix_unitaire',
        'prix_total',
        'unite',
        'produit_id',
        'fournisseurfacturecomptable_id',
    ];

    //
        public function produit()
        {
            return $this->belongsTo('App\Models\Produit');
        }
        public function fournisseurfacturecomptable()
        {
            return $this->belongsTo('App\Models\Fournisseurfacturecomptable');
        }
    //
}
