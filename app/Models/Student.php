<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['registeration_type','course_number','passport','university_card','arabic_name','english_name','major_id','birth_date','resident','phone','sex','language','exam_type'];
    use HasFactory;
}
