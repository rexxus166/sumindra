<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order; // Sesuaikan dengan nama model transaksi Anda
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Untuk query database yang lebih kompleks jika diperlukan

class DinasController extends Controller
{
    /**
     * Tampilkan halaman dashboard dinas.
     *
     * @return \Illuminate\View\View
     */

     public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalSellers = User::where('role', 'admin')->count(); // Perhatikan ini jika peran penjual bukan 'admin'
        $totalProducts = Product::count();
        $totalTransactions = Order::count();

        $pendingTransactions = Order::where('status', 'pending')->count();
        $completedTransactions = Order::where('status', 'success')->count();
        $canceledTransactions = Order::where('status', 'cancelled')->count();

        $userRegistrations = User::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $data = [
            'totalUsers' => $totalUsers,
            'totalSellers' => $totalSellers,
            'totalProducts' => $totalProducts,
            'totalTransactions' => $totalTransactions,
            'pendingTransactions' => $pendingTransactions,
            'completedTransactions' => $completedTransactions,
            'canceledTransactions' => $canceledTransactions,
            'userRegistrations' => $userRegistrations,
        ];

        // --- TAMBAHKAN BARIS INI ---
        // dd($data);
        // --- Hapus/komentari baris ini setelah selesai debugging ---

        return view('page.dinas.index', $data);
    }

    // Anda bisa menambahkan method lain untuk manajemen pengguna, penjual, produk, dll.
    // Contoh:
    public function manageUsers()
    {
        $users = User::where('role', 'user')->paginate(10);
        return view('page.dinas.users.index', compact('users'));
    }

    public function manageSellers()
    {
        $sellers = User::where('role', 'admin')->paginate(10);
        return view('page.dinas.sellers.index', compact('sellers'));
    }

    public function manageProducts()
    {
        $products = Product::paginate(10);
        return view('page.dinas.products.index', compact('products'));
    }

    public function manageTransactions()
    {
        $transactions = Order::paginate(10);
        return view('page.dinas.transactions.index', compact('transactions'));
    }
}