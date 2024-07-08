<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::truncate();
        \App\Models\User::updateOrCreate([
            'role_id' => 1,
            'name' => 'ownerkoptig',
            'email' => 'owner@koptigsalatiga.com',
            'password' => Hash::make('ownerkoptig123'),
        ]);

        \App\Models\User::updateOrCreate([
            'role_id' => 2,
            'name' => 'headmanager',
            'email' => 'headmanager@koptigsalatiga.com',
            'password' => Hash::make('headmanager1234'),
        ]);

        \App\Models\User::updateOrCreate([
            'role_id' => 3,
            'name' => 'inventory',
            'email' => 'inventory@koptigsalatiga.com',
            'password' => Hash::make('inventory1234'),
        ]);

        \App\Models\User::updateOrCreate([
            'role_id' => 4,
            'name' => 'tabunganpinjaman',
            'email' => 'tabunganpinjaman@koptigsalatiga.com',
            'password' => Hash::make('tabunganpinjaman1234'),
        ]);
    }
}
