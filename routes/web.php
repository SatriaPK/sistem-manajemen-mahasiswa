<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', fn() => redirect('/login'));

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Protected
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('fakultas', FakultasController::class);
    Route::resource('prodi', ProdiController::class)->except(['show']);
    Route::resource('mahasiswa', MahasiswaController::class);
});
