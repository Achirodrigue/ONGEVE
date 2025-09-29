<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturefneavoir extends Model
{
    use HasFactory;
    
    // protected $table = 'facturefnes';

    protected $fillable = [
        'reference', 
        'token', 
        'ncc', 
        'balance_sticker', 
        'status', 
        'raw_response',
        'clientdevisavoir_id'
    ];

    // protected $casts = [
    //     'raw_response' => 'array',
    // ];

    public function clientdevisavoir()
    {
        return $this->belongsTo('App\Models\Clientdevisavoir');
    }
}
