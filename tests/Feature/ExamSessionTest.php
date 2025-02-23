<?php

namespace Tests\Feature;

use App\Models\ExamSession;
use App\Models\ExamsTry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Major;
use App\Models\Book;
use Database\Seeders\BookSeeder;
use Database\Seeders\MajorSeeder;
use Database\Seeders\TestSeeder;
use Illuminate\Database\QueryException;
use Tests\TestCase;
use Illuminate\Support\Str;

use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;

class ExamSessionTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
    protected $seeder = TestSeeder::class;
    /**
     * A basic feature test example.
     */
    public function test_priority(): void

    {

        $examSession_01 = ExamSession::create([
            'date' => fake()->dateTimeBetween('+1 week', '+2 week'),
            'time' => fake()->time('H:0:0'),
            'students' => 3,
            'second_year_priority' => 1,
            'technical_majors_priority' => 0,
            'international_number_priority' => 0,
            'unique_priority' => 1
        ]);

        $try_01_01 = new ExamsTry();
        $try_01_01->fill([
            'exam_session_id' => $examSession_01->id,
            'student_name' => fake()->name(),
            'major_id' => 10,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3)
        ]);
        $this->assertEquals(0, $try_01_01->getStudentDuplication());
        $this->assertTrue($try_01_01->isPriority());
        $try_01_01->save();


        $try_01_02 = new ExamsTry();
        $try_01_02->fill([
            'exam_session_id' => $examSession_01->id,
            'student_name' => fake()->name(),
            'major_id' => 1,
            'university_level' => 3,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20)
        ]);
        $this->assertEquals(0, $try_01_02->getStudentDuplication());
        $this->assertNotTrue($try_01_02->isPriority());

        $try_01_02->save();


        $try_01_03 = new ExamsTry();
        $try_01_03->fill([
            'exam_session_id' => $examSession_01->id,
            'student_name' => 'احمد',
            'major_id' => 1,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3)
        ]);
        $this->assertEquals(0, $try_01_03->getStudentDuplication());
        $this->assertTrue($try_01_03->isPriority());

        $try_01_03->save();


        $try_01_04 = new ExamsTry();
        $try_01_04->fill([
            'exam_session_id' => $examSession_01->id,
            'student_name' => 'احمد',
            'major_id' => 1,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20)
        ]);
        $this->assertEquals(1, $try_01_04->getStudentDuplication());
        $this->assertTrue($try_01_04->isPriority());

        $try_01_04->save();


        $try_01_05 = new ExamsTry();
        $try_01_05->fill([
            'exam_session_id' => $examSession_01->id,
            'student_name' => 'احمد',
            'major_id' => 1,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20)
        ]);
        $this->assertEquals(2, $try_01_05->getStudentDuplication());
        $this->assertTrue($try_01_05->isPriority());

        $try_01_05->save();

        $this->assertEquals(5, $examSession_01->tries()->get()->count());
        $this->assertEquals(4, $examSession_01->strictTries()->count());

        //////////////////////////////////////////////////////////////////////////////

        $examSession_02 = ExamSession::create([
            'date' => fake()->dateTimeBetween('+3 week', '+4 week'),
            'time' => fake()->time('H:0:0'),
            'students' => 3,
            'second_year_priority' => 0,
            'technical_majors_priority' => 1,
            'international_number_priority' => 1,
            'unique_priority' => 2
        ]);

        $this->assertNotEquals($examSession_01->date->format("Y-m-d"), $examSession_02->date->format("Y-m-d"),"it's ok, try run the test again until thy are different");

        $try_02_01 = new ExamsTry();
        $try_02_01->fill([
            'exam_session_id' => $examSession_02->id,
            'student_name' => fake()->name(),
            'major_id' => 10,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3)
        ]);
        $this->assertEquals(0, $try_02_01->getStudentDuplication());
        $this->assertNotTrue($try_02_01->isPriority());

        $try_02_01->save();


        $try_02_02 = new ExamsTry();
        $try_02_02->fill([
            'exam_session_id' => $examSession_02->id,
            'student_name' => fake()->name(),
            'major_id' => 1,
            'university_level' => 3,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20)
        ]);
        $this->assertEquals(0, $try_02_02->getStudentDuplication());
        $this->assertTrue($try_02_02->isPriority());

        $try_02_02->save();


        $try_02_03 = new ExamsTry();
        $try_02_03->fill([
            'exam_session_id' => $examSession_02->id,
            'student_name' => 'احمد',
            'major_id' => 10,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20)
        ]);
        $this->assertEquals(0, $try_02_03->getStudentDuplication());
        $this->assertNotTrue($try_02_03->isPriority());

        $try_02_03->save();


        $try_02_04 = new ExamsTry();
        $try_02_04->fill([
            'exam_session_id' => $examSession_02->id,
            'student_name' => 'احمد',
            'major_id' => 1,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20)
        ]);
        $this->assertEquals(1, $try_02_04->getStudentDuplication());
        $this->assertTrue($try_02_04->isPriority());

        $try_02_04->save();


        $try_02_05 = new ExamsTry();
        $try_02_05->fill([
            'exam_session_id' => $examSession_02->id,
            'student_name' => 'احمد',
            'major_id' => 1,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20),
        ]);
        $this->assertEquals(2, $try_02_05->getStudentDuplication());
        $this->assertTrue($try_02_05->isPriority());

        $try_02_05->save();

        $this->assertEquals(5, $examSession_02->tries()->get()->count());
        $this->assertEquals(3, $examSession_02->strictTries()->count());

        //////////////////////////////////////////////////////////////////////////////

        $examSession_03 = ExamSession::create([
            'date' => $examSession_01->date,
            'time' => fake()->time('H:0:0'),
            'students' => 3,
            'second_year_priority' => 1,
            'technical_majors_priority' => 1,
            'international_number_priority' => 0,
            'unique_priority' => 3
        ]);


        $try_03_01 = new ExamsTry();
        $try_03_01->fill([
            'exam_session_id' => $examSession_03->id,
            'student_name' => fake()->name(),
            'major_id' => 10,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3)
        ]);
        $this->assertEquals(0, $try_03_01->getStudentDuplication());
        $this->assertNotTrue($try_03_01->isPriority());

        $try_03_01->save();


        $try_03_02 = new ExamsTry();
        $try_03_02->fill([
            'exam_session_id' => $examSession_03->id,
            'student_name' => fake()->name(),
            'major_id' => 1,
            'university_level' => 3,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20)
        ]);
        $this->assertEquals(0, $try_03_02->getStudentDuplication());
        $this->assertNotTrue($try_03_02->isPriority());

        $try_03_02->save();


        $try_03_03 = new ExamsTry();
        $try_03_03->fill([
            'exam_session_id' => $examSession_03->id,
            'student_name' => 'احمد',
            'major_id' => 10,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20)
        ]);
        $this->assertEquals(3, $examSession_03->getPriorityData($try_03_03)->getStudentDuplication());
        $this->assertEquals(3, $try_03_03->getStudentDuplication());
        $this->assertNotTrue($try_03_03->isPriority());

        $try_03_03->save();


        $try_03_04 = new ExamsTry();
        $try_03_04->fill([
            'exam_session_id' => $examSession_03->id,
            'student_name' => 'احمد',
            'major_id' => 1,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20)
        ]);
        $this->assertEquals(4, $examSession_03->getPriorityData($try_03_04)->getStudentDuplication());
        $this->assertEquals(4, $try_03_04->getStudentDuplication());
        $this->assertTrue($try_03_04->isPriority());

        $try_03_04->save();


        $try_03_05 = new ExamsTry();
        $try_03_05->fill([
            'exam_session_id' => $examSession_03->id,
            'student_name' => 'احمد',
            'major_id' => 1,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20)
        ]);
        $this->assertEquals(5, $examSession_03->getPriorityData($try_03_05)->getStudentDuplication());
        $this->assertEquals(5, $try_03_05->getStudentDuplication());
        $this->assertTrue($try_03_05->isPriority());
        $try_03_05->save();

        //////////////////////////////////////////////////////////

        $examSession_04 = ExamSession::create([
            'date' => fake()->dateTimeBetween('+6 week', '+7 week'),
            'time' => fake()->time('H:0:0'),
            'students' => 3,
            'second_year_priority' => 1,
            'technical_majors_priority' => 1,
            'international_number_priority' => 1,
            'unique_priority' => 1
            
        ]);


        $try_04_01 = new ExamsTry();
        $try_04_01->fill([
            'exam_session_id' => $examSession_04->id,
            'student_name' => fake()->name(),
            'major_id' => 1,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20)
        ]);
        $this->assertTrue($try_04_01->isPriority());

        $try_04_02 = new ExamsTry();
        $try_04_02->fill([
            'exam_session_id' => $examSession_04->id,
            'student_name' => fake()->name(),
            'major_id' => 10,
            'university_level' => 3,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3)
        ]);
        $this->assertNotTrue($try_04_02->isPriority());
        
        $try_04_03 = new ExamsTry();
        $try_04_03->fill([
            'exam_session_id' => $examSession_04->id,
            'student_name' => fake()->name(),
            'major_id' => 10,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3)
        ]);
        $this->assertNotTrue($try_04_03->isPriority());



        $this->assertEquals(5, $examSession_03->tries()->get()->count());
        $this->assertEquals(2, $examSession_03->strictTries()->count());

        $this->assertEquals(10, ExamSession::getTriesForDate($examSession_03->date)->count());
        $this->assertEquals(5, ExamSession::getTriesForDate($examSession_02->date)->count());
    }

    public function test_session_report()
    {
        $examSession_01 = ExamSession::create([
            'date' => fake()->dateTimeBetween('+1 week', '+2 week'),
            'time' => fake()->time('H:0:0'),
            'students' => 7,
            'second_year_priority' => 1,
            'technical_majors_priority' => 0,
            'international_number_priority' => 0,
            'unique_priority' => 1
        ]);

        $try_01_01 = ExamsTry::create([
            'exam_session_id' => $examSession_01->id,
            'student_name' => 'احمد',
            'major_id' => 1,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20)
        ]); //P

        $try_01_02 = ExamsTry::create([
            'exam_session_id' => $examSession_01->id,
            'student_name' => fake()->name(),
            'major_id' => 10,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3)
        ]); //P

        $try_01_03 = ExamsTry::create([
            'exam_session_id' => $examSession_01->id,
            'student_name' => fake()->name(),
            'major_id' => 1,
            'university_level' => 3,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20)
        ]); //N

        $try_01_04 = ExamsTry::create([
            'exam_session_id' => $examSession_01->id,
            'student_name' => fake()->name(),
            'major_id' => 1,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3)
        ]); //P

        $try_01_05 = ExamsTry::create([
            'exam_session_id' => $examSession_01->id,
            'student_name' => 'احمد',
            'major_id' => 1,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3),
            'international_number' => Str::random(20)
        ]); //P

        $try_01_06 = ExamsTry::create([
            'exam_session_id' => $examSession_01->id,
            'student_name' => fake()->name(),
            'major_id' => 7,
            'university_level' => 1,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3)
        ]); //N

        $try_01_07 = ExamsTry::create([
            'exam_session_id' => $examSession_01->id,
            'student_name' => fake()->name(),
            'major_id' => 5,
            'university_level' => 3,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3)
        ]); //N

        $try_01_08 = ExamsTry::create([
            'exam_session_id' => $examSession_01->id,
            'student_name' => fake()->name(),
            'major_id' => 9,
            'university_level' => 3,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3)
        ]); //N

        $try_01_09 = ExamsTry::create([
            'exam_session_id' => $examSession_01->id,
            'student_name' => fake()->name(),
            'major_id' => 9,
            'university_level' => 2,
            'book_id' => fake()->numberBetween(1, Book::count()),
            'try_number' => fake()->numberBetween(1, 3)
        ]); //P

        $ids = [
            $try_01_01->id,
            $try_01_02->id,
            $try_01_04->id,
            $try_01_09->id,
            $try_01_05->id,
            $try_01_03->id,
            $try_01_06->id
        ];

        assertEquals($ids, $examSession_01->reportTries()
            ->map(fn ($try) => $try->id)->toArray());



        // //////////////////////////////////////////////////////////////////////////////

        // $examSession_02 = ExamSession::create([
        //     'date' => fake()->dateTimeBetween('+1 week', '+2 week'),
        //     'time' => fake()->time('H:0:0'),
        //     'students' => 3,
        //     'second_year_priority' => 0,
        //     'technical_majors_priority' => 1,
        //     'international_number_priority' => 1,
        //     'unique_priority' => 2
        // ]);

        // $try_02_01 = ExamsTry::create([
        //     'exam_session_id' => $examSession_02->id,
        //     'student_name' => fake()->name(),
        //     'major_id' => 10,
        //     'university_level' => 2,
        //     'book_id' => fake()->numberBetween(1, Book::count()),
        //     'try_number' => fake()->numberBetween(1, 3)
        // ]);


        // $try_02_02 = ExamsTry::create([
        //     'exam_session_id' => $examSession_02->id,
        //     'student_name' => fake()->name(),
        //     'major_id' => 1,
        //     'university_level' => 3,
        //     'book_id' => fake()->numberBetween(1, Book::count()),
        //     'try_number' => fake()->numberBetween(1, 3),
        //     'international_number' => Str::random(20)
        // ]);


        // $try_02_03 = ExamsTry::create([
        //     'exam_session_id' => $examSession_02->id,
        //     'student_name' => fake()->name(),
        //     'major_id' => 10,
        //     'university_level' => 2,
        //     'book_id' => fake()->numberBetween(1, Book::count()),
        //     'try_number' => fake()->numberBetween(1, 3),
        //     'international_number' => Str::random(20)
        // ]);

        // $try_02_04 = ExamsTry::create([
        //     'exam_session_id' => $examSession_02->id,
        //     'student_name' => 'احمد',
        //     'major_id' => 1,
        //     'university_level' => 2,
        //     'book_id' => fake()->numberBetween(1, Book::count()),
        //     'try_number' => fake()->numberBetween(1, 3),
        //     'international_number' => Str::random(20)
        // ]);


        // $try_02_05 = ExamsTry::create([
        //     'exam_session_id' => $examSession_02->id,
        //     'student_name' => 'احمد',
        //     'major_id' => 1,
        //     'university_level' => 2,
        //     'book_id' => fake()->numberBetween(1, Book::count()),
        //     'try_number' => fake()->numberBetween(1, 3),
        //     'international_number' => Str::random(20),
        // ]);

        // //////////////////////////////////////////////////////////////////////////////

        // $examSession_03 = ExamSession::create([
        //     'date' => $examSession_01->date,
        //     'time' => fake()->time('H:0:0'),
        //     'students' => 3,
        //     'second_year_priority' => 1,
        //     'technical_majors_priority' => 1,
        //     'international_number_priority' => 0,
        //     'unique_priority' => 3
        // ]);


        // $try_03_01 = ExamsTry::create([
        //     'exam_session_id' => $examSession_03->id,
        //     'student_name' => fake()->name(),
        //     'major_id' => 10,
        //     'university_level' => 2,
        //     'book_id' => fake()->numberBetween(1, Book::count()),
        //     'try_number' => fake()->numberBetween(1, 3)
        // ]);

        // $try_03_02 = ExamsTry::create([
        //     'exam_session_id' => $examSession_03->id,
        //     'student_name' => fake()->name(),
        //     'major_id' => 1,
        //     'university_level' => 3,
        //     'book_id' => fake()->numberBetween(1, Book::count()),
        //     'try_number' => fake()->numberBetween(1, 3),
        //     'international_number' => Str::random(20)
        // ]);


        // $try_03_03 = ExamsTry::create([
        //     'exam_session_id' => $examSession_03->id,
        //     'student_name' => 'احمد',
        //     'major_id' => 10,
        //     'university_level' => 2,
        //     'book_id' => fake()->numberBetween(1, Book::count()),
        //     'try_number' => fake()->numberBetween(1, 3),
        //     'international_number' => Str::random(20)
        // ]);


        // $try_03_04 = ExamsTry::create([
        //     'exam_session_id' => $examSession_03->id,
        //     'student_name' => fake()->name(),
        //     'major_id' => 1,
        //     'university_level' => 2,
        //     'book_id' => fake()->numberBetween(1, Book::count()),
        //     'try_number' => fake()->numberBetween(1, 3),
        //     'international_number' => Str::random(20)
        // ]);


        // $try_03_05 = ExamsTry::create([
        //     'exam_session_id' => $examSession_03->id,
        //     'student_name' => 'احمد',
        //     'major_id' => 1,
        //     'university_level' => 2,
        //     'book_id' => fake()->numberBetween(1, Book::count()),
        //     'try_number' => fake()->numberBetween(1, 3),
        //     'international_number' => Str::random(20)
        // ]);
    }
}
