<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Artisan;
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
    return redirect('login');
});

Route::view('login', 'auth.login')->name('loginPage');
Route::get('logout', [\App\Http\Controllers\Auth\AuthController::class, "logout"])->name('logout');
Route::view('register', 'auth.register')->name('registerPage');


Route::prefix('admin')->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('subject', 'admin.subject.index')->name('admin.subject');
    Route::view('question', 'admin.question.index')->name('admin.question');
    Route::view('student', 'admin.student.index')->name('admin.student');
    Route::view('student-result/{id}/{std_id}/{slug}', 'admin.result.index')->name('admin.student.result');
});

Route::prefix('student')->group(function () {
    Route::view('profile', 'student.profile')->name('student.profile');
    Route::view('exam/{id}/{slug}', 'student.exam')->name('student.exam');
    Route::view('result/{id}/{slug}', 'student.result')->name('student.result');
});


Route::post('reset-data', function () {
    Artisan::call('migrate:fresh --seed');
});
