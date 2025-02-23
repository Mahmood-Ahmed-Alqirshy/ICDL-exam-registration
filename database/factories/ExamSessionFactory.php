<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExamSession>
 */
class ExamSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->dateTimeBetween('now', '+1 week'),
            'time' => fake()->time('H:0:0'),
            'students' => fake()->numberBetween(15,20),
            'second_year_priority' => fake()->numberBetween(0,1),
            'technical_majors_priority' => fake()->numberBetween(0,1),
            'international_number_priority' => fake()->numberBetween(0,1),
            'unique_priority' => fake()->numberBetween(1,3)
        ];
    }
}
