<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => 'Password123!', 'role' => 'admin']
        );

        User::firstOrCreate(
            ['email' => 'instructor@example.com'],
            ['name' => 'Instructor', 'password' => 'Password123!', 'role' => 'instructor']
        );

        User::firstOrCreate(
            ['email' => 'aprendiz@example.com'],
            ['name' => 'Aprendiz', 'password' => 'Password123!', 'role' => 'aprendiz']
        );
    }
}
