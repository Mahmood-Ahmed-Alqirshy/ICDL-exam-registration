<?php

namespace Database\Seeders;

use App\Models\ExamSession;
use App\Models\ExamsTry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExamSession::factory(6)->hasTries(200)->create();
    }
}
