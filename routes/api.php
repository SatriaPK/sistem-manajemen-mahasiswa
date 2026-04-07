<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MahasiswaController;

Route::get('/mahasiswa',        [MahasiswaController::class, 'index']);
Route::post('/mahasiswa',       [MahasiswaController::class, 'store']);
Route::get('/mahasiswa/{mahasiswa}',   [MahasiswaController::class, 'show']);
Route::put('/mahasiswa/{mahasiswa}',   [MahasiswaController::class, 'update']);
Route::delete('/mahasiswa/{mahasiswa}',[MahasiswaController::class, 'destroy']);
