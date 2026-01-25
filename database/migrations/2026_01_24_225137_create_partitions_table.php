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
        Schema::create('partitions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');           // Nom de la partition
            $table->string('compositeur');   // Nom du compositeur
            $table->string('fichier');       // Chemin du fichier PDF
            $table->timestamps();            // created_at et updated_at
            
            // Optionnel : ajoute des index pour les recherches
            $table->index('nom');
            $table->index('compositeur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partitions');
    }
};