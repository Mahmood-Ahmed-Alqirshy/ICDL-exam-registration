<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Major::create(['name' => 'تقنية معلومات', 'type' => 2]);
        Major::create(['name' => 'نظم معلومات', 'type' => 2]);
        Major::create(['name' => 'الأمن سبراني', 'type' => 2]);
        Major::create(['name' => 'جرافيكس والوسائط المتعددة', 'type' => 2]);
        Major::create(['name' => 'طب بشري', 'type' => 1]);
        Major::create(['name' => 'طب أسنان', 'type' => 1]);
        Major::create(['name' => 'بكالوريوس مختبرات طبية', 'type' => 1]);
        Major::create(['name' => 'فني مختبرات طبية', 'type' => 1]);
        Major::create(['name' => 'بكالوريوس صيدلة', 'type' => 1]);
        Major::create(['name' => 'فني صيدلة', 'type' => 1]);
        Major::create(['name' => 'التغذية العلاجية والحميات', 'type' => 1]);
        Major::create(['name' => 'الهندسة الطبية', 'type' => 1]);
        Major::create(['name' => 'الهندسة المعمارية', 'type' => 1]);
        Major::create(['name' => 'هندسة الميكاترونكس', 'type' => 1]);
        Major::create(['name' => 'إدارة أعمال', 'type' => 1]);
        Major::create(['name' => 'محاسبة', 'type' => 1]);
        Major::create(['name' => 'دراسات إسلامية', 'type' => 1]);
        Major::create(['name' => 'إدارة أعمال باللغة الإنجليزية', 'type' => 1]);
        Major::create(['name' => 'اللغة الإنجليزية (ترجمة)', 'type' => 1]);
        Major::create(['name' => 'هندسة مدنية', 'type' => 1]);
        Major::create(['name' => 'إدارة دولية', 'type' => 1]);
    }
}
