<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();

            // 1. Informations personnelles
            $table->string('nom');
            $table->string('prenom');
            $table->string('photo')->nullable(); // Chemin vers la photo
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('sexe');
            $table->string('nationalite');
            $table->string('situation_matrimoniale')->nullable(); // Ex: célibataire, marié, etc.
            $table->integer('nombre_enfant')->default(0);

            // 2. Coordonnées
            $table->string('adresse');
            $table->string('contact');
            $table->string('email')->unique(); // Unique pour l'email pro
            $table->string('contact_urgence')->nullable();

            // 3. Situation professionnelle
            $table->string('matricule_interne')->unique(); // Matricule interne, doit être unique
            $table->string('poste')->nullable();
            $table->string('departement')->nullable();
            $table->string('lieu_affectation')->nullable();
            $table->string('nom_manageur')->nullable(); // Pour l'instant, on met juste le nom, on pourra le lier à un autre employé plus tard
            $table->string('statut');
            $table->date('date_embauche');
            $table->date('date_fin_contrat')->nullable(); // Applicable pour CDD, Intérim, Stage
            // Historique des postes précédents (interne)

            // 4. Documents administratifs
            // $table->string('carte')->nullable(); // Copie de la carte d’identité ou du passeport
            // $table->string('diplome')->nullable();
            // $table->string('cv')->nullable();
            // $table->string('contrat_travail')->nullable();
            // $table->string('attestation')->nullable(); //Attestations (médical, résidence, etc.)
            // $table->string('permis_travail')->nullable(); //Permis de travail (si étranger)

            // 5. Informations de paie (partielles ici, un module de paie dédié sera plus complet)
            $table->integer('salaire')->nullable();
            $table->string('mode_paiement')->nullable(); // Ex: Virement bancaire, Chèque
            $table->string('compte_bancaire')->nullable();
            $table->string('numero_cnps')->nullable(); // Numéro CNPS / Sécurité sociale
            // Les primes/avantages/indemnités seront gérées dans une table séparée pour plus de flexibilité

            // 6. Informations internes
            $table->text('equipement_fournis')->nullable(); // JSON ou texte libre pour les équipements

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
