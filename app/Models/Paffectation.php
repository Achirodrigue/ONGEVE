<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paffectation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_debut', 
        'date_fin', 
        'etat', 
        'mission', 
        'type', 
        'statut', 
        'employe_id', 
        'pchauffeur_id',
        'pvehicule_id',
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

        public function employe()
        {
            return $this->belongsTo('App\Models\Employe');
        }
    //
}
