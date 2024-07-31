<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest.admin']], function () {
    require_once 'guest.php';
});
Route::group(['middleware' => ['auth.admin']], function () {
    require_once 'auth.php';
});

