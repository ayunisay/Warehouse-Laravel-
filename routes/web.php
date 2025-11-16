<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\auth\UserController;
use App\Http\Controllers\BarangkeluarController;
use App\Http\Controllers\KelolaUserController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\AuditController;

Route::get('/', function () {
    // Arahkan langsung ke halaman login jika belum login
    return redirect()->route('login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::get('/logout', 'logout')->name('logout');
});

//user view
Route::middleware(['auth'])->group(function() {
    Route::middleware(['role:user'])->group(function() {
        Route::get('/user-dashboard', [DashboardController::class, 'dashboardUser'])->name('dashboardUser');

        //barang keluar routes
        Route::get('/barang-keluar', [BarangkeluarController::class, 'index'])->name('barangKeluar');
        //tambah barang keluar
        Route::post('/tambah-barang-keluar', [BarangkeluarController::class, 'tambahBarangKeluarSubmit'])->name('tambahBarangKeluarSubmit');
        //edit barang keluar
        Route::get('/edit-barang-keluar/{id}', [BarangkeluarController::class, 'editBarangKeluar'])->name('editBarangKeluar');
        Route::post('/edit-barang-keluar/{id}', [BarangkeluarController::class, 'editBarangKeluarSubmit'])->name('editBarangKeluarSubmit');
        //hapus barang keluar
        Route::delete('/hapus-barang-keluar/{id}', [BarangkeluarController::class, 'hapusBarangKeluar'])->name('hapusBarangKeluar');
        //api get item details
        Route::get('/api/item-details/{id}', [BarangkeluarController::class, 'getItemDetails'])->name('getItemDetails');

        //laporan kerusakan routes
        Route::get('/laporan-kerusakan', [LaporanController::class, 'index'])->name('laporanKerusakan');
        //tambah laporan kerusakan
        Route::post('/tambah-laporan-kerusakan', [LaporanController::class, 'tambahLaporanSubmit'])->name('tambahLaporanSubmit');
        //edit laporan kerusakan
        Route::get('/edit-laporan-kerusakan/{id}', [LaporanController::class, 'editLaporan'])->name('editLaporan');
        Route::post('/edit-laporan-kerusakan/{id}', [LaporanController::class, 'editLaporanSubmit'])->name('editLaporanSubmit');
        //hapus laporan kerusakan
        Route::delete('/hapus-laporan-kerusakan/{id}', [LaporanController::class, 'hapusLaporan'])->name('hapusLaporan');

        //lihat stok routes
        Route::get('/lihat-stok', [StokController::class, 'index'])->name('lihatStok');

        //permintaan routes
        Route::get('/permintaan-barang', [PermintaanController::class, 'index'])->name('permintaanBarang');
        //tambah permintaan
        Route::post('/tambah-permintaan', [PermintaanController::class, 'tambahPermintaanSubmit'])->name('tambahPermintaanSubmit');
        //hapus permintaan
        Route::delete('/hapus-permintaan/{id}', [PermintaanController::class, 'hapusPermintaan'])->name('hapusPermintaan');
    });


//admin view
    Route::middleware(['role:admin'])->group(function() {
        Route::get('/admin-dashboard', [DashboardController::class, 'dashboardAdmin'])->name('dashboardAdmin');

        //permintaan routes
        Route::get('/kelola-permintaan', [PermintaanController::class, 'index2'])->name('kelolaPermintaan');
        //hapus permintaan
        Route::delete('/hapus-permintaan/{id}', [PermintaanController::class, 'hapusPermintaan2'])->name('hapusPermintaan');
        //status permintaan
        Route::post('/approve-permintaan/{id}', [PermintaanController::class, 'approvePermintaan'])->name('approvePermintaan');
        Route::post('/reject-permintaan/{id}', [PermintaanController::class, 'rejectPermintaan'])->name('rejectPermintaan');
        
        //admin laporan kerusakan
        Route::get('/kelola-laporan-kerusakan', [LaporanController::class, 'index2'])->name('kelolaLaporanKerusakan');
        //status laporan kerusakan
        Route::post('/approve-laporan/{id}', [LaporanController::class, 'approveLaporan'])->name('approveLaporan');
        Route::post('/reject-laporan/{id}', [LaporanController::class, 'rejectLaporan'])->name('rejectLaporan');
        //hapus laporan kerusakan
        Route::delete('/hapus-laporan/{id}', [LaporanController::class, 'hapusLaporanAdmin'])->name('hapusLaporanAdmin');
        
        //supplier routes
        Route::get('/kelola-supplier', [SupplierController::class, 'index'])->name('kelolaSupplier');
        //tambah supplier
        Route::post('/kelola-supplier/tambah', [SupplierController::class, 'tambahSupplierSubmit'])->name('tambahSupplierSubmit');
        //edit supplier
        Route::get('/kelola-supplier/edit/{id}', [SupplierController::class, 'editSupplier'])->name('editSupplier');
        Route::post('/kelola-supplier/edit/{id}', [SupplierController::class, 'editSupplierSubmit'])->name('editSupplierSubmit');
        //hapus supplier
        Route::delete('/kelola-supplier/hapus/{id}', [SupplierController::class, 'hapusSupplier'])->name('hapusSupplier');

        //user management routes
        Route::get('/kelola-user', [KelolaUserController::class, 'index'])->name('kelolaUser');
        //tambah user
        Route::post('/kelola-user/tambah', [KelolaUserController::class, 'tambahUserSubmit'])->name('tambahUserSubmit');
        //edit user
        Route::get('/kelola-user/edit/{id}', [KelolaUserController::class, 'editUser'])->name('editUser');
        Route::post('/kelola-user/edit/{id}', [KelolaUserController::class, 'editUserSubmit'])->name('editUserSubmit');
        //hapus user
        Route::delete('/kelola-user/hapus/{id}', [KelolaUserController::class, 'deleteUser'])->name('deleteUser');

        //riwayat barang keluar routes
        Route::get('/riwayat', [BarangkeluarController::class, 'index2'])->name('riwayat');

        //stok routes
        Route::get('/kelola-stok', [StokController::class, 'index2'])->name('kelolaStok');
        //tambah stok
        Route::post('/kelola-stok/tambah', [StokController::class, 'tambahStokSubmit'])->name('tambahStokSubmit');
        //edit stok
        Route::get('/edit-stok/{id}', [StokController::class, 'editStok'])->name('editStok');
        Route::post('/edit-stok/{id}', [StokController::class, 'editStokSubmit'])->name('editStokSubmit');
        //hapus stok
        Route::delete('/hapus-stok/{id}', [StokController::class, 'hapusStok'])->name('hapusStok');
        
        //kategori routes
        //tambah kategori
        Route::get('/tambah-kategori', [KategoriController::class, 'viewKategori'])->name('tambahKategori');
        Route::post('/tambah-kategori', [KategoriController::class, 'tambahKategoriSubmit'])->name('tambahKategoriSubmit');
        //hapus kategori
        Route::delete('/hapus-kategori/{id}', [KategoriController::class, 'hapusKategori'])->name('hapusKategori');

        //rak routes
        //tambah rak
        Route::get('/tambah-rak', [RakController::class, 'viewRak'])->name('tambahRak');
        Route::post('/tambah-rak', [RakController::class, 'tambahRakSubmit'])->name('tambahRakSubmit');
        //hapus rak
        Route::delete('/hapus-rak/{id}', [RakController::class, 'hapusRak'])->name('hapusRak');

        //generate laporan routes (exports)
        Route::get('/generate-laporan', [\App\Http\Controllers\ExportController::class, 'generateView'])->name('generateLaporan');
        Route::get('/export/stok', [\App\Http\Controllers\ExportController::class, 'exportStok'])->name('exportStok');
        Route::get('/export/barang-keluar', [\App\Http\Controllers\ExportController::class, 'exportBarangKeluar'])->name('exportBarangKeluar');
        Route::get('/export/permintaan', [\App\Http\Controllers\ExportController::class, 'exportPermintaan'])->name('exportPermintaan');
        Route::get('/export/laporan-kerusakan', [\App\Http\Controllers\ExportController::class, 'exportLaporanKerusakan'])->name('exportLaporanKerusakan');

        //audit trail routes
        Route::get('/audit-trail', [AuditController::class, 'auditTrail'])->name('auditTrail');
        Route::post('/audit-trail/delete-all', [AuditController::class, 'deleteAllLogs'])->name('deleteAllLogs');
    });
});

