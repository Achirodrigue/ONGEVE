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
        Schema::create('clientdevis', function (Blueprint $table) {
            $table->id();
            $table->string('numero_devis')->unique();
            $table->string('tva');
            $table->string('frais');
            $table->string('total_ttc');
            $table->string('delai_livraison');
            $table->boolean("TD")->default(0);

            $table->string('remise')->nullable();
            $table->string('motif')->nullable();

            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('commercial_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientdevis');
    }
};
