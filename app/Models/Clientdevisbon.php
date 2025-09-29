<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevisbon extends Model
{
    use HasFactory;

    protected $fillable = [
        'bon',
        'note',
        'clientdevis_id',
        'etat'
    ];

    //Client devis
        public function clientdevis()
        {
            return $this->belongsTo('App\Models\Clientdevis');
        }
    //
}
