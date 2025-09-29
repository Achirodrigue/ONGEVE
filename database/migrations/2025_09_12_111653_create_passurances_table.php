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
        Schema::create('passurances', function (Blueprint $table) {
            $table->id();
            $table->string('compagnie')->nullable();
            $table->longText('description')->nullable();
            $table->string('numero_police')->unique();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->decimal('prime', 10, 2);
            $table->boolean('isvalide')->default(1);
            $table->foreignId('pvehicule_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passurances');
    }
};
