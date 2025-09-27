<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/register', function () {
    return view('auth.register');
})->name('register.view');

Route::get('/login', function () {
    return view('auth.login');
})->name('login.view');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('projects')->name('projects.')->group(function () {

    // Index - list semua project user login
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/dashboard', [ProjectController::class, 'dashboard'])->name('dashboard');
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

    // Join Project - join pakai join_code
    Route::post('/join', [ProjectController::class, 'join'])->name('join');
});
