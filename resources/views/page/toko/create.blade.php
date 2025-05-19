@extends('layouts.app')

@section('title', 'Buat Toko')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
    <h1 class="text-3xl font-semibold text-gray-800">Buat Toko</h1>

    <form action="{{ route('toko.store') }}" method="POST" class="mt-8">
        @csrf
        <div class="space-y-4">
            <div class="form-group">
                <label for="nama_toko" class="block text-lg font-medium text-gray-700">Nama Toko</label>
                <input type="text" id="nama_toko" name="nama_toko" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('nama_toko')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="kategori_toko" class="block text-lg font-medium text-gray-700">Kategori Toko</label>
                <select id="kategori_toko" name="kategori_toko" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="pakaian">Fashion</option>
                    <option value="makanan">Makanan</option>
                </select>
                @error('kategori_toko')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">Buat Toko</button>
        </div>
    </form>
</div>
@endsection