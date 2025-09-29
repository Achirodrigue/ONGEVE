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
        Schema::create('fournisseurfactures', function (Blueprint $table) {
            $table->id();
            $table->string('numero_facture')->nullable();

            $table->string('tva')->nullable();
            $table->string('frais')->nullable();
            $table->string('total_ttc')->nullable();
            $table->string('versement')->nullable();
            $table->string('total_payer')->nullable();

            $table->string('airsi')->nullable();
            $table->string('airsi_montant')->nullable();
            $table->string('timbre_montant')->nullable();
            $table->string('delai_paiement')->nullable();
            $table->string('delai_livraison')->nullable();

            $table->string('facture')->nullable();
            $table->string('bon')->nullable();
            $table->boolean('archive')->default(0);
            
            $table->boolean("isvalide")->default(0);
            $table->boolean("livraison")->default(0);

            $table->foreignId('fournisseur_id')->constrained()->onDelete('cascade');
            $table->foreignId('rgeststock_id')->nullable()->constrained()->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurfactures');
    }
};
