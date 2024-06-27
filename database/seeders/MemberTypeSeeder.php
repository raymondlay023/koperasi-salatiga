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
        \App\Models\MemberType::firstOrCreate(['name' => 'Karyawan Tetap']);
        \App\Models\MemberType::firstOrCreate(['name' => 'Karyawan Tidak Tetap']);
    }
}
