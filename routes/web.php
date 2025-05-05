<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    return view('page.admin.index');
});

Route::middleware(['auth', 'role:dinas'])->get('/dinas/dashboard', function () {
    return view('page.dinas.index');
});

Route::middleware(['auth', 'role:user'])->get('/dashboard', function () {
    return view('page.dashboard.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
