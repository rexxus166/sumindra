<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product; // Tambahkan import untuk model Product

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->get();

        foreach ($orders as $order) {
            $productsData = json_decode($order->products);
            $productsWithImage = [];
            if ($productsData) {
                foreach ($productsData as $productData) {
                    $product = Product::find($productData->id);
                    if ($product) {
                        $productData->image = asset($product->image); // Tambahkan properti image dengan path asset
                        $productsWithImage[] = $productData;
                    } else {
                        $productsWithImage[] = $productData; // Tetap sertakan jika produk tidak ditemukan
                    }
                }
            }
            $order->products = $productsWithImage;
        }

        return view('page.pesanan.index', compact('user', 'orders'));
    }
}