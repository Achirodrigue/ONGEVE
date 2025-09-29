<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevisavoirprestation extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'prix_total',
        'clientdevisavoir_id',
        'clientdevisprestation_id',
    ];

    //Client devis
        public function clientdevisavoir()
        {
            return $this->belongsTo('App\Models\Clientdevisavoir');
        }
        public function clientdevisprestation()
        {
            return $this->belongsTo('App\Models\Clientdevisprestation');
        }
    //
}
