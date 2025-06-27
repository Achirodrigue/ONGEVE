<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produitstat extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_min',
        'entree',
        'sortie',
        'produit_id'
    ];
    
    //produit
        public function produit(){
            return $this->belongsTo('App\Models\Produit');
        }
    //
}
