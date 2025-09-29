<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pcarburant extends Model
{
    use HasFactory;

    protected $fillable = [
        'litres', 
        'kilometrage',
        'cout', 
        'date', 
        'station', 
        'destination',
        'motif',
        'isvalide',
        'pvehicule_id',
        'pchauffeur_id',
    ];

    //
        public function pvehicule()
        {
            return $this->belongsTo('App\Models\Pvehicule');
        }

        public function pchauffeur()
        {
            return $this->belongsTo('App\Models\Pchauffeur');
        }
    //
}
