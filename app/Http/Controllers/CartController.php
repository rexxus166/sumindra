<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menampilkan halaman keranjang
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('page.cart.index', compact('carts'));
    }

    // Menambah produk ke keranjang
    public function addToCart(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Cek apakah produk sudah ada di keranjang
        $existingCartItem = Cart::where('user_id', Auth::id())
                                ->where('product_id', $product->id)
                                ->first();

        if ($existingCartItem) {
            // Jika ada, update quantity produk yang sudah ada di keranjang
            $existingCartItem->quantity += $request->quantity;
            $existingCartItem->save();
            
            return response()->json(['success' => 'Jumlah produk berhasil diperbarui di keranjang!']);
        }

        // Menyimpan data produk baru di keranjang
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
    
    public function update(Request $request, Cart $cart)
    {
        // Validasi data
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Update jumlah produk di keranjang
        $cart->quantity = $request->quantity;
        $cart->save();

        // Kirimkan response JSON
        return response()->json(['success' => 'Jumlah produk berhasil diperbarui!']);
    }
}