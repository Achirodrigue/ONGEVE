<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pentretien extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', //(vidange, pneus, freins, etc.)
        'description', 
        'date_entretien', 
        'kilometrage', 
        'cout', 
        'garage', 
        'ppanne_id', 
        'pvehicule_id',
    ];

    //
        public function pvehicule()
        {
            return $this->belongsTo('App\Models\Pvehicule');
        }

        public function ppanne()
        {
            return $this->belongsTo('App\Models\Ppanne');
        }
    //
}
