<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User 1',
            'email' => 'admin1@domain.com',
            'password' => bcrypt('password'),
            'role'=> 'admin',
        ]);
    
        User::create([
            'name' => 'Admin User 2',
            'email' => 'admin2@domain.com',
            'password' => bcrypt('password'),
            'role'=> 'admin',
        ]);

        User::create([
            'name' => 'Regular User 1',
            'email' => 'user1@domain.com',
            'password' => bcrypt('password'),
            'role'=> 'user',
        ]);
    
        User::create([
            'name' => 'Regular User 2',
            'email' => 'user2@domain.com',
            'password' => bcrypt('password'),
            'role'=> 'user',
        ]);
        User::create([
            'name' => 'Regular User 3',
            'email' => 'user3@domain.com',
            'password' => bcrypt('password'),
            'role'=> 'user',
        ]);
    }
}
