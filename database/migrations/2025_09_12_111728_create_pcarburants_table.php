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
        Schema::create('pcarburants', function (Blueprint $table) {
            $table->id();
            $table->decimal('litres', 8, 2)->nullable();
            $table->string('kilometrage')->nullable();
            $table->decimal('cout', 10, 2)->nullable();
            $table->date('date')->nullable();
            $table->string('station')->nullable();
            $table->string('destination')->nullable();
            $table->string('motif')->nullable();
            $table->boolean('isvalide')->default(0);
            $table->foreignId('pvehicule_id')->constrained()->onDelete('cascade');
            $table->foreignId('pchauffeur_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcarburants');
    }
};
