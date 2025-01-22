<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\Route;


// 'home' it's function
Route::get('/', [\App\Http\Controllers\HomeController::class, 'home']);

Route::view('/template', 'template');

// Make group because they access same in controller user
Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
    // access login form
    Route::get('/login', 'login')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
    // proses login
    Route::post('/login', 'doLogin')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
    // when click Logout will be direct to User controller with function doLogout to proses logout.
    Route::post('/logout', 'doLogout')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
});

// because we have middleware same we used that

Route::controller(\App\Http\Controllers\TodolistController::class)->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class])->group(function () {
    Route::get('/todolist', 'todolist');
    Route::post('/todolist', 'addTodo');
    Route::post('/todolist/{id}/delete', 'removeTodo');
});
