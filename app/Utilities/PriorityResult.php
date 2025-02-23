<?php

namespace App\Utilities;

class PriorityResult {

    private $secondYearPriority;
    private $technicalMajorsPriority;
    private $internationalNumberPriority;
    private $studentDuplication;

    function __construct($secondYearPriority, $technicalMajorsPriority, $internationalNumberPriority, $studentDuplication) {
         $this->secondYearPriority = $secondYearPriority;
         $this->technicalMajorsPriority = $technicalMajorsPriority;
         $this->internationalNumberPriority = $internationalNumberPriority;
         $this->studentDuplication = $studentDuplication;
    }

    public function getSecondYearPriority() {
        return $this->secondYearPriority;
    }

    public function getTechnicalMajorsPriority() {
        return $this->technicalMajorsPriority;
    }

    public function getInternationalNumberPriority() {
        return $this->internationalNumberPriority;
    }

    public function isPriority() {
        return (
            $this->secondYearPriority
            && $this->technicalMajorsPriority
            && $this->internationalNumberPriority
        );
    }

    public function getStudentDuplication() {
        return $this->studentDuplication;
    }
}