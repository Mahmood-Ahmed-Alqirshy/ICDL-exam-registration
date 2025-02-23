<?php

namespace App\Exports;

use App\Models\ExamSession;
use App\Models\Major;
use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExamSessionsExport implements FromCollection, ShouldAutoSize, WithHeadings
{

    private $examSession;

    function __construct($id) {
        $this->examSession = ExamSession::find($id);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return (
            $this->examSession->reportTries()->map(function($exam) {
                $exam->major_id = Major::find($exam->major_id)->name;
                $exam->book_id = Book::find($exam->book_id)->name;
                unset($exam->id);
                unset($exam->exam_session_id);
                unset($exam->try_number);
                unset($exam->international_number);
                unset($exam->updated_at);
                return $exam;
            })
        );
    }

    public function headings(): array
    {
        return [
            'الاسم',
            'التخصص',
            'السنة الدراسية',
            'الكتاب',
            'تاريخ التسجيل',
        ];
    }
}
