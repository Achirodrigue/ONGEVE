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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->longText('description')->nullable();
            $table->string('prix')->nullable();
            $table->string('qtyStock')->nullable();
            $table->string('qtyC')->nullable();
            $table->string('reference')->nullable();
            $table->boolean("TP")->default(0);
            $table->string("famille")->nullable();
            $table->string("reff")->nullable();
            $table->string("unite")->nullable();
            $table->string("image")->nullable();
            $table->foreignId('entrepotcateg_id')->constrained()->onDelete('cascade');
            $table->foreignId('fournisseur_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
