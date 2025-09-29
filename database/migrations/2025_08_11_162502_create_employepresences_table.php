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
        Schema::create('employepresences', function (Blueprint $table) {
            $table->id();
            $table->string('date'); 
            $table->string('arrive')->nullable();
            $table->string('depart')->nullable();
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
        Schema::dropIfExists('employepresences');
    }
};
