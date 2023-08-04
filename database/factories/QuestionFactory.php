<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "subject_id" => $this->faker->numberBetween(1, 10),
            "question" => $this->faker->name(),
            "options" => ["one", "two", "three", "four"],
            "answer" => $this->faker->numberBetween(0, 3),
        ];
    }
}
