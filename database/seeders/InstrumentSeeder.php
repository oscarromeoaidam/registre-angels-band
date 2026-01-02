<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instrument;

class InstrumentSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Cymbales',  'category' => 'Percussions'],
            ['name' => 'Cascagnette',  'category' => 'Percussions'],
            ['name' => 'Gon',  'category' => 'Percussions'],

        ];

        foreach ($data as $row) {
            Instrument::firstOrCreate($row);
        }
    }
}

