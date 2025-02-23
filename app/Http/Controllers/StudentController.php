<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        return view('course',["majors" => Major::all()]);
    }

    public function store(Request $request) {
        $request->validate([
            'type' => 'required|numeric|between:1,2',
            'courseNumber' => 'required|numeric',
            'passport' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf',
            'card' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf',
            'ARname.*' => 'required|alpha|max:45',
            'ENname.*' => 'required|alpha|max:45',
            'major' => 'required|integer|exists:App\Models\Major,id',
            'Bday' => 'required|date',
            'resident' => 'required|numeric|between:1,2',
            'phone' => 'required|string|max:45',
            'sex' => 'required|numeric|between:1,2',
            'lang' => 'required|numeric|between:1,2',
            'exam' => 'required|numeric|between:1,2',
            'agree' => 'required|accepted'
        ]);
        Student::create([
            'registeration_type' => $request->type,
            'course_number' => $request->courseNumber,
            'passport' => $request->file('passport')->store('passports'),
            'university_card' => $request->file('card')->store('university cards'),
            'arabic_name' => implode(' ', $request->ARname),
            'english_name' => implode(' ', $request->ENname),
            'major_id' => $request->major,
            'birth_date' => $request->Bday,
            'resident' => $request->resident,
            'phone' => $request->phone,
            'sex' => $request->sex,
            'language' => $request->lang,
            'exam_type' => $request->exam
            
        ]);
        return redirect(route('exams', ['student' => 'yes']));
    }
}
