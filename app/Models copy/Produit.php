<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'image',
        'description',
        'prix',
        'promo',
        'stock',
        'qtyStock',
        'reference',
        'isvalide',
        'etat',
        'mvente',
        'categorie_id',
    ];
    

    //categorie
        public function categorie()
        {
            return $this->belongsTo('App\Models\Categorie');
        }
    //

    //Client devis produit
        public function clientdevisprods()
        {
            return $this->hasMany('App\Models\Clientdevisprod');
        }
    //
    
    //Produit ES
        public function produitse()
        {
            return $this->hasOne('App\Models\Produitse');
        }
    //
    
    //Produit stat
        public function produitstat()
        {
            return $this->hasOne('App\Models\Produitstat');
        }
    //
}
