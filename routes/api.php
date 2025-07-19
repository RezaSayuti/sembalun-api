<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PengunjungController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KunjunganController;

// ---------------------------
// Autentikasi
// ---------------------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Logout membutuhkan token (akses login)
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// ---------------------------
// Route testing API
// ---------------------------
Route::get('/ping', function () {
    return response()->json(['message' => 'API aktif']);
});

// ---------------------------
// Route Pengunjung (CRUD)
// ---------------------------
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pengunjung', [PengunjungController::class, 'index']);
    Route::get('/pengunjung/{id}', [PengunjungController::class, 'show']);
    Route::post('/pengunjung', [PengunjungController::class, 'store']);
    Route::put('/pengunjung/{id}', [PengunjungController::class, 'update']);
    Route::delete('/pengunjung/{id}', [PengunjungController::class, 'destroy']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/kunjungan', [KunjunganController::class, 'index']);
    Route::get('/kunjungan/{id}', [KunjunganController::class, 'show']);
    Route::post('/kunjungan', [KunjunganController::class, 'store']);
    Route::put('/kunjungan/{id}', [KunjunganController::class, 'update']);
    Route::delete('/kunjungan/{id}', [KunjunganController::class, 'destroy']);
});
