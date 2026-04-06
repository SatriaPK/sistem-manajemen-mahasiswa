<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MahasiswaController;

Route::get('/mahasiswa',        [MahasiswaController::class, 'index']);
Route::post('/mahasiswa',       [MahasiswaController::class, 'store']);
Route::put('/mahasiswa/{id}',   [MahasiswaController::class, 'update']);
Route::delete('/mahasiswa/{id}',[MahasiswaController::class, 'destroy']);
