<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevisremise extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'remise',
        'prix_remise',
        'TR',
        'clientdevis_id',
        'clientdevisprod_id',
        'commercial_id',
    ];

    //client devis prod
        public function clientdevisprod()
        {
            return $this->belongsTo('App\Models\Clientdevisprod');
        }
    //

    //client devis
        public function clientdevis()
        {
            return $this->belongsTo('App\Models\Clientdevis');
        }
    //

    //commercial 
        public function commercial()
        {
            return $this->belongsTo('App\Models\Commercial');
        }
    //
}
