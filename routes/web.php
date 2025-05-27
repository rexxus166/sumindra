<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');

Route::middleware(['auth', 'role:dinas'])->name('dinas.dashboard')->get('/dinas/dashboard', function () {
    return view('page.dinas.index');
});

// Dashboard User
Route::middleware(['auth', 'role:user'])->name('dashboard')->get('/dashboard', [DashboardController::class, 'index']);

// Fungsi Cari Produk
Route::get('/search', [DashboardController::class, 'search'])->name('search');

// Show Produk
Route::get('/produk/{id}', [ProductController::class, 'show'])->middleware(['auth', 'role:user'])->name('produk.show');

// Route untuk menampilkan keranjang
Route::get('/keranjang', [CartController::class, 'index'])->middleware(['auth', 'role:user'])->name('cart');

// Route untuk menambah produk ke keranjang
Route::post('/keranjang/tambah', [CartController::class, 'addToCart'])->name('cart.add');
// Update Cart Langsung
Route::post('/keranjang/update/{cart}', [CartController::class, 'update'])->name('cart.update');

// Route untuk membuat pembayaran
Route::post('/payment/create', [PaymentController::class, 'create'])->name('payment.create');

Route::post('/checkout/{id}', [PaymentController::class, 'beliSekarang'])->name('payment.single');

// Route untuk halaman pembayaran berhasil
Route::get('/keranjang/success', [PaymentController::class, 'finishPayment'])->name('payment.finish');

// Profile
Route::middleware(['auth', 'role:user'])->group(function() {
    // Halaman Profil
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
    Route::put('/profil/update-all', [ProfileController::class, 'updateAll'])->name('profil.updateAll');
    Route::delete('/profil/hapus', [ProfileController::class, 'destroy'])->name('profil.destroy');
});

// Settings
Route::middleware(['auth', 'role:user'])->group(function() {
    // Halaman Settings
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
    // Update Password
    Route::put('/settings/password', [ProfileController::class, 'updatePassword'])->name('settings.password.update');
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
    // Produk
    Route::resource('store/produk', ProductController::class)->names([
        'index' => 'produk.index',
        'create' => 'produk.create',
        'store' => 'produk.store',
        'edit' => 'produk.edit',
        'update' => 'produk.update',
        'destroy' => 'produk.destroy',
    ]);
});

require __DIR__.'/auth.php';
