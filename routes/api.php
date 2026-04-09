<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\FakultasController;
use App\Http\Controllers\Api\ProdiController;

// Public
Route::post('/login', [AuthController::class, 'login']);

// Protected
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::apiResource('mahasiswa', MahasiswaController::class)->names('api.mahasiswa');
    Route::apiResource('fakultas', FakultasController::class, [
        'parameters' => ['fakultas' => 'fakultas'],
        'names'      => 'api.fakultas',
    ]);
    Route::apiResource('prodi', ProdiController::class)->except(['show'])->names('api.prodi');
});
