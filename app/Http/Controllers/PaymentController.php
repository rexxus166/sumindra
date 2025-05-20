<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Setup Midtrans Config
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function create(Request $request)
{
    // Ambil keranjang berdasarkan user yang sedang login
    $cart = Cart::where('user_id', auth()->id())->get();

    // Pastikan keranjang tidak kosong
    if ($cart->isEmpty()) {
        return response()->json(['error' => 'Keranjang Anda kosong.'], 400);
    }

    // Hitung total harga
    $total = 0;
    foreach ($cart as $item) {
        $total += $item->product->price * $item->quantity;
    }

    // Order ID yang unik
    $orderId = 'ORDER-' . uniqid();

    // Simpan transaksi ke tabel orders
    $order = Order::create([
        'user_id' => auth()->id(),
        'order_id' => $orderId,
        'total_amount' => $total,
        'status' => 'pending', // Status awal adalah pending
    ]);

    // Setup parameter untuk Snap API Midtrans
    $params = [
        'transaction_details' => [
            'order_id' => $orderId,
            'gross_amount' => $total, // Total yang akan dibayar
        ],
        'customer_details' => [
            'first_name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ],
    ];

    try {
        // Dapatkan Snap Token dari Midtrans
        $snapToken = Snap::getSnapToken($params);

        // Mengembalikan Snap Token ke frontend
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
                $transaction = UserTransaction::where('transaction_id', $request->order_id)->first();
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