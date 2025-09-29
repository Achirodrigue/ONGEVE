<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrepotcateg extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie_id',
        'categorieprod_id',
    ];

    //Categorie
        public function categorie()
        {
            return $this->belongsTo('App\Models\Categorie');
        }
    //

    //Categorie produit
        public function categorieprod()
        {
            return $this->belongsTo('App\Models\Categorieprod');
        }
    //

    //Produit
        public function produits()
        {
            return $this->hasMany('App\Models\Produit');
        }
    //
}
