<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employepresence extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'arrive',
        'depart',
        'employe_id',
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }
}
