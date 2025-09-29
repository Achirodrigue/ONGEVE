<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pvehiculedoc extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_expiration', 
        'fichier', 
        'pvehicule_id', 
        'pvehiculedocname_id',
    ];

    //
        public function pvehicule()
        {
            return $this->belongsTo('App\Models\Pvehicule');
        }

        public function pvehiculedocname()
        {
            return $this->belongsTo('App\Models\Pvehiculedocname');
        }
    //
}
