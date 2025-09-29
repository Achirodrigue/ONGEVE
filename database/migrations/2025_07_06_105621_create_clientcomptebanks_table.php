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
        Schema::create('clientcomptebanks', function (Blueprint $table) {
            $table->id();
            $table->string('nom_banque'); // Nom de la banque
            $table->string('nom_compte'); // Nom du compte (ex: Compte Courant Principal)
            $table->string('numero_compte')->unique(); // Numéro de compte/IBAN
            $table->decimal('solde', 15, 2)->default(0); // Solde actuel
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // Lien vers un compte d'Actif du Plan Comptable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientcomptebanks');
    }
};
