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

Route::get('statistics', [\App\Http\Controllers\Admin\DashboardController::class, 'statistics']);


Route::apiResource('users', \App\Http\Controllers\Admin\UserController::class);
Route::apiResource('subjects', \App\Http\Controllers\Admin\SubjectController::class);
Route::post('subjects/bulk_actions', [\App\Http\Controllers\Admin\SubjectController::class, "bulkActions"]);
Route::apiResource('questions', \App\Http\Controllers\Admin\QuestionController::class);
Route::post('questions/bulk_actions', [\App\Http\Controllers\Admin\QuestionController::class, "bulkActions"]);
