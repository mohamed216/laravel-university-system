<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@university.edu',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Professor User
        DB::table('users')->insert([
            'name' => 'Dr. Ahmed Hassan',
            'email' => 'professor@university.edu',
            'password' => Hash::make('professor123'),
            'role' => 'professor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Student User
        DB::table('users')->insert([
            'name' => 'Mohamed Ali',
            'email' => 'student@university.edu',
            'password' => Hash::make('student123'),
            'role' => 'student',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
