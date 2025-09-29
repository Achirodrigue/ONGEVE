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
        Schema::create('facturefnes', function (Blueprint $table) {
            $table->id();
    
            $table->string('reference')->nullable();
            $table->string('token')->nullable(); // pour QR code
            $table->string('ncc')->nullable();
            $table->integer('balance_sticker')->nullable();
            $table->string('status')->nullable(); // paid, error, etc.
            $table->json('raw_response')->nullable(); // pour stocker toute la réponse
            $table->foreignId('clientdevis_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturefnes');
    }
};
