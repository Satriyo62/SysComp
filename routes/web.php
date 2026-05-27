<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KontakController;

// ========== ROUTE LOGIN (WAJIB ADA AGAR MIDDLEWARE TIDAK ERROR) ==========
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ========== HALAMAN DEPAN ==========
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ========== ALUR KONSULTASI USER (5 STEP) ==========
Route::get('/konsultasi', [KonsultasiController::class, 'create'])->name('konsultasi.create');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'kirimPesan'])->name('kontak.kirim');
Route::post('/konsultasi/biodata', [KonsultasiController::class, 'storeBiodata'])->name('konsultasi.storeBiodata');
Route::get('/konsultasi/{konsultasi}/gejala', [KonsultasiController::class, 'pilihGejala'])->name('konsultasi.gejala');
Route::post('/konsultasi/{konsultasi}/proses', [KonsultasiController::class, 'prosesKonsultasi'])->name('konsultasi.proses');
Route::get('/konsultasi/{konsultasi}/hasil', [KonsultasiController::class, 'hasil'])->name('konsultasi.hasil');
Route::get('/konsultasi/{konsultasi}/detail-perhitungan', [KonsultasiController::class, 'detailPerhitungan'])->name('konsultasi.detail_perhitungan');
Route::get('/konsultasi/{konsultasi}/cetak', [KonsultasiController::class, 'cetak'])->name('konsultasi.cetak');

// ========== AREA ADMIN (DILINDUNGI MIDDLEWARE) ==========
Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Data Kerusakan
    Route::resource('kerusakan', KerusakanController::class);
    
    // Data Gejala
    Route::resource('gejala', GejalaController::class);
    
    // Basis Pengetahuan / Rule
    Route::get('/rule', [RuleController::class, 'index'])->name('rule.index');
    Route::post('/rule', [RuleController::class, 'store'])->name('rule.store');
    Route::delete('/rule/{kerusakanId}/{gejalaId}', [RuleController::class, 'destroy'])->name('rule.destroy');
    
    // Riwayat Konsultasi
    Route::get('/riwayat', [KonsultasiController::class, 'index'])->name('riwayat.index');

    // Ubah Password Admin
    Route::get('/ubah-password', [App\Http\Controllers\PasswordController::class, 'showChangeForm'])->name('ubah_password');
    Route::post('/ubah-password', [App\Http\Controllers\PasswordController::class, 'update'])->name('ubah_password.update');
});