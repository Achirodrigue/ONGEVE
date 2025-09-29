<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pcategorievehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    //
        public function pvehicules()
        {
            return $this->hasMany('App\Models\Pvehicule');
        }
    //
}
