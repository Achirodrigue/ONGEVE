<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pvehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'marque', 
        'modele', 
        'immatriculation', 
        'annee',
        'kilometrage', 
        'date_achat',
        'statut', //(actif, maintenance, vendu, accidenté)
        'ES',
        'isvalide',
        'photo', 
        'pcategorievehicule_id',
    ];

    //
        public function pcategorievehicule()
        {
            return $this->belongsTo('App\Models\Pcategorievehicule');
        }

        public function pvehiculedocs()
        {
            return $this->hasMany('App\Models\Pvehiculedoc');
        }

        public function paffectations()
        {
            return $this->hasMany('App\Models\Paffectation');
        }

        public function pentretiens()
        {
            return $this->hasMany('App\Models\Pentretien');
        }

        public function passurances()
        {
            return $this->hasMany('App\Models\Passurance');
        }

        public function pcarburants()
        {
            return $this->hasMany('App\Models\Pcarburant');
        }

        public function ppannes()
        {
            return $this->hasMany('App\Models\Ppanne');
        }
    //

}
