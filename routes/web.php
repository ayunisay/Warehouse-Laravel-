<?php

use App\Http\Controllers\BarangkeluarController;
use App\Http\Controllers\PermintaanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DashboardController;


Route::get('/dashboard-user', [DashboardController::class, 'dashboardUser'])->name('dashboarduser');
Route::get('/dashboard-admin', [DashboardController::class, 'dashboardAdmin'])->name('dashboardadmin');
Route::get('/stok', [StokController::class, 'index'])->name('stok');
Route::get('/stok', [StokController::class, 'index'])->name('stok');
Route::get('/permintaan-barang', [PermintaanController::class, 'index'])->name('permintaan');
Route::get('/barang-keluar', [BarangkeluarController::class, 'index'])->name('barangkeluar');
