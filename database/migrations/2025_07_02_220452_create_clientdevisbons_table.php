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
        Schema::create('clientdevisbons', function (Blueprint $table) {
            $table->id();
            $table->string('bon');
            $table->longText('note')->nullable(); 
            $table->boolean("etat")->default(1);
            $table->foreignId('clientdevis_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientdevisbons');
    }
};
