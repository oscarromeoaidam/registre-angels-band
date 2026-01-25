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
    Schema::create('instrumentists', function (Blueprint $table) {
        $table->id();

        $table->string('photo_path')->nullable();

        $table->string('first_name', 100);
        $table->string('last_name', 100);
        $table->string('nickname', 100)->nullable();

        $table->enum('sex', ['M', 'F']);
        $table->date('birth_date');

        $table->string('residence', 150);
        $table->string('phone', 30);

        $table->foreignId('instrument_id')->constrained('instruments')->cascadeOnDelete();

        $table->timestamps();
    });
    
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrumentists');
    }
};
