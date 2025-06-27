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

    //Client et particulier devis produit
        public function clientdevisprods()
        {
            return $this->hasMany('App\Models\Clientdevisprod');
        }
        public function particulierdevisprods()
        {
            return $this->hasMany('App\Models\Particulierdevisprod');
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
