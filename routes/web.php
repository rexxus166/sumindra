<?php

use App\Http\Controllers\DinasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');

// Group route untuk user dinas
Route::middleware(['auth', 'role:dinas'])->prefix('dinas')->name('dinas.')->group(function () {
    Route::get('/dashboard', [DinasController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [DinasController::class, 'manageUsers'])->name('users');
    Route::get('/sellers', [DinasController::class, 'manageSellers'])->name('sellers');
    Route::get('/products', [DinasController::class, 'manageProducts'])->name('products');
    Route::get('/transactions', [DinasController::class, 'manageTransactions'])->name('transactions');
    // Tambahkan rute lain untuk manajemen atau laporan
});

// Dashboard User
Route::middleware(['auth', 'role:user'])->name('dashboard')->get('/dashboard', [DashboardController::class, 'index']);

// Fungsi Cari Produk
Route::get('/search', [DashboardController::class, 'search'])->name('search');

// Produk Details
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('produk.details');

// Route untuk menampilkan keranjang
Route::get('/keranjang', [CartController::class, 'index'])->middleware(['auth', 'role:user'])->name('cart');

// Route untuk menambah produk ke keranjang
Route::post('/keranjang/tambah', [CartController::class, 'addToCart'])->middleware(['auth', 'role:user'])->name('cart.add');

// Route untuk menghapus produk dari keranjang
Route::delete('/keranjang/hapus/{cartId}', [CartController::class, 'destroy'])->name('cart.delete');

// Update Cart Langsung
Route::post('/keranjang/update/{cart}', [CartController::class, 'update'])->name('cart.update');

// Otomatis Clear
Route::post('/keranjang/clear', [CartController::class, 'clear'])->name('cart.clear');

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

// Pesanan
Route::middleware(['auth', 'role:user'])->group(function() {
    // Halaman Settings
    Route::get('/pesanan', [OrderController::class, 'index'])->name('pesanan');
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
    
    // Rute untuk menampilkan semua pesanan
    Route::get('/store/pesanan', [OrderController::class, 'listOrder'])->name('list.pesanan');

    // Rute untuk menampilkan detail pesanan berdasarkan order_id
    Route::get('/store/pesanan/{order_id}', [OrderController::class, 'show'])->name('pesanan.show');
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
