<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        // 1. Informations personnelles
        'nom',
        'prenom',
        'photo', // Chemin vers la photo
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'nationalite',
        'situation_matrimoniale', // Ex: célibataire, marié, etc.
        'nombre_enfant',

        // 2. Coordonnées
        'adresse',
        'contact',
        'email', // Unique pour l'email pro
        'contact_urgence',

        // 3. Situation professionnelle
        'matricule_interne', // Matricule interne, doit être unique
        'poste',
        'departement',
        'lieu_affectation',
        'nom_manageur', // Pour l'instant, on met juste le nom, on pourra le lier à un autre employé plus tard
        'statut',
        'date_embauche',
        'date_fin_contrat', // Applicable pour CDD, Intérim, Stage
        // Historique des postes précédents (interne)

        // 4. Documents administratifs
        // $table->string('carte')->nullable(); // Copie de la carte d’identité ou du passeport
        // $table->string('diplome')->nullable();
        // $table->string('cv')->nullable();
        // $table->string('contrat_travail')->nullable();
        // $table->string('attestation')->nullable(); //Attestations (médical, résidence, etc.)
        // $table->string('permis_travail')->nullable(); //Permis de travail (si étranger)

        // 5. Informations de paie (partielles ici, un module de paie dédié sera plus complet)
        'salaire',
        'mode_paiement', // Ex: Virement bancaire, Chèque
        'compte_bancaire',
        'numero_cnps', // Numéro CNPS / Sécurité sociale
        // Les primes/avantages/indemnités seront gérées dans une table séparée pour plus de flexibilité

        // 6. Informations internes
        'equipement_fournis', // JSON ou texte libre pour les équipements
    ];

    public function employedocs()
    {
        return $this->hasMany(Employedoc::class);
    }

    public function employecontrats()
    {
        return $this->hasMany(Employecontrat::class);
    }
}
