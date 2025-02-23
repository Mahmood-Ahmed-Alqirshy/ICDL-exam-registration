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
        Schema::create('exams_tries', function (Blueprint $table) {
            $table->id();
            $table->string('student_name',155);
            $table->foreignId('exam_session_id');
            $table->foreignId('major_id');
            $table->unsignedInteger('university_level');
            $table->foreignId('book_id');
            $table->unsignedInteger('try_number');
            $table->string('international_number',45)->nullable();
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('major_id')->references('id')->on('majors');
            $table->foreign('exam_session_id')->references('id')->on('exam_sessions');        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams_tries');
    }
};
