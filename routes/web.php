<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\CourseEditController;
use App\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
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
//
//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

// Courses
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');

Route::get('/modules/{module}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
Route::put('/modules/{module}', [ModuleController::class, 'update'])->name('modules.update');

Route::get('/contents/{content}/edit', [ContentController::class, 'edit'])->name('contents.edit');
Route::put('/contents/{content}', [ContentController::class, 'update'])->name('contents.update');



Route::delete('/contents/{content}', [ContentController::class, 'destroy'])->name('contents.destroy');
Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
