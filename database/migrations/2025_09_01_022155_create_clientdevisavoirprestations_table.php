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
        Schema::create('clientdevisavoirprestations', function (Blueprint $table) {
            $table->id();
            $table->string('quantite');
            $table->string('prix_total');
            $table->foreignId('clientdevisavoir_id')->constrained()->onDelete('cascade');
            $table->foreignId('clientdevisprestation_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientdevisavoirprestations');
    }
};
