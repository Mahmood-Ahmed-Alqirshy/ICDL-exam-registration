<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ExamSession;
use App\Models\ExamsTry;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamsTryController extends Controller
{
    public function create(ExamSession $examSession)
    {
        return view('register', ["majors" => Major::all(), 'books' => Book::all(), 'ExamSessionId' => $examSession->id]);
    }

    public function store(Request $request, ExamSession $examSession)
    {

        DB::beginTransaction();
        if ($examSession->strictTries()->count() >= $examSession->students) {
            DB::rollBack();
            return redirect(route('exams', ['status' => 1]));
        }
        $request->validate([
            'name' => 'required|string',
            'major' => 'required|integer|exists:App\Models\Major,id',
            'level' => 'required|numeric',
            'book' => 'required|integer|exists:App\Models\Book,id',
            'try' => 'required|numeric',
            'number' => 'nullable|string',
            'agree' => 'required|accepted'
        ]);
        if ($examSession->unique_priority == 'none') {
            if ($examSession->getStudentDuplication($request->name) > 1) {
                DB::rollBack();
                return redirect(route('exams', ['status' => 2]));
            }
        } else {
            if ($examSession->getStudentDuplication($request->name) > 0) {
                DB::rollBack();
                return redirect(route('exams', ['status' => 2]));
            }
        }
        $try = ExamsTry::create([
            'exam_session_id' => $examSession->id,
            'student_name' => $request->name,
            'major_id' => $request->major,
            'university_level' => $request->level,
            'book_id' => $request->book,
            'try_number' => $request->try,
            'international_number' => $request->number
        ]);
        DB::commit();

        if ($try->isPriority())
            return redirect(route('exams', ['status' => 3]));
        else
            return redirect(route('exams', ['status' => 4]));
    }
}
