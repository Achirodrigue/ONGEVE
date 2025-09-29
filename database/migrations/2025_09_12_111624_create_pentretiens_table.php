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
        Schema::create('pentretiens', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->string('type')->nullable(); // vidange, pneus, freins, etc.
            $table->date('date_entretien');
            $table->integer('kilometrage')->nullable();
            $table->decimal('cout', 10)->default(0)->nullable();
            $table->string('garage')->nullable();
            $table->foreignId('ppanne_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('pvehicule_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pentretiens');
    }
};
