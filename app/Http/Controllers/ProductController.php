<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $produk = Product::where('user_id', Auth::id())->latest()->get();
        return view('page.toko.produk.index', compact('produk'));
    }

    public function show($slug)
    {
        $produk = Product::with('toko')->where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('category', $produk->category)
            ->where('id', '!=', $produk->id)
            ->take(4)
            ->get();

        return view('page.toko.produk.show', compact('produk', 'relatedProducts'));
    }

    public function create()
    {
        // Ambil kategori dari tabel toko berdasarkan user yang sedang login
        $toko = Toko::where('user_id', Auth::id())->first();
        $kategori = $toko ? $toko->kategori_toko : ''; // Ambil kategori_toko dari toko yang terkait dengan user

        return view('page.toko.produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        $toko = Toko::where('user_id', Auth::id())->first();

        // Validasi input
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'variants'    => 'nullable|array',
            'variants.*'  => 'nullable|string|max:255',
        ]);

        // Mengelola gambar produk
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('produkImg');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true); // Membuat folder jika belum ada
                }
                $image->move($destinationPath, $filename);
                $imagePath = 'produkImg/' . $filename;
            }
        }

        // Simpan data produk ke database
        Product::create([
            'user_id'     => Auth::id(),
            'toko_id'     => $toko->id,
            'name'        => $request->name,
            'category'    => $request->category,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => $imagePath,
            'variants'    => json_encode($request->variants),  // Menyimpan variants sebagai JSON
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $produk)
    {
        return view('page.toko.produk.edit', ['product' => $produk]);
    }

    public function update(Request $request, Product $produk)
    {
        // Validasi data yang diterima
        $request->validate([
            'name'          => 'required|string|max:255',
            'category'      => 'required|string|max:100',
            'description'   => 'nullable|string',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'variants'      => 'nullable|array',     // Validasi untuk varian
            'variants.*'    => 'nullable|string|max:255', // Validasi untuk setiap varian
        ]);

        // Mengelola gambar produk jika ada perubahan
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($produk->image && file_exists(public_path($produk->image))) {
                unlink(public_path($produk->image));
            }

            $image      = $request->file('image');
            $filename   = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('produkImg');
            $image->move($destinationPath, $filename);
            $produk->image = 'produkImg/' . $filename;
        }

        // Perbarui data produk
        $produk->update([
            'toko_id'       => $produk->toko_id,
            'name'          => $request->name,
            'category'      => $request->category,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock,
            'variants'      => json_encode($request->variants), // Update variants sebagai JSON
            'image'         => $produk->image, // Gunakan gambar yang baru jika ada
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $produk)
    {
        $this->authorize('delete', $produk);

        if ($produk->image && file_exists(public_path($produk->image))) {
            unlink(public_path($produk->image));
        }

        $produk->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}