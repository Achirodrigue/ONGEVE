<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'contact',
        'email',
        'NCC',
        'adresse_postale',
        'domaine',
        'siege_social',
        'reff',

        'compte',
    ];

    //
        public function produits()
        {
            return $this->hasMany('App\Models\Produit');
        }
        public function fournisseurfacturecomptables()
        {
            return $this->hasMany('App\Models\Fournisseurfacturecomptable');
        }
        public function fournisseurfactures()
        {
            return $this->hasMany('App\Models\Fournisseurfacture');
        }
    //
}
