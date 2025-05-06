<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->name('admin.dashboard')->get('/admin/dashboard', function () {
    return view('page.admin.index');
});

Route::middleware(['auth', 'role:dinas'])->name('dinas.dashboard')->get('/dinas/dashboard', function () {
    return view('page.dinas.index');
});

Route::middleware(['auth', 'role:user'])->name('dashboard')->get('/dashboard', function () {
    return view('page.dashboard.index');
});

Route::middleware(['auth', 'role:user'])->group(function() {
    // Halaman Profil
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
    // Update Profil
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');
    // Update alamat
    Route::put('/profil/alamat', [ProfileController::class, 'updateAlamat'])->name('profil.updateAlamat');
});

require __DIR__.'/auth.php';
