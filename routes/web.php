<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/template', 'template');

// Make group because they access same in controller user
Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
    // access login form
    Route::get('/login', 'login');
    // proses login
    Route::post('/login', 'doLogin');
    // when click Logout will be direct to User controller with function doLogout to proses logout.
    Route::post('/logout', 'doLogout');
});
