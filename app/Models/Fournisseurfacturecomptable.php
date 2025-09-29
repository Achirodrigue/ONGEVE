<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseurfacturecomptable extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_facture',
        'date',
        'delai_reglement',
        'designation',
        'echeance',
        'statut',
        'versement',
        'total_payer',
        'facture',
        'bon',
        'createur',
        'fournisseur_id',
    ];

    //
        public function fournisseur()
        {
            return $this->belongsTo('App\Models\Fournisseur');
        }
        public function fournisseurfcts()
        {
            return $this->hasMany('App\Models\Fournisseurfct');
        }
        public function fournisseurfps()
        {
            return $this->hasMany('App\Models\Fournisseurfp');
        }
    //
}
