<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TokoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth', 'role:admin'])->name('admin.dashboard')->get('/admin/dashboard', function () {
//     return view('page.admin.index');
// });

Route::middleware(['auth', 'role:dinas'])->name('dinas.dashboard')->get('/dinas/dashboard', function () {
    return view('page.dinas.index');
});

Route::middleware(['auth', 'role:user'])->name('dashboard')->get('/dashboard', function () {
    return view('page.dashboard.index');
});

// Profile
Route::middleware(['auth', 'role:user'])->group(function() {
    // Halaman Profil
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
    // Update Profil
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');
    // Update alamat
    Route::put('/profil/alamat', [ProfileController::class, 'updateAlamat'])->name('profil.updateAlamat');
});

// Buka Toko
Route::middleware(['auth', 'role:user'])->group(function() {
    // Route untuk "Buka Toko"
    Route::get('/buka-toko', [TokoController::class, 'bukaToko'])->name('buka.toko');
    Route::get('/pemberitahuan', [TokoController::class, 'bukaTokoPemberitahuan'])->name('buka.toko.pemberitahuan');
});

// Toko (Admin)
Route::middleware(['auth', 'role:admin'])->group(function() {
    // Jika admin belum memiliki toko, tampilkan form untuk membuat toko
    Route::get('/store/create', [TokoController::class, 'create'])->name('toko.create');
    // Simpan toko baru
    Route::post('/store', [TokoController::class, 'store'])->name('toko.store');
    // Dashboard toko setelah pembuatan toko
    Route::get('/store/dashboard', [TokoController::class, 'index'])->name('toko.index');
});

require __DIR__.'/auth.php';
