<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employecontrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_contrat',
        'numero_contrat',
        'date_debut',
        'date_fin',
        'status',
        'salaire',
        'job_description',
        'horaire_travail',
        'notes',
        'employe_id',
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }
}
