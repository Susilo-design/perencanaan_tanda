<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('user.dashboard');
    }
    return view('landing');
})->name('landing');

Route::get('/register', function () {
    return view('auth.register');
})->name('register.view')->middleware('guest');

Route::get('/login', function () {
    return view('auth.login');
})->name('login.view')->middleware('guest');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [ProjectController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

    Route::get('/schedules', [ScheduleController::class, 'userSchedules'])->name('schedules.index');


    // Join Project - join pakai join_code
    Route::get('/join', [ProjectController::class, 'joinForm'])->name('joinForm');
    Route::post('/join', [JoinController::class, 'join'])->name('join');

    Route::prefix('project')->name('project.')->group(function () {
        // Index - list semua project user login
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        // Create - form buat project baru
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        // Store - simpan project baru
        Route::post('/store', [ProjectController::class, 'store'])->name('store');

        // Show - detail project tertentu
        Route::get('/{project}', [ProjectController::class, 'show'])->name('show');

        // Edit - form edit project
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('edit');

        // Update - simpan perubahan project
        Route::put('/{project}', [ProjectController::class, 'update'])->name('update');

        // Destroy - hapus project
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('destroy');



        // Task routes nested under project
        Route::prefix('{project}/tasks')->name('tasks.')->group(function () {
            Route::get('/', [TaskController::class, 'index'])->name('index');
            Route::get('/create', [TaskController::class, 'create'])->name('create');
            Route::post('/', [TaskController::class, 'store'])->name('store');
            Route::get('/{task}', [TaskController::class, 'show'])->name('show');
            Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('edit');
            Route::put('/{task}', [TaskController::class, 'update'])->name('update');
            Route::patch('/{task}/toggle', [TaskController::class, 'toggleStatus'])->name('toggle');
            Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');
        });


    });
});
