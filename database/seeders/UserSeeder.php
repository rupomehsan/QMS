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
            'phone' => 'admin',
            'is_admin' => 1,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        User::factory()->count(10)->create();
    }
}
