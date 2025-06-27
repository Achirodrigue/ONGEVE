<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'contact',
        'email',
        'isvalide',
        'identifiant',
    ];

    //Client devis
        public function clientdevis()
        {
            return $this->hasMany('App\Models\Clientdevis');
        }
    //

}
