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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('contact')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('adresse_postale');
            $table->string('reference')->unique();
            $table->string('Pachat')->nullable();
            $table->string('NCC')->nullable();
            $table->boolean("TC")->default();
            $table->boolean('PachatStatut')->default(0);
            $table->boolean('isvalide')->default(1);
            $table->boolean('etat')->default(0);
            $table->foreignId('commercial_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
