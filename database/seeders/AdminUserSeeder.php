<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Supprime l'ancien admin si existe (par email)
        User::where('email', 'fab@angelsband.com')->delete();

        // ✅ Crée le nouvel admin
        User::create([
            'name' => 'Admin',
            'email' => 'fab@angelsband.com',
            'password' => Hash::make("angel's_band"),
            'is_admin' => true,
        ]);
    }
}
