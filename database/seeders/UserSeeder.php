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
            'user_name' => 'admin',
            'phone' => '016123456789',
            'is_admin' => 1,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'dummy_user' => 1
        ]);


        for ($i = 1; $i < 10; $i++) {
            User::create([
                'user_name' => 'user_' . $i,
                'phone' => '016123456789',
                'is_admin' => 0,
                'email' => 'user_' . $i . '@gmail.com',
                'password' => bcrypt('123456'),
                'dummy_user' => 1
            ]);
        }
    }
}
