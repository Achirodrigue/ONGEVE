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
            // $table->string('image');
            $table->string('description');
            $table->string('prix');
            $table->string('promo')->nullable();
            $table->boolean("stock")->default(0);
            $table->string('qtyStock');
            $table->string('reference');
            $table->boolean("isvalide")->default(0);
            $table->string("etat")->nullable();
            $table->boolean("mvente");
            $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
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
