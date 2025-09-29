<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produitvendu extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'clientdevisprod_id',
        'produit_id',
    ];
    
    //produit
        public function produit(){
            return $this->belongsTo('App\Models\Produit');
        }
        public function clientdevisprod(){
            return $this->belongsTo('App\Models\Clientdevisprod');
        }
    //
}
