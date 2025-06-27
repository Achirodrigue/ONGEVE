<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientremise extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'remise',
        'prix_remise',
        'motif',
        'clientdevisprod_id',
        'commercial_id',
    ];

    //client devis prod
        public function clientdevisprod()
        {
            return $this->belongsTo('App\Models\Clientdevisprod');
        }
    //

    //commercial 
        public function commercial()
        {
            return $this->belongsTo('App\Models\Commercial');
        }
    //
}
