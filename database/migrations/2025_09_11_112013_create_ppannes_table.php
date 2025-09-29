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
        Schema::create('ppannes', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->string('date_panne');
            $table->string('cout')->nullable();
            $table->boolean("statut")->default(0);
            $table->foreignId('pvehicule_id')->constrained()->onDelete('cascade');
            $table->foreignId('pchauffeur_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppannes');
    }
};
