<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Utilities\PriorityResult;
use DateTime;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use PHPUnit\Framework\MockObject\DuplicateMethodException;
use Ramsey\Uuid\Type\Time;

class ExamSession extends Model
{
    protected $fillable = ['date', 'time', 'students', 'second_year_priority', 'technical_majors_priority', 'international_number_priority', 'unique_priority'];
    public $timestamps = false;
    use HasFactory;

    public function tries()
    {
        return $this->hasMany(ExamsTry::class);
    }

    // public function strictTries()
    // {
    //     $tries = $this->tries()->get();
    //     if ($this->second_year_priority) {
    //         $tries = $tries->where('university_level', 2);
    //     }
    //     if ($this->technical_majors_priority) {
    //         $tries = $tries->filter(fn ($try) => $try->major()->first()->type == 'ICDL certificate');
    //     }
    //     return $tries;
    // }

    public function strictTries()
    {
        return $this->tries()->get()->filter(fn ($try) => $this->isPriority($try));;
    }

    public function isPriority(ExamsTry $try) {
        $secondYearPriority = $this->second_year_priority ? ($try->university_level == 2) : true;
        $technicalMajorsPriority = $this->technical_majors_priority ? ($try->major()->first()->type == 'ICDL certificate') : true;
        $internationalNumberPriority = $this->international_number_priority ? $try->international_number != null : true;

        return (
            $secondYearPriority
            && $technicalMajorsPriority
            && $internationalNumberPriority
        );
    }

    public function getPriorityData(ExamsTry $try)
    {
        $secondYearPriority = $this->second_year_priority ? ($try->university_level == 2) : true;
        $technicalMajorsPriority = $this->technical_majors_priority ? ($try->major()->first()->type == 'ICDL certificate') : true;
        $internationalNumberPriority = $this->international_number_priority ? $try->international_number != null : true;

        $studentDuplication = $this->getStudentDuplication($try->student_name);

        $priorityResult = new PriorityResult(
            $secondYearPriority,
            $technicalMajorsPriority,
            $internationalNumberPriority,
            $studentDuplication
        );

        return $priorityResult;
    }

    public function getStudentDuplication($name)
    {   

        if (!($this->unique_priority == 3 || $this->unique_priority == 'unique day')) {
            $dup = $this->tries()->get()
                ->countBy(fn ($dupTry) => $dupTry->student_name);
        } else {
            $dup = ExamSession::getTriesForDate($this->date)
                ->countBy(fn ($dupTry) => $dupTry->student_name);
        }

        if ($dup->contains(fn ($value, $key) => $key == $name))
            return $dup[$name];
        return 0;
    }

    public static function getTriesForDate($date)
    {
        
        return (ExamSession::all()
            ->where('date', (gettype($date) == 'string' ? $date : $date->format("Y-m-d")))
            ->map(fn ($session) => $session->tries()->get())
            ->flatten()
            ->collect()
        );
    }

    public function reportTries() {
        $all = $this->tries()->get()->sortBy('date');
        $priority = $all
            ->filter(fn($try) => $try->isPriority())
            ->unique(fn($try) => $try->student_name)
            ->collect();
        $rest = $all->diff($priority);
        $restPriority = $rest->filter(fn($try) => $try->isPriority());
        $restOfRest = $rest->diff($restPriority);
        $result = collect()->concat($priority)->concat($restPriority)->concat($restOfRest);
        return $result->take($this->students);

    }   

}
