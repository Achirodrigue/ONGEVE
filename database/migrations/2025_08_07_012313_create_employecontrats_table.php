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
        Schema::create('employecontrats', function (Blueprint $table) {
            $table->id();
            $table->string('type_contrat'); // Type de contrat (CDI, CDD, Interim, Stage, etc.)
            $table->string('numero_contrat')->nullable()->unique(); // Numéro unique du contrat (si applicable)
            $table->date('date_debut');     // Date de début du contrat
            $table->date('date_fin')->nullable(); // Date de fin du contrat (nullable pour CDI)
            $table->string('status')->default('Active'); // Statut du contrat (Active, Terminated, Expired, etc.)
            $table->decimal('salaire')->nullable(); // Salaire lié à ce contrat (peut différer de employee.base_salary)
            $table->text('job_description')->nullable(); // Description du poste pour ce contrat
            $table->string('horaire_travail')->nullable(); // Horaire de travail (ex: 35h/semaine, temps partiel)
            $table->text('notes')->nullable(); // Notes additionnelles sur le contrat
            $table->foreignId('employe_id')
                  ->constrained() // Crée la contrainte de clé étrangère
                  ->onDelete('cascade'); // Si un employé est supprimé, ses documents le sont aussi

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employecontrats');
    }
};
