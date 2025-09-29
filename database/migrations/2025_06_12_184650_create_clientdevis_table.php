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
        Schema::create('clientdevis', function (Blueprint $table) {
            $table->id();
            $table->string('numero_devis')->unique();
            $table->string('numero_facture')->nullable();

            $table->string('tva')->nullable();
            $table->boolean('apptva')->default(0);
            $table->string('frais')->nullable();
            $table->string('total_ttc');
            $table->string('delai_livraison')->nullable();
            $table->boolean("TD")->default(0);

            $table->string('statut')->nullable();
            $table->string('versement')->nullable();
            $table->string('total_payer');

            $table->string('airsi')->nullable();
            $table->string('airsi_montant')->nullable();
            $table->string('timbre')->nullable();
            $table->string('timbre_montant')->nullable();
            $table->string('date_emission')->nullable();
            $table->string('daterecfacture')->nullable();
            $table->string('delai_paiement')->nullable();
            $table->string('MP')->nullable();

            $table->string('TDF')->nullable();
            $table->boolean('archive')->default(0);
            $table->boolean('survolepf')->default(0);

            $table->string('nf')->nullable();
            $table->string('objet')->nullable();
            $table->string('chantier')->nullable();

            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('commercial_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('rgeststock_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientdevis');
    }
};
