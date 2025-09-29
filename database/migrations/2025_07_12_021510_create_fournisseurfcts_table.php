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
        Schema::create('fournisseurfcts', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable();
            $table->string('montant');
            $table->string('date')->nullable();
            $table->string('description')->nullable();
            $table->string('decaissement')->nullable();
            $table->foreignId('fournisseurfacturecomptable_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurfcts');
    }
};
