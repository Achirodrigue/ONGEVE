<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevis extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_devis',
        'numero_facture',

        'tva',
        'apptva',
        'frais',
        'total_ttc',
        'total_payer',
        'versement',
        'statut',

        'airsi',
        'airsi_montant',
        'timbre',
        'timbre_montant',
        'date_emission',
        'daterecfacture',
        'delai_paiement',
        'MP',

        'delai_livraison',
        
        'TD',
        
        'TDF',
        'archive',
        'survolepf',
        'nf',
        'objet',
        'chantier',
        'client_id',
        'commercial_id',
        'rgeststock_id',
    ];
    
    //Client devis
        public function clientdevisbon()
        {
            return $this->hasOne('App\Models\Clientdevisbon');
        }
        public function clientdevisprestations()
        {
            return $this->hasMany('App\Models\Clientdevisprestation');
        }
        public function clientdevisfraisdetails()
        {
            return $this->hasMany('App\Models\Clientdevisfraisdetail');
        }
        
        public function clientdevisavoirs()
        {
            return $this->hasMany('App\Models\Clientdevisavoir');
        }
        public function clientdevisavoirprod()
        {
            return $this->hasOne('App\Models\Clientdevisavoirprod');
        }
    //

    //facture fne
        public function facturefne()
        {
            return $this->hasOne('App\Models\Facturefne');
        }
    //

    //Client devis produit
        public function clientdevisprods()
        {
            return $this->hasMany('App\Models\Clientdevisprod');
        }
    //

    //Client devis produit
        public function clientdevistransactions()
        {
            return $this->hasMany('App\Models\Clientdevistransaction');
        }
    //

    //Client devis remise
        public function clientdevisremise()
        {
            return $this->hasOne('App\Models\Clientdevisremise');
        }
    //

    //Commercial
        public function commercial()
        {
            return $this->belongsTo('App\Models\Commercial');
        }
    //

    //Client
        public function client()
        {
            return $this->belongsTo('App\Models\Client');
        }
    //

    //Client devis info
        public function clientdevisinfo()
        {
            return $this->hasOne('App\Models\Clientdevisinfo');
        }
    //
}
