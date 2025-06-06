<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Toko;
use Illuminate\Support\Facades\DB;

class TokoController extends Controller
{
    public function bukaTokoPemberitahuan()
    {
        // Pastikan user yang klik adalah role 'user'
        if (Auth::user()->role !== 'user') {
            return redirect()->route('dashboard'); // Redirect ke dashboard jika bukan user
        }

        // Tampilkan halaman pemberitahuan untuk membuka toko
        return view('page.toko.pemberitahuan');
    }

    public function bukaToko()
    {
        // Pastikan hanya user dengan role 'user' yang dapat membuka toko
        if (Auth::user()->role !== 'user') {
            abort(403, 'Unauthorized action.');
        }

        // Ubah role menjadi admin
        $user = Auth::user();
        $user->role = 'admin';
        $user->save();

        // Redirect ke halaman untuk membuat toko
        return redirect()->route('toko.create');
    }

    /**
     * Menampilkan form untuk membuat toko.
     */
    public function create()
    {
        // Cek apakah user yang login adalah admin dan belum memiliki toko
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Cek apakah admin sudah memiliki toko
        $user = Auth::user();
        if ($user->toko) {
            return redirect()->route('toko.index'); // Jika sudah punya toko, langsung ke dashboard
        }

        return view('page.toko.create'); // Halaman untuk membuat toko
    }

    /**
     * Menyimpan toko yang baru dibuat.
     */
    public function store(Request $request)
    {
        // Validasi input toko
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'kategori_toko' => 'required|in:pakaian,makanan',  // Misalnya ada 2 kategori
        ]);

        // Membuat toko baru
        $toko = Toko::create([
            'nama_toko' => $request->nama_toko,
            'kategori_toko' => $request->kategori_toko,
            'user_id' => Auth::id(),
        ]);

        // Setelah berhasil membuat toko, arahkan ke dashboard toko
        return redirect()->route('toko.index')->with('success', 'Toko berhasil dibuat!');
    }

    /**
     * Menampilkan dashboard toko.
     */
    public function index()
    {
        $user = Auth::user();

        // Pastikan user yang login adalah admin yang sudah memiliki toko
        if ($user->role !== 'admin' || !$user->toko) {
            abort(403, 'Unauthorized action.');
        }

        // Total Penjualan (sum of total_amount in orders)
        $totalPenjualan = \App\Models\Order::where('status', 'success')->sum('total_amount');

        // Total Pesanan (count of all orders)
        $totalPesanan = \App\Models\Order::count();

        // Total Pelanggan (distinct users)
        $totalPelanggan = \App\Models\Order::distinct('user_id')->count();

        // Total Produk (count distinct product names, ignoring variants)
        $totalProduk = \App\Models\Order::get()->flatMap(function($order) {
            return collect(json_decode($order->products, true))
                    ->pluck('name') // Ambil nama produk saja
                    ->unique(); // Mengambil produk yang unik
        })->count();

        // Pesanan Terbaru (latest orders)
        $pesananTerbaru = \App\Models\Order::latest()->take(5)->get();

        return view('page.toko.index', compact('user', 'totalPenjualan', 'totalPesanan', 'totalPelanggan', 'totalProduk', 'pesananTerbaru'));
    }
    // public function index()
    // {
    //     $user = Auth::user();

    //     // Pastikan user yang login adalah admin yang sudah memiliki toko
    //     if ($user->role !== 'admin' || !$user->toko) {
    //         abort(403, 'Unauthorized action.');
    //     }

    //     return view('page.toko.index', compact('user'));
    // }

    /**
     * Menampilkan halaman produk.
     */
    public function produk()
    {
        $user = Auth::user();

        // Pastikan user yang login adalah admin yang sudah memiliki toko
        if ($user->role !== 'admin' || !$user->toko) {
            abort(403, 'Unauthorized action.');
        }

        return view('page.toko.produk.index', compact('user'));
    }
}