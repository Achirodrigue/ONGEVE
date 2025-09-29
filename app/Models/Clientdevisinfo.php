<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevisinfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'isvalide',
        'livraison',
        'livraison_retour',
        'magasinier',

        'etat',
        'motif_rejet',

        'debut',
        'fin',

        'clientdevis_id',
    ];

    //Client devis
        public function clientdevis()
        {
            return $this->belongsTo('App\Models\Clientdevis');
        }
    //
}
