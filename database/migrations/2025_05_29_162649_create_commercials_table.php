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
        Schema::create('commercials', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('contact');
            $table->string('email')->unique();
            $table->string('premise')->nullable();
            $table->boolean("isvalide")->default(1);
            $table->boolean("statut")->default(0);
            $table->string('photo')->nullable();
            $table->boolean("role")->default(0);
            $table->string('connexion');
            $table->string('identifiant')->unique();
            $table->string('password')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commercials');
    }
};
