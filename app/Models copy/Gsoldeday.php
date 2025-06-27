<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gsoldeday extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'solde',
    ];
}
