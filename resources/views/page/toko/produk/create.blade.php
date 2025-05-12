@extends('layouts.app')
@section('title','Tambah Produk')

@section('content')
<div class="min-h-screen flex">
    @include('layouts.sidebarToko')

    <div class="flex-1 p-6">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Tambah Produk</h1>

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-xl">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full border rounded-md p-2">
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category" id="category" class="mt-1 block w-full border rounded-md p-2">
                    <option value="pakaian">Pakaian</option>
                    <option value="makanan">Makanan</option>
                </select>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="price" id="price" required class="mt-1 block w-full border rounded-md p-2">
            </div>

            <div>
                <label for="stock_status" class="block text-sm font-medium text-gray-700">Status Stok</label>
                <input type="number" name="stock" id="stock" required class="mt-1 block w-full border rounded-md p-2">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full border rounded-md p-2"></textarea>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Foto Produk</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full">
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Simpan Produk
            </button>
        </form>
    </div>
</div>
@endsection