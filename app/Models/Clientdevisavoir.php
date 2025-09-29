<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevisavoir extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_devis',
        'numero_facture',

        'tva',
        'airsi_montant',
        'total_ttc',
        'total_payer',

        'clientdevis_id',
    ];
    
    //Client devis
        public function clientdevis()
        {
            return $this->belongsTo('App\Models\Clientdevis');
        }
        public function clientdevisavoirprods()
        {
            return $this->hasMany('App\Models\Clientdevisavoirprod');
        }
        public function clientdevisavoirprestations()
        {
            return $this->hasMany('App\Models\Clientdevisavoirprestation');
        }
    //

    //facture fne
        public function facturefneavoir()
        {
            return $this->hasOne('App\Models\Facturefneavoir');
        }
    //
}
