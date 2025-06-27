<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Particulierdevis extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_devis',
        'delai_livraison',
        'tva',
        'total_ttc',
        'frais',
        'etat',
        'isvalide',
        'livraison',
        'paye',
        'motif_rejet',
        'particulier_id',
        'commercial_id',
    ];

    //Particulier devis produit
        public function particulierdevisprods()
        {
            return $this->hasMany('App\Models\Particulierdevisprod');
        }
    //

    //Particulier
        public function particulier()
        {
            return $this->belongsTo('App\Models\Particulier');
        }
    //
}
