<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Particulierremise extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'remise',
        'prix_remise',
        'motif',
        'particulierdevisprod_id',
        'commercial_id',
    ];

    //Particulier devis prod
        public function particulierdevisprod()
        {
            return $this->belongsTo('App\Models\Particulierdevisprod');
        }
    //

    //commercial 
        public function commercial()
        {
            return $this->belongsTo('App\Models\Commercial');
        }
    //
}
