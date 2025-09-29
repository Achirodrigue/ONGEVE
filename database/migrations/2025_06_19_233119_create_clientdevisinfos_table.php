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
        Schema::create('clientdevisinfos', function (Blueprint $table) {
            $table->id();
            $table->boolean("isvalide")->default(0);
            $table->boolean("livraison")->default(0);
            $table->boolean("livraison_retour")->default(0);
            $table->boolean("magasinier")->default(0);

            $table->string('etat')->nullable();
            $table->longText('motif_rejet')->nullable();

            $table->string('debut')->nullable();
            $table->longText('fin')->nullable();
            
            $table->foreignId('clientdevis_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientdevisinfos');
    }
};
