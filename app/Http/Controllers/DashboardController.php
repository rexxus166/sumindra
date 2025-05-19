<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil jumlah produk di keranjang untuk pengguna yang sedang login
        $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
        
        // Ambil semua Produk
        $products = Product::with('toko')->latest()->get();
        
        // Kirim cartCount ke view
        return view('page.dashboard.index', compact('products', 'cartCount'));
    }
}
