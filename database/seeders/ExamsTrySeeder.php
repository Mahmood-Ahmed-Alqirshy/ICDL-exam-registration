<?php

namespace Database\Seeders;

use App\Models\ExamsTry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamsTrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExamsTry::factory(200)->create();
    }
}
