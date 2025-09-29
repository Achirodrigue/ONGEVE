<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'contact',
        'email',
        'NCC',
        'reference',
        'Pachat',
        'adresse_postale',
        'TC',
        'PachatStatut',
        'isvalide',
        'etat',
        'commercial_id',
    ];

    //
        public function clientcomptebanks()
        {
            return $this->hasMany('App\Models\Clientcomptebank');
        }
    //

    //commercial
        public function commercial()
        {
            return $this->belongsTo('App\Models\Commercial');
        }
    //

    //Client devis
        public function clientdevis()
        {
            return $this->hasMany('App\Models\Clientdevis');
        }
    //

    //client info
        public function clientinfo()
        {
            return $this->hasOne('App\Models\Clientinfo');
        }
    //

}
