<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projettache extends Model
{
    use HasFactory;

    protected $fillable = [
        'tache',
        'etat',
        'projet_id',
    ];
    
    //produit
        public function projet(){
            return $this->belongsTo('App\Models\Projet');
        }
    //
}
