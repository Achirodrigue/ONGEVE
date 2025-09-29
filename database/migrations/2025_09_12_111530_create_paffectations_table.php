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
        Schema::create('paffectations', function (Blueprint $table) {
            $table->id();
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->longText('mission')->nullable();
            $table->boolean('etat')->default(1);
            $table->boolean('type')->default(0);
            $table->boolean('statut')->default(0);
            $table->foreignId('employe_id')->nullable()->constrained()->onDelete('cascade');   // employé si emprunt
            $table->foreignId('pchauffeur_id')->nullable()->constrained()->onDelete('cascade');// chauffeur si mission
            $table->foreignId('pvehicule_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paffectations');
    }
};
