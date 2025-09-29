<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientcomptebank extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_banque',
        'nom_compte',
        'numero_compte',
        'solde',
        'client_id',
    ];

    //Client
        public function client()
        {
            return $this->belongsTo('App\Models\Client');
        }
    //
}
