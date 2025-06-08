<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1 admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // 2 users
        User::factory()->create([
            'name' => 'user1',
            'email' => 'user1@example.com',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'user2',
            'email' => 'user2@example.com',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);



    }
}
