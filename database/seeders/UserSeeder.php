<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => 'Password123!', 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'instructor@example.com'],
            ['name' => 'Instructor', 'password' => 'Password123!', 'role' => 'instructor']
        );

        User::updateOrCreate(
            ['email' => 'aprendiz@example.com'],
            ['name' => 'Aprendiz', 'password' => 'Password123!', 'role' => 'aprendiz']
        );
    }
}
