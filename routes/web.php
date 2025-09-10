<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('register', [UserController::class, 'register']);
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->name('logout');

// Protect Projects & Tasks with auth middleware
Route::middleware(['auth'])->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::resource('projects.tasks', TaskController::class);
});



