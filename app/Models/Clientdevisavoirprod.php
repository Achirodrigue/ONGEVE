<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevisavoirprod extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'prix_total',
        'clientdevisavoir_id',
        'clientdevisprod_id',
    ];

    //Client devis
        public function clientdevisavoir()
        {
            return $this->belongsTo('App\Models\Clientdevisavoir');
        }
        public function clientdevisprod()
        {
            return $this->belongsTo('App\Models\Clientdevisprod');
        }
    //
}
