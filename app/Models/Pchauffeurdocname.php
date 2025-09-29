<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pchauffeurdocname extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    //
        public function pchauffeurdocs()
        {
            return $this->hasMany('App\Models\Pchauffeurdoc');
        }
    //
}
