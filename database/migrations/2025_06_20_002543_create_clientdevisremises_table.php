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
        Schema::create('clientdevisremises', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('remise');
            $table->string('prix_remise');
            $table->longText('motif');
            $table->boolean("TR")->default(0);
            $table->foreignId('clientdevis_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('clientdevisprod_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('commercial_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientdevisremises');
    }
};
