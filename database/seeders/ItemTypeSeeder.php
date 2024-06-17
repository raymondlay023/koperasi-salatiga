<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemTypeSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\ItemType::firstOrCreate([
            'name' => 'Sembako',
        ]);

        \App\Models\ItemType::firstOrCreate([
            'name' => 'Kedelai',
        ]);

        \App\Models\ItemType::firstOrCreate([
            'name' => 'Tahu & Tempe',
        ]);
    }
}
