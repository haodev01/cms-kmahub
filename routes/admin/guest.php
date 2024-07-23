<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('admin.handleLogin');
Route::get('/register', [AuthController::class, 'register'])->name('admin.register');
