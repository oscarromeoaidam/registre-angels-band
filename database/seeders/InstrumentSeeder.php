<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instrument;

class InstrumentSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Trompette', 'category' => 'Cuivres'],
            ['name' => 'Trombone',  'category' => 'Cuivres'],
            ['name' => 'Palette',   'category' => 'Cuivres'],
            ['name' => 'Tambour',   'category' => 'Percussions'],
            ['name' => 'Cymbales',  'category' => 'Percussions'],
            ['name' => 'Caisse claire',  'category' => 'Percussions'],
            ['name' => 'Grosse caisse',  'category' => 'Percussions'],
            ['name' => 'Tome',  'category' => 'Percussions'],
            ['name' => 'Cascagnette',  'category' => 'Percussions'],
            ['name' => 'Gon',  'category' => 'Percussions'],

        ];

        foreach ($data as $row) {
            Instrument::firstOrCreate($row);
        }
    }
}

