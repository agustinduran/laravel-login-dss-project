<?php

namespace App\Http\Controllers;

use App\Dto\SubjectGradeStudentDto;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Repositories\GradeRepository;

class GradeController extends Controller
{
    protected $gradeRepository;

    public function __construct(GradeRepository $gradeRepository)
    {
        $this->gradeRepository = $gradeRepository;
    }
    
    public function index()
    {
        $grades = Grade::with('student', 'subject')->get();
        return view('grades.index', compact('grades'));
    }

    public function store(Request $request)
    {
        $selectedIndexes = $request->input('selected_grades', []);
    
        foreach ($selectedIndexes as $index) {
            // Guardar los datos de la sesión en la base de datos
            $row = session('grades')[$index];
            $this->gradeRepository->createOrUpdateRow(new SubjectGradeStudentDto($row));
        }
    
        // Limpiar los datos de la sesión (notas)
        $request->session()->forget('grades');
    
        return redirect()->route('grades.saved')->with('success', 'Calificaciones seleccionadas guardadas correctamente.');
    }
    


    public function show()
    {
        // Recuperar los datos de la sesión
        $grades = session('grades');
        return view('grades.show', compact('grades'));
    }

    public function showSaved()
    {
        $grades = Grade::with(['student', 'subject'])->get();
        return view('grades.saved', compact('grades'));
    }

}
