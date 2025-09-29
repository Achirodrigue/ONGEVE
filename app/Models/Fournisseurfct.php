<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseurfct extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'montant',
        'date',
        'description',
        'decaissement',
        'fournisseurfacturecomptable_id',
    ];

    //
        public function fournisseurfacturecomptable()
        {
            return $this->belongsTo('App\Models\Fournisseurfacturecomptable');
        }
    //
}
