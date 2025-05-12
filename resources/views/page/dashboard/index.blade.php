@extends('layouts.app')
@section('title','Dashboard')
@section('style')
<!-- <link rel="stylesheet" href="{{ asset('css/page/account/style.css') }}"> -->
@endsection
@section('content')
<!-- Navigation Bar -->
@include('layouts.navigation')

<!-- Dashboard Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Welcome back, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-600">Mau buka toko?
            <a href="{{ route('buka.toko.pemberitahuan') }}"><b>Klik disini</b></a>
        </p>
    </div>

    <!-- Category Filters -->
    <div class="mb-8">
        <div class="flex flex-wrap gap-4">
            <button class="category-btn active px-6 py-2 rounded-full bg-blue-500 text-white hover:bg-blue-600 transition" data-category="all">
                All Products
            </button>
            <button class="category-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition" data-category="pakaian">
                Fashion
            </button>
            <button class="category-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition" data-category="makanan">
                Culinary
            </button>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse ($products as $item)
            <div class="product-card bg-white rounded-lg shadow-md overflow-hidden" data-category="{{ $item->category }}">
                <div class="relative">
                    <img src="{{ $item->image ?? 'https://via.placeholder.com/400x300' }}" alt="{{ $item->name }}" class="w-full h-64 object-cover">
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $item->name }}</h3>
                    <p class="text-gray-600 mb-2">Toko: {{ $item->toko->nama_toko ?? 'Tidak diketahui' }}</p>
                    <p class="text-gray-600 mb-4">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    <a href="/produk/{{ $item->id }}" class="block text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-4 text-center text-gray-500">
                Tidak ada produk tersedia.
            </div>
        @endforelse
    </div>

    <!-- Load More Button -->
    <div class="mt-8 text-center">
        <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded-full hover:bg-gray-300 transition">
            Load More Products
        </button>
    </div>
</div>

<!-- Enhanced Footer -->
@include('layouts.footer')

@endsection
@section('script')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category filtering
            const categoryButtons = document.querySelectorAll('.category-btn');
            const productCards = document.querySelectorAll('.product-card');

            categoryButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const category = button.getAttribute('data-category');
                    
                    // Update active button
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('bg-blue-500', 'text-white');
                        btn.classList.add('bg-gray-200', 'text-gray-700');
                    });
                    button.classList.remove('bg-gray-200', 'text-gray-700');
                    button.classList.add('bg-blue-500', 'text-white');

                    // Filter products
                    productCards.forEach(card => {
                        if (category === 'all' || card.getAttribute('data-category') === category) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
@endsection