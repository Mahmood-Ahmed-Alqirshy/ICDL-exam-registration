<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->enum("registeration_type", ['Just exam', 'course and exam']);
            $table->integer('course_number');
            $table->string('passport', 255);
            $table->string('university_card', 255);
            $table->string('arabic_name', 255);
            $table->string('english_name', 255);
            $table->foreignId('major_id');
            $table->date('birth_date');
            $table->enum("resident", ['inside aden', 'outside aden']);
            $table->string('phone', 45);
            $table->enum("sex", ['male', 'female']);
            $table->enum("language", ['ar', 'en']);
            $table->enum('exam_type', ['start', 'ICDL certificate']);
            $table->timestamps();
            
            $table->foreign('major_id')->references('id')->on('majors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
