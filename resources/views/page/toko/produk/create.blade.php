@extends('layouts.app')
@section('title', 'Tambah Produk')

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
                    <option value="pakaian" {{ old('category', $kategori) == 'pakaian' ? 'selected' : '' }}>Pakaian</option>
                    <option value="makanan" {{ old('category', $kategori) == 'makanan' ? 'selected' : '' }}>Makanan</option>
                </select>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="price" id="price" required class="mt-1 block w-full border rounded-md p-2">
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
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

            <div id="variants-container">
                <label for="variants" class="block text-sm font-medium text-gray-700">Varian</label>
                <div class="flex space-x-4">
                    <input type="text" name="variants[]" class="mt-1 block w-full border rounded-md p-2" placeholder="Varian pertama">
                </div>
                <button type="button" id="add-variant" class="text-blue-500 mt-2">Tambah Varian</button>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Simpan Produk
            </button>
        </form>
    </div>
</div>

<script>
    document.getElementById('add-variant').addEventListener('click', function() {
        const container = document.getElementById('variants-container');
        const newVariant = document.createElement('div');
        newVariant.classList.add('flex', 'space-x-4');
        newVariant.innerHTML = '<input type="text" name="variants[]" class="mt-1 block w-full border rounded-md p-2" placeholder="Varian">';
        container.appendChild(newVariant);
    });
</script>
@endsection