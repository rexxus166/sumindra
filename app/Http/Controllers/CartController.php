<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menambah produk ke keranjang
    public function addToCart(Request $request)
    {
        // \Log::info('Masuk ke method addToCart');
        
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Menyimpan data produk di keranjang
        $cartItem = Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
        ]);

        // Mengirimkan response JSON
        if ($cartItem) {
            return response()->json(['success' => 'Produk berhasil ditambahkan ke keranjang!']);
        } else {
            return response()->json(['error' => 'Terjadi kesalahan saat menambahkan produk ke keranjang'], 500);
        }
    }

    // Menampilkan halaman keranjang
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('page.cart.index', compact('carts'));
    }
}