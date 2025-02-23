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
        Schema::create('exam_sessions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->integer('students');
            $table->boolean('second_year_priority')->default(0);
            $table->boolean('technical_majors_priority')->default(0);
            $table->boolean('international_number_priority')->default(0);
            $table->enum('unique_priority',['none', 'unique session', 'unique day']);
            $table->boolean('active')->default(1);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_sessions');
    }
};
