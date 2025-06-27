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
        Schema::create('employedocs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_document'); // Nom du document (ex: CNI, CV, Diplôme de Master)
            $table->string('type_document'); // Type de document prédéfini (ex: CNI, CV, DIPLOMA, CONTRACT, ATTESTATION, WORK_PERMIT)
            $table->string('fichier');     // Chemin de stockage du fichier
            $table->date('date_expiration')->nullable(); // Date d'expiration (pour CNI, permis, etc.)
            $table->text('description')->nullable(); // Description ou notes
            // Clé étrangère vers la table employees
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
        Schema::dropIfExists('employedocs');
    }
};
