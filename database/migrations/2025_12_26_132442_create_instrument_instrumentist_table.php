<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('instrument_instrumentist', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instrumentist_id')->constrained()->cascadeOnDelete();
            $table->foreignId('instrument_id')->constrained()->cascadeOnDelete();

            // Optionnel : instrument principal
            $table->boolean('is_primary')->default(false);

            $table->timestamps();

            // Empêche les doublons
            $table->unique(['instrumentist_id', 'instrument_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instrument_instrumentist');
    }
};
