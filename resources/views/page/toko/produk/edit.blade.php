@extends('layouts.app')
@section('title','Edit Produk')

@section('content')
<div class="min-h-screen flex">
    @include('layouts.sidebarToko')

    <div class="flex-1 p-6">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Edit Produk</h1>

        <form action="{{ route('produk.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-xl">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" name="name" value="{{ $product->name }}" required class="mt-1 block w-full border rounded-md p-2">
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                <input type="text" name="category" value="{{ $product->category }}" class="mt-1 block w-full border rounded-md p-2">
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="price" value="{{ $product->price }}" required class="mt-1 block w-full border rounded-md p-2">
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                <input type="number" name="stock" value="{{ $product->stock }}" class="mt-1 block w-full border rounded-md p-2">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="4" class="mt-1 block w-full border rounded-md p-2">{{ $product->description }}</textarea>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Foto Produk</label>
                @if($product->image)
                    <img src="{{ asset($product->image) }}"
                    alt="Gambar Produk"
                    class="w-48 h-48 object-cover rounded-md shadow-md border border-gray-300">
                @endif <br>
                <input type="file" name="image" class="mt-1 block w-full border rounded-md p-2">
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Update Produk
            </button>
        </form>
    </div>
</div>
@endsection