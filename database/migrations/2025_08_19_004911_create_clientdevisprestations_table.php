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
        Schema::create('clientdevisprestations', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->string('unite')->nullable();
            $table->string('nbre_passage')->nullable();
            $table->string('quantite')->nullable();
            $table->string('prix_unitaire');
            $table->string('prix_total');
            $table->foreignId('clientdevis_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientdevisprestations');
    }
};
