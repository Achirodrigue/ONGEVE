<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseurfacture extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_facture',

        'tva',
        'frais',
        'total_ttc',
        'versement',
        'total_payer',

        'airsi',
        'airsi_montant',
        'timbre_montant',
        'delai_paiement',
        'delai_livraison',
        
        'facture',
        'bon',
        'archive',
        
        'isvalide',
        'livraison',

        'fournisseur_id',
        'rgeststock_id',
    ];
    
    //rgeststock
        public function rgeststock()
        {
            return $this->belongsTo('App\Models\Rgeststock');
        }
    //

    //fournisseur
        public function fournisseur()
        {
            return $this->belongsTo('App\Models\Fournisseur');
        }
        public function fournisseurfactureprods()
        {
            return $this->hasMany('App\Models\Fournisseurfactureprod');
        }
    //
}
