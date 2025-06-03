<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Setup Midtrans Config
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function beliSekarang(Request $request, $id)
    {
        $productData = $request->input('product');
        $product = Product::findOrFail($productData['id']);
        $varian = $productData['varian'];

        // Buat order_id unik
        $orderId = 'ORDER-' . uniqid();
        $totalAmount = $product->price * $productData['quantity']; // Sesuaikan jika ada quantity di request
        $items = [[
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $productData['quantity'],
            'variant' => $varian ?? 'Tidak ada varian', // Sertakan varian di sini
        ]];

        // Simpan order ke database dengan status 'pending'
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_id' => $orderId,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'products' => json_encode($items),
        ]);

        // Set data transaksi untuk Midtrans
        $transactionDetails = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalAmount,
            ],
            'item_details' => $items,
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($transactionDetails);

        return response()->json(['snap_token' => $snapToken]);
    }

    public function create(Request $request)
    {
        $items = $request->items; // Menerima data produk dari keranjang

        if (empty($items)) {
            return response()->json(['error' => 'Keranjang Anda kosong.'], 400);
        }

        // Hitung total harga
        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity']; // Menghitung total berdasarkan harga dan jumlah
        }

        // Order ID yang unik
        $orderId = 'ORDER-' . uniqid();

        // Simpan transaksi ke tabel orders
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_id' => $orderId,
            'total_amount' => $total,
            'status' => 'pending', // Status awal adalah pending
            'products' => json_encode($items),
        ]);

        // Setup parameter untuk Snap API Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $total,
            ],
            'item_details' => $items,
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        try {
            // Dapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);

            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal membuat token pembayaran.'], 500);
        }
    }

    // Callback Midtrans
    public function callback(Request $request)
    {
        // Verifikasi signature dan update status transaksi
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                // Update status transaksi jika berhasil
                $transaction = Order::where('order_id', $request->order_id)->first();
                if ($transaction) {
                    $transaction->status = 'success';
                    $transaction->save();
                } else {
                    Log::error("Transaction not found: {$request->order_id}");
                    return response()->json(['error' => 'Transaction not found'], 404);
                }
            }
        }
    }
}