<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevisfraisdetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'montant',
        'clientdevis_id',
    ];

    //Client devis
        public function clientdevis()
        {
            return $this->belongsTo('App\Models\Clientdevis');
        }
    //
}
