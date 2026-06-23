<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Owner',
            'email' => 'owner@laundry.com',
            'password' => Hash::make('password123'), // Password dienkripsi
            'role' => 'owner'
        ]);

        // Bikin Akun Karyawan
        User::create([
            'name' => 'Karyawan',
            'email' => 'karyawan@laundry.com',
            'password' => Hash::make('password123'), // Password dienkripsi
            'role' => 'karyawan'
        ]);
    }
}
