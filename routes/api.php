<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LayananController;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\PakaianController;
use App\Http\Controllers\Api\TransaksiController;

// Membuat semua rute CRUD otomatis (GET, POST, PUT, DELETE)
Route::apiResource('layanan', LayananController::class);
Route::apiResource('pelanggan', PelangganController::class);
Route::apiResource('pakaian', PakaianController::class);
Route::apiResource('transaksi', TransaksiController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
