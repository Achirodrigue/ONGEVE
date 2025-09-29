<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseurfactureprod extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'prix_unitaire',
        'prix_total',
        'produit_id',
        'fournisseurfacture_id',
    ];

    //
        public function fournisseurfacture()
        {
            return $this->belongsTo('App\Models\Fournisseurfacture');
        }
    //

    //
        public function produit()
        {
            return $this->belongsTo('App\Models\Produit');
        }
    //
}
