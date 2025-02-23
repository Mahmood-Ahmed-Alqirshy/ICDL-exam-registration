<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamsTry extends Model
{
    use HasFactory;
    protected $fillable = ['exam_session_id','student_name','major_id','university_level','book_id','try_number','international_number'];

    public function major() {
        return $this->belongsTo(Major::class);
    }

    public function exam_session() {
        return $this->belongsTo(ExamSession::class);
    }

    public function isPriority() {
        return $this->exam_session()->first()->isPriority($this);
    }

    public function getPriorityData() {
        return $this->exam_session()->first()->getPriorityData($this);
    }

    public function getStudentDuplication()
    {
        return $this->exam_session()->first()->getStudentDuplication($this->student_name);
    }
}
