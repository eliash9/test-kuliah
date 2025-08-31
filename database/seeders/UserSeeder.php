<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create sample student user
        User::firstOrCreate([
            'email' => 'mahasiswa@example.com',
        ], [
            'name' => 'Mahasiswa User',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ]);
    }
}
