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
        Schema::create('clientdevisavoirs', function (Blueprint $table) {
            $table->id();
            $table->string('numero_devis')->unique();
            $table->string('numero_facture')->nullable();
            $table->string('tva')->nullable();
            $table->string('airsi_montant')->nullable();
            $table->string('total_ttc')->nullable();
            $table->string('total_payer')->nullable();
            $table->foreignId('clientdevis_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientdevisavoirs');
    }
};
