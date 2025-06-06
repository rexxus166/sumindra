<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;

class DashboardController extends Controller
{
    // Menampilkan halaman Wellcome
    public function welcome()
    {
        // Ambil semua Produk
        $products = Product::with('toko')->latest()->get();
        return view('welcome', compact('products'));
    }

    public function index()
    {
        // Ambil jumlah produk di keranjang untuk pengguna yang sedang login
        $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
        
        // Ambil semua Produk
        $products = Product::with('toko')->latest()->get();
        
        // Kirim cartCount ke view
        return view('page.dashboard.index', compact('products', 'cartCount'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        // Cari produk yang cocok dengan kata kunci pencarian
        $products = Product::with('toko')
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->get();

        // Ambil jumlah produk di keranjang untuk pengguna yang sedang login
        $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
        
        // Kirim hasil pencarian dan cartCount ke view
        return view('page.dashboard.index', compact('products', 'cartCount'));
    }
}