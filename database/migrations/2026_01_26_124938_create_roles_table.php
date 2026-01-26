<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->timestamps();
        });
        
        // Insérer les rôles de votre base
        DB::table('roles')->insert([
            ['name' => 'Président', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'DT principal', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'DT Adjoint', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'DT Alto', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'DT Soprano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'DT Tenor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'DT Basse', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Organisateur', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Secretaire', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Trésoriere', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chargé spirituel', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Instrumentiste', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};