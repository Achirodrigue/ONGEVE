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
        Schema::create('clientdevistransactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable();
            $table->string('montant');
            $table->string('date')->nullable();
            $table->longText('description')->nullable();
            $table->string('decaissement')->nullable();
            $table->foreignId('clientdevis_id')->constrained('clientdevis')->onDelete('cascade'); // Lien vers un compte d'Actif du Plan Comptable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientdevistransactions');
    }
};
