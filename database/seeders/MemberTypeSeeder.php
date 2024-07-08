<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\MemberType::truncate();
        \App\Models\MemberType::updateOrCreate(['name' => 'Anggota']);
        \App\Models\MemberType::updateOrCreate(['name' => 'Non Anggota']);
    }
}
