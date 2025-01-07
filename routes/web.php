<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/template', 'template');

// Make group because they access same in controller user
Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
    // access login form
    Route::get('/login', 'login')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
    // proses login
    Route::post('/login', 'doLogin')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
    // when click Logout will be direct to User controller with function doLogout to proses logout.
    Route::post('/logout', 'doLogout');
});
