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
        Schema::create('fournisseurfps', function (Blueprint $table) {
            $table->id();
            $table->string('produit')->nullable();
            $table->string('quantite')->nullable();
            $table->string('prix_unitaire')->nullable();
            $table->string('prix_total')->nullable();
            $table->string('unite')->nullable();
            $table->foreignId('produit_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('fournisseurfacturecomptable_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurfps');
    }
};
