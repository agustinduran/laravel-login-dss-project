<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload');

Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
Route::get('/grades/show', [GradeController::class, 'show'])->name('grades.show');
Route::post('/grades/store', [GradeController::class, 'store'])->name('grades.store');
Route::get('/grades/saved', [GradeController::class, 'showSaved'])->name('grades.saved');

require __DIR__.'/auth.php';
