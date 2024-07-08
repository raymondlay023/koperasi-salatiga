<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate();
        Role::create(['role_name' => 'Owner']);
        Role::create(['role_name' => 'Head_Manager']);
        Role::create(['role_name' => 'Inventory']);
        Role::create(['role_name' => 'Tabungan_Pinjaman']);
    }
}
