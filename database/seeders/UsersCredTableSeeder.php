<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class usersCredTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Admin', 'email' => 'admin@library.com', 'password' => 'admin123', 'role' => 'admin'],


            ['name' => 'John Doe', 'email' => 'john@example.com', 'password' => 'user123', 'role' => 'user'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'password' => 'user123', 'role' => 'user'],
            ['name' => 'Alice Brown', 'email' => 'alice@example.com', 'password' => 'user123', 'role' => 'user'],
            ['name' => 'Bob Green', 'email' => 'bob@example.com', 'password' => 'user123', 'role' => 'user'],
            ['name' => 'Charlie Polin', 'email' => 'charlie@example.com', 'password' => 'user123', 'role' => 'user'],
            ['name' => 'Diana Ross', 'email' => 'diana@example.com', 'password' => 'user123', 'role' => 'user'],
        ];

        foreach ($users as $user) {
            DB::table('users_cred')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'role' => $user['role'],
                'logged_in' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
