<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employedoc extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_document',
        'type_document',
        'fichier',
        'date_expiration',
        'description',
        'employe_id',
    ];

    protected $casts = [
        'expiration_date' => 'date',
    ];

    /**
     * Get the employee that owns the document.
     */
    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }
}
