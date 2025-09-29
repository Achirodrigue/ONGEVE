<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppanne extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'description', 
        'date_panne',
        'cout', //(nullable)
        'statut', // (en cours, résolue)
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

        public function pentretien()
        {
            return $this->hasOne('App\Models\Pentretien');
        }
    //
}
