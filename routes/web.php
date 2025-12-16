<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/update', [AdminController::class, 'update'])->name('admin.update');
});
Route::get('/admin/password', [AdminController::class, 'editPassword'])->name('admin.password');
Route::put('/admin/password', [AdminController::class, 'updatePassword'])->name('admin.password.update');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/print', [PrintController::class, 'index'])->name('print.index');
Route::get('/print/cetak', [PrintController::class, 'cetak'])->name('print.print');

Route::resource('pendaftaran',PendaftaranController::class);
Route::get('/pendaftaran/{id}/bayar', [PendaftaranController::class, 'bayar'])->name('pendaftaran.bayar');
Route::post('/pendaftaran/{id}/konfirmasi', [PendaftaranController::class, 'konfirmasi'])->name('pendaftaran.konfirmasi');

Route::get('/siswa', [SiswaController::class, 'sesi'])->name('siswa.sesi');
Route::get('/siswa/{id}/index', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/{id}/detail', [SiswaController::class, 'detail'])->name('siswa.detail');
Route::get('/siswa/{id}/cetak', [SiswaController::class, 'cetak'])->name('siswa.cetak');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// // Halaman dashboard (contoh)
// Route::get('/dashboard', function () {
//     return view('main.dashboard');
// })->middleware('auth')->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'edit'])->name('auth.edit');
    Route::post('/profile', [AuthController::class, 'update'])->name('auth.update');
});
