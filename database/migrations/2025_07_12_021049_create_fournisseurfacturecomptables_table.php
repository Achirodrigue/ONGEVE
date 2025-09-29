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
        Schema::create('fournisseurfacturecomptables', function (Blueprint $table) {
            $table->id();
            $table->string('numero_facture')->nullable();
            $table->string('date')->nullable();
            $table->string('delai_reglement');
            $table->string('designation');
            $table->string('echeance');
            $table->string('statut')->nullable();
            $table->string('versement')->nullable();
            $table->string('total_payer')->nullable();
            $table->string('facture')->nullable();
            $table->string('bon')->nullable();
            $table->boolean("createur")->default(0);
            $table->foreignId('fournisseur_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurfacturecomptables');
    }
};
