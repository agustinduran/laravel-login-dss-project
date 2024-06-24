<?php

namespace App\Repositories;

use App\DTO\SubjectGradeStudentDto;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;

class GradeRepository
{
    public function createOrUpdateRow(SubjectGradeStudentDto $dto)
    {
        // TODO: validar si ya existe nombre y apellido del estudiante
        $student = Student::firstOrCreate([
            'first_name' => $dto->studentFirstName,
            'last_name' => $dto->studentLastName
        ]);

        // TODO: validar si ya existe materia
        $subject = Subject::firstOrCreate([
            'name' => $dto->subjectName
        ]);

        $grade = Grade::updateOrCreate([
            'student_id' => $student->id,
            'subject_id' => $subject->id,
        ], [
            'score' => $dto->score
        ]);

        return $grade;
    }
}
