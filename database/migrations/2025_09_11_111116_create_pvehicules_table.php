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
        Schema::create('pvehicules', function (Blueprint $table) {
            $table->id();
            $table->string('marque');
            $table->string('modele');
            $table->string('immatriculation')->unique();
            $table->string('annee')->nullable();
            $table->string('kilometrage')->nullable();
            $table->enum('statut', ['actif', 'maintenance', 'vendu', 'accidenté'])->default('actif');
            $table->string('date_achat')->nullable();
            $table->boolean("ES")->default(1);
            $table->boolean("isvalide")->default(1);
            $table->string('photo')->nullable();
            $table->foreignId('pcategorievehicule_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pvehicules');
    }
};
