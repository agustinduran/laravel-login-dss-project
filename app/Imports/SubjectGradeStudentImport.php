<?php

namespace App\Imports;

use App\Dto\SubjectGradeStudentDto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubjectGradeStudentImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dto = new SubjectGradeStudentDto(
            $row
        );

        return $dto;
    }
}
