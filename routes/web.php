<?php

use App\Http\Controllers\ExamSessionController;
use App\Http\Controllers\ExamsTryController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
})->name('home');

Route::get("/course" , [StudentController::class, 'index'])->name("course");
Route::post("/course/store" , [StudentController::class, 'store'])->name("course.store");
Route::get("/exams" , [ExamSessionController::class, 'index'])->name("exams");
Route::view("/exams/create" , 'create')->name("create")->middleware('auth');
Route::post("/exams/store" , [ExamSessionController::class, 'store'])->name("store")->middleware('auth');
Route::get("/exams/manage" , [ExamSessionController::class, 'manage'])->name('manage')->middleware('auth');
Route::get("/exams/manage/close/{examSession}" , [ExamSessionController::class, 'close'])->name('close')->middleware('auth');
Route::get("/exams/manage/open/{examSession}" , [ExamSessionController::class, 'open'])->name('open')->middleware('auth');
Route::get("/exams/manage/export/{examSession}" , [ExamSessionController::class, 'export'])->name('export')->middleware('auth');
Route::get("/exams/{examSession}" , [ExamsTryController::class,'create']);
Route::post("/try/store/{examSession}" , [ExamsTryController::class, 'store'])->name("try.store");
Route::view("/login" , 'login')->name("login");
Route::post("/login/ckeck" , [UserController::class,'login'])->name("login.ckeck");