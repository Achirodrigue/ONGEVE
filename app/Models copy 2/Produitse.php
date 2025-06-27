<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produitse extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'entree_sortie',
        'produit_id',
    ];
    
    //produit
        public function produit(){
            return $this->belongsTo('App\Models\Produit');
        }
    //
}
