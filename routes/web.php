<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamQuestionController;
use App\Http\Controllers\ExamResultController;

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

Route::get('/', [ExamController::class, 'index'])->name('exams');
Route::get('exam/get', [ExamController::class, 'get'])->name('getExam');
Route::post('exam/save', [ExamController::class, 'save'])->name('saveExam');
Route::delete('exam/delete', [ExamController::class, 'delete'])->name('deleteExam');

Route::get('questions/{id}', [ExamQuestionController::class, 'index'])->name('questions');
Route::get('question/get', [ExamQuestionController::class, 'get'])->name('getQuestion');
Route::post('question/save', [ExamQuestionController::class, 'save'])->name('saveQuestion');
Route::delete('question/delete', [ExamQuestionController::class, 'delete'])->name('deleteQuestion');

Route::get('attend/{id}', [ExamResultController::class, 'index'])->name('attend');
Route::post('attend/user/save', [ExamResultController::class, 'saveUser'])->name('saveUser');
Route::get('start/exam/{resultId}', [ExamResultController::class,'startExam'])->name('startExam');
Route::post('exam/submit', [ExamResultController::class, 'submitExam'])->name('submitExam');
Route::get('thank-you/{resultId}', [ExamResultController::class,'thankYou'])->name('thankYou');
Route::get('results', [ExamResultController::class,'results'])->name('results');


