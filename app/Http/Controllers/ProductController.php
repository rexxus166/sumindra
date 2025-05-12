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

    public function create()
    {
        return view('page.toko.produk.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $toko = Toko::where('user_id', Auth::id())->first();

        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $filename  = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('produkImg');
            $image->move($destinationPath, $filename);
            $imagePath = 'produkImg/' . $filename;
        }

        Product::create([
            'user_id'     => Auth::id(),
            'toko_id'     => $toko->id,
            'name'        => $request->name,
            'category'    => $request->category,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => $imagePath,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $produk)
    {
        return view('page.toko.produk.edit', ['product' => $produk]);
    }

    public function update(Request $request, Product $produk)
    {

        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($produk->image && file_exists(public_path($produk->image))) {
                unlink(public_path($produk->image));
            }

            $image     = $request->file('image');
            $filename  = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('produkImg');
            $image->move($destinationPath, $filename);
            $produk->image = 'produkImg/' . $filename;
        }

        $produk->update([
            'toko_id'     => $toko->id,
            'name'        => $request->name,
            'category'    => $request->category,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => $produk->image,
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