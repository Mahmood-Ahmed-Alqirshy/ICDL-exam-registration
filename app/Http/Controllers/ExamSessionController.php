<?php

namespace App\Http\Controllers;

use App\Exports\ExamSessionsExport;
use App\Models\ExamSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExamSessionController extends Controller
{
    public function index()
    {
        // $availableSessions = DB::select('select exam_sessions.id, date, time, count(exams_tries.exam_session_id) as students from exam_sessions LEFT join exams_tries on exam_sessions.id = exams_tries.exam_session_id where date >= ?  GROUP BY exam_sessions.id HAVING students < 3', [Carbon::now()->format('Y-m-d')]);
        $availableSessions = ExamSession::where('date', '>=', Carbon::now()->format('Y-m-d'))->orderBy('date')->orderBy('time')->get()
            ->filter(function (ExamSession $exam) {
                // $tries = $exam->tries()->get();
                // if($exam->second_year_priority) {
                //     $tries = $tries->where('university_level',2);
                // }
                // if($exam->technical_majors_priority) {
                //     $tries = $tries->filter(fn($try) => $try->major()->first()->type == 2);
                // }
                // return $tries->count() < $exam->students;
                return $exam->strictTries()->count() < $exam->students && $exam->active;
            });
        return view('exams', ['exams' => $availableSessions]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after:' . Carbon::now(),
            'time' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (!strtotime($value)) {
                        $fail("The {$attribute} is invalid.");
                    }
                }
            ],
            'students' => 'required|numeric',
            'uniquePriority' => 'numeric|between:1,3'
        ]);
        ExamSession::create([
            'date' => date("Y-m-d", strtotime($request->date)),
            'time' => date("H:i", strtotime($request->time)),
            'students' => $request->students,
            'second_year_priority' => ($request->secondYearPriority) ? '1' : '0',
            'technical_majors_priority' => ($request->technicalMajorsPriority) ? '1' : '0',
            'international_number_priority' => ($request->internationalNumberPriority) ? '1' : '0',
            'unique_priority' => $request->uniquePriority
        ]);
        return redirect()->route('exams', ['exam' => 'yes']);
    }

    public function export(ExamSession $examSession) {
        return Excel::download(new ExamSessionsExport($examSession->id), 'exam-' . time() . '.xlsx');
    }

    public function close(ExamSession $examSession) {
        $examSession->active = 0;
        $examSession->save();
        return back();
    }

    public function open(ExamSession $examSession) {
        $examSession->active = 1;
        $examSession->save();
        return back();
    }
    
    public function manage() {
        $availableSessions = ExamSession::where('date', '>=', Carbon::now()->format('Y-m-d'))->orderBy('date')->orderBy('time')->get();
        return view('manage', ['exams' => $availableSessions]);
    }

}
