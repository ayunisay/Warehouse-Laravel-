<?php

use App\Http\Controllers\BarangkeluarController;
use App\Http\Controllers\PermintaanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;   
use App\Http\Controllers\RiwayatController;

//user
//view
Route::get('/dashboard-user', [DashboardController::class, 'dashboardUser'])->name('dashboarduser');
Route::get('/stok', [StokController::class, 'index'])->name('stok');
Route::get('/permintaan-barang', [PermintaanController::class, 'index'])->name('permintaan');
Route::get('/barang-keluar', [BarangkeluarController::class, 'index'])->name('barangkeluar');
Route::get('/laporan-kerusakan', [LaporanController::class, 'index'])->name('laporankerusakan');

//admin
//view
Route::get('/dashboard-admin', [DashboardController::class, 'dashboardAdmin'])->name('dashboardadmin');
Route::get('/kelola-stok', [StokController::class, 'index2'])->name('kelolastok');
Route::get('/kelola-supplier', [SupplierController::class, 'index'])->name('kelolasupplier');
Route::get('/kelola-user', [UserController::class, 'index'])->name('kelolauser');
Route::get('/riwayat-keluar', [RiwayatController::class, 'index'])->name('riwayatkeluar');
Route::get('/kelola-permintaan', [PermintaanController::class, 'index2'])->name('kelolapermintaan');
