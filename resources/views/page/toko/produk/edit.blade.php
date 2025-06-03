@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="min-h-screen flex">
    @include('layouts.sidebarToko')

    <div class="flex-1 p-6">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Edit Produk</h1>

        <form action="{{ route('produk.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-xl">
            @csrf
            @method('PUT') <!-- Menambahkan metode PUT untuk update -->

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="mt-1 block w-full border rounded-md p-2">
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category" id="category" class="mt-1 block w-full border rounded-md p-2">
                    <option value="{{ $product->category }}" selected>{{ $product->category }}</option>
                </select>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required class="mt-1 block w-full border rounded-md p-2">
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required class="mt-1 block w-full border rounded-md p-2">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full border rounded-md p-2">{{ old('description', $product->description) }}</textarea>
            </div>

            <div id="variants-container">
                <label for="variants" class="block text-sm font-medium text-gray-700">Varian</label>
                <div class="flex space-x-4">
                    @if(is_array($product->variants)) <!-- Cek apakah variants sudah array -->
                        @foreach($product->variants as $variant)
                            <input type="text" name="variants[]" value="{{ $variant }}" class="mt-1 block w-full border rounded-md p-2" placeholder="Varian">
                        @endforeach
                    @else
                        <input type="text" name="variants[]" value="{{ $product->variants }}" class="mt-1 block w-full border rounded-md p-2" placeholder="Varian">
                    @endif
                </div>
                <button type="button" id="add-variant" class="text-blue-500 mt-2">Tambah Varian</button>
            </div>            

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Foto Produk</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full">
                @if($product->image)
                    <img src="{{ asset($product->image) }}" alt="Gambar Produk" class="mt-2 w-32">
                @endif
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Perbarui Produk
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