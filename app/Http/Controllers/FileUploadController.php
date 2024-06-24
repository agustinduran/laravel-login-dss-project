<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SubjectGradeStudentImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx,csv|max:10240',
        ]);

        $data = Excel::toArray(new SubjectGradeStudentImport, $request->file('file'));
        // Guardo datos en la sesión
        session(['grades' => $data[0]]);

        return redirect()->route('grades.show');
    }
}

