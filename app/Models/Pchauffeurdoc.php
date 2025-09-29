<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pchauffeurdoc extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_expiration', 
        'fichier', 
        'pchauffeur_id', 
        'pchauffeurdocname_id',
    ];

    //
        public function pchauffeur()
        {
            return $this->belongsTo('App\Models\Pchauffeur');
        }

        public function pchauffeurdocname()
        {
            return $this->belongsTo('App\Models\Pchauffeurdocname');
        }
    //
}
