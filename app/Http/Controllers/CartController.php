<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            'varian' => 'nullable|string',  // Validasi varian (jika ada)
        ]);

        // Ambil produk berdasarkan ID
        $product = Product::findOrFail($request->product_id);
        // Coba akses variants di sini untuk memicu accessor
        $dummy = $product->variants;
        Log::info('Tipe data variants setelah akses:', [gettype($product->variants)]);
        Log::info('Isi variants setelah akses:', [$product->variants]);
        $variants = $product->variants;

        // Jika produk memiliki varian, periksa apakah varian yang dipilih valid
        if ($request->varian) {
            $variantsString = $product->variants;
            $variants = json_decode($variantsString, true);

            Log::info('Tipe data variants setelah decode:', [gettype($variants)]);
            Log::info('Isi variants setelah decode:', [$variants]);

            if (!is_array($variants) || !in_array($request->varian, $variants)) {
                return response()->json(['error' => 'Varian yang dipilih tidak valid!'], 400);
            }
        }

        // Cek apakah produk sudah ada di keranjang
        $existingCartItem = Cart::where('user_id', Auth::id())
                                ->where('product_id', $product->id)
                                ->where('varian', $request->varian)  // Cek juga varian yang dipilih
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
            'varian' => $request->varian,  // Menyimpan varian jika ada
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

    public function destroy($cartId)
    {
        $cart = Cart::where('id', $cartId)->where('user_id', Auth::id())->first();

        if ($cart) {
            $cart->delete();
            return response()->json(['success' => 'Produk berhasil dihapus dari keranjang']);
        }

        return response()->json(['error' => 'Produk tidak ditemukan'], 404);
    }

    public function clear(Request $request)
{
    try {
        // Cek user yang sedang login
        $user = auth()->user();

        // Cek apakah user memiliki keranjang
        if ($user->cart()->count() > 0) {
            $user->cart()->delete();  // Menghapus semua item dalam keranjang

            // Log untuk memastikan proses berjalan
            // Log::info('Keranjang berhasil dikosongkan untuk user ID: ' . $user->id);
            
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Keranjang kosong']);
    } catch (\Exception $e) {
        // Jika terjadi kesalahan, log pesan error
        Log::error('Gagal mengosongkan keranjang: ' . $e->getMessage());
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
}
}