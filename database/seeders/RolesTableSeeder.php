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
        \App\Models\Role::truncate();
        Role::create(['role_name' => 'Owner']);
        Role::create(['role_name' => 'headmanager']);
        Role::create(['role_name' => 'simpan_pinjam']);
        Role::create(['role_name' => 'inventory']);
    }
}
