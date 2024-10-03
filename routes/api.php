<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, "login"]);
Route::post('register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);
Route::post('update-profile', [\App\Http\Controllers\Auth\AuthController::class, 'updateProfile'])->middleware(['auth:sanctum']);
Route::get('fetch-me', [\App\Http\Controllers\Auth\AuthController::class, 'fetchMe'])->middleware(['auth:sanctum']);

Route::get('statistics', [\App\Http\Controllers\Admin\DashboardController::class, 'statistics']);


Route::apiResource('users', \App\Http\Controllers\Admin\UserController::class);
Route::apiResource('subjects', \App\Http\Controllers\Admin\SubjectController::class);
Route::post('subjects/bulk_actions', [\App\Http\Controllers\Admin\SubjectController::class, "bulkActions"]);
Route::apiResource('questions', \App\Http\Controllers\Admin\QuestionController::class);
Route::post('questions/bulk_actions', [\App\Http\Controllers\Admin\QuestionController::class, "bulkActions"]);


Route::get('get-all-exams', [\App\Http\Controllers\Student\ExamController::class, "getAllExams"])->middleware(['auth:sanctum']);
Route::get('get-all-questions-by-subject/{id}', [\App\Http\Controllers\Student\ExamController::class, "getAllQuestionsBySubject"])->middleware(['auth:sanctum']);
Route::post('attempt-exam', [\App\Http\Controllers\Student\ExamController::class, "attemptExam"])->middleware(['auth:sanctum']);
Route::get('exam-result-by-subject/{id}', [\App\Http\Controllers\Student\ExamController::class, "examResultBySubject"])->middleware(['auth:sanctum']);
Route::get('get-all-exams-by-student-id/{id}', [\App\Http\Controllers\Student\ExamController::class, "getAllExamByStudentID"]);
Route::get('get-result-by-student-id/{id}/{stdID}', [\App\Http\Controllers\Student\ExamController::class, "getExamResultByStudentID"]);
