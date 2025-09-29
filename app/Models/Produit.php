<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'qtyStock',
        'qtyC',
        'reference',
        'TP',
        'famille',
        'reff',
        'unite',
        'image',
        'entrepotcateg_id',
        'fournisseur_id',
    ];
    
    //
        public function fournisseur()
        {
            return $this->belongsTo('App\Models\Fournisseur');
        }
    //

    //entrepot categorie
        public function entrepotcateg()
        {
            return $this->belongsTo('App\Models\Entrepotcateg');
        }
    //

    //Client et fournisseur devis produit
        public function clientdevisprods()
        {
            return $this->hasMany('App\Models\Clientdevisprod');
        }
        public function fournisseurfps()
        {
            return $this->hasMany('App\Models\Fournisseurfp');
        }
    //
    
    //Produit ES
        public function produitse()
        {
            return $this->hasOne('App\Models\Produitse');
        }
        public function produitvendus()
        {
            return $this->hasMany('App\Models\Produitvendu');
        }
    //
    
    //Produit stat
        public function produitstat()
        {
            return $this->hasOne('App\Models\Produitstat');
        }
    //
}
