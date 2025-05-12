@extends('layouts.app')
@section('title', 'Detail Produk')

@section('content')
@include('layouts.navigation')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
    <div class="bg-white rounded-lg shadow-md p-6">
        <img src="{{ asset($produk->image ?? 'https://via.placeholder.com/400x300') }}" alt="{{ $produk->name }}" class="w-full h-64 object-cover">
        
        <div class="mt-6">
            <h2 class="text-2xl font-bold">{{ $produk->name }}</h2>
            <p class="text-gray-600 mt-2">Kategori: {{ $produk->category }}</p>
            <p class="text-gray-600 mt-2">Toko: {{ $produk->toko->nama_toko ?? 'Tidak diketahui' }}</p>
            <p class="text-xl text-blue-500 font-semibold mt-4">Rp {{ number_format($produk->price, 0, ',', '.') }}</p>
            <p class="mt-4">{{ $produk->description }}</p>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection