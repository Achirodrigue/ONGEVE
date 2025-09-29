<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pchauffeur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 
        'prenom', 
        'permis_numero', 
        'permis_validite', 
        'contact', 
        'email', 
        'statut',
        'isvalide',
    ];

    //
        public function pchauffeurdocs()
        {
            return $this->hasMany('App\Models\Pchauffeurdoc');
        }
        
        public function paffectations()
        {
            return $this->hasMany('App\Models\Paffectation');
        }

        public function pcarburants()
        {
            return $this->hasMany('App\Models\Pcarburant');
        }

        public function ppannes()
        {
            return $this->hasMany('App\Models\Ppanne');
        }
    //
}
