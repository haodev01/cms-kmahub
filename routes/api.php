<?php

use App\Http\Controllers\Api\CourseApiController;
use App\Http\Controllers\AuthApiController;
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

Route::get("/courses",[CourseApiController::class, 'getAll'] );
Route::get("/courses/{slug}",[CourseApiController::class, 'detail']);
Route::post('register', [AuthApiController::class,'register']);
Route::post('login', [AuthApiController::class,'login']);
Route::post('logout',  [AuthApiController::class,'logout']);
Route::post('refresh',  [AuthApiController::class,'refresh']);
Route::get('profile',  [AuthApiController::class,'me']);