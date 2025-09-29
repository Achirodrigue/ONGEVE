<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 
        'compagnie', 
        'numero_police', 
        'date_debut', 
        'date_fin', 
        'prime', 
        'isvalide',
        'pvehicule_id',
    ];

    //
        public function pvehicule()
        {
            return $this->belongsTo('App\Models\Pvehicule');
        }
    //
}
