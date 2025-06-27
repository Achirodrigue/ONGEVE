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
        Schema::create('clientinfos', function (Blueprint $table) {
            $table->id();
            $table->string('genre')->nullable();
            $table->string('naissance')->nullable();
            $table->string('forme_juridique')->nullable();
            $table->string('numero_identifie')->nullable();
            $table->string('domaine')->nullable();
            $table->string('siege_social')->nullable();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientinfos');
    }
};
