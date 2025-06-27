<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientinfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre',
        'naissance',
        'forme_juridique',
        'numero_identifie',
        'domaine',
        'siege_social',
        'client_id'
    ];

    //client
        public function client()
        {
            return $this->belongsTo('App\Models\Client');
        }
    //
}
