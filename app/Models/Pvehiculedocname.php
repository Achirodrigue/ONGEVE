<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pvehiculedocname extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    //
        public function pvehiculedocs()
        {
            return $this->hasMany('App\Models\Pvehiculedoc');
        }
    //
}
