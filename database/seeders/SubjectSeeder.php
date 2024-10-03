<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Subject::create([
            "name" => "HTML"
        ]);
        Subject::create([
            "name" => "CSS"
        ]);
        Subject::create([
            "name" => "JAVASCRIPT"
        ]);
        Subject::create([
            "name" => "PHP"
        ]);


        // Subject::factory()->count(10)->create();
    }
}
