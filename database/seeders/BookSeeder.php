<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                    // $table->enum('book',['Word','Excel','PowerPoint','Access','Computer Essentials','Internet Essentials','Online Collaboration']);

        Book::create(['name' => 'اساسيات الحاسوب بإستخدام الويندوز', 'type' => 1]);
        Book::create(['name' => 'معالج النصوص (Word)', 'type' => 1]);
        Book::create(['name' => 'العروض التقديمية (Power Point)', 'type' => 1]);
        Book::create(['name' => 'الجداول الإلكترونية (Excel)', 'type' => 2]);
        Book::create(['name' => 'قواعد البيانات (Access)', 'type' => 2]);
        Book::create(['name' => 'اساسيات الانترنت', 'type' => 1]);
        Book::create(['name' => 'التعاون عبر الانترنت', 'type' => 2]);
    }
}
