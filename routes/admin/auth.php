<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SectionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::delete('/course-categories-destroyMany', [CategoryController::class, 'destroyMany'])->name('categories.destroyMany');
    Route::resource('/course-categories', CategoryController::class);
    Route::get('/', function () {
        return view('admin.pages.dashboard');
    })->name('admin.dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Quan ly khoa hoc
    Route::resource('/courses', CourseController::class);
    Route::get('/courses/update-content/{id}', [CourseController::class, 'updateContent'])->name('courses.update-content');
    Route::delete('/courses-destroyMany', [CourseController::class, 'destroyMany'])->name('courses.destroyMany');
    Route::post('/courses/updateForm/{id}', [CourseController::class, 'updateForm'])->name('courses.updateForm');
    // Quan ly bai giang
    Route::resource('/lessons', LessonController::class);
    Route::post('/lessons/update-order', [LessonController::class, 'updateOrder'])->name('lessons.update-order');
    Route::post('/lessons/updateContent/{id}', [LessonController::class, 'updateContent'])->name('lessons.update-content');
    Route::delete('/lessons-destroyMany', [LessonController::class, 'destroyMany'])->name('lessons.destroyMany');
    // Quan ly bai hoc
    Route::resource('/sections', SectionController::class);
    Route::delete('/sections-destroyMany', [SectionController::class, 'destroyMany'])->name('sections.destroyMany');

});
