<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\ExamSession;
use App\Models\Major;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExamsTry>
 */
class ExamsTryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_name' => fake()->name(),
            'major_id' => fake()->numberBetween(1,Major::count()),
            'university_level' => fake()->numberBetween(1,6),
            'book_id' => fake()->numberBetween(1,Book::count()),
            'try_number' =>fake()->numberBetween(1,3),
            'international_number' => Str::random(20)
        ];
    }
}
