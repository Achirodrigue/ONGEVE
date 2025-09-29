<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientdevistransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'montant',
        'date',
        'description',
        'decaissement',
        'clientdevis_id',
    ];

    //Client devis
        public function clientdevis()
        {
            return $this->belongsTo('App\Models\Clientdevis');
        }
    //
}
