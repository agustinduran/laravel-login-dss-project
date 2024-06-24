<?php

namespace App\Dto;

class SubjectGradeStudentDto
{
    public $studentFirstName;
    public $studentLastName;
    public $subjectName;
    public $score;

    public function __construct ($array) {
        $this->studentFirstName = $array['first_name'];
        $this->studentLastName = $array['last_name'];
        $this->subjectName = $array['subject_name'];
        $this->score = $array['score'];
    }
    
}
