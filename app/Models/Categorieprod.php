<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorieprod extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'categorie_id',
    ];

    //entrepotcategs
        public function entrepotcategs()
        {
            return $this->hasMany('App\Models\Entrepotcateg');
        }
    //
}
