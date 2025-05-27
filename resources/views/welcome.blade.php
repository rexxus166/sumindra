@extends('layouts.app')
@section('title','Dashboard')
@section('style')
<!-- <link rel="stylesheet" href="{{ asset('css/page/account/style.css') }}"> -->
@endsection
@section('content')
<!-- Navigation Bar -->
@include('layouts.navigation')

<!-- Dashboard Content -->
<div class="mt-16 relative">

    <div class="mt-16 relative">
        <img src="https://images.pexels.com/photos/5632397/pexels-photo-5632397.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Hero Banner" class="w-full h-[400px] object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Selamat Datang di Sumindra</h1>
                <p class="text-xl text-white">Temukan Produk Menakjubkan</p>
            </div>
        </div>
    </div>

    <!-- Category Filters -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
        <div class="flex flex-wrap justify-center gap-4">
            <button class="category-btn active px-6 py-2 rounded-full bg-blue-500 text-white hover:bg-blue-600 transition" data-category="all">
                Semua Produk
            </button>
            <button class="category-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition" data-category="pakaian">
                Pakaian
            </button>
            <button class="category-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition" data-category="makanan">
                Makanan
            </button>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="product-grid">
            @forelse ($products as $index => $item)
                <div class="product-card bg-white rounded-lg shadow-md overflow-hidden {{ $index < 4 ? 'block' : 'hidden' }}" data-category="{{ $item->category }}">
                    <div class="relative">
                        <img src="{{ $item->image ?? 'https://via.placeholder.com/400x300' }}" alt="{{ $item->name }}" class="w-full h-64 object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">{{ $item->name }}</h3>
                        <p class="text-gray-600 mb-2">Toko : <b>{{ $item->toko->nama_toko ?? 'Tidak diketahui' }}</b></p>
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
    </div>

    <!-- Load More Button -->
    <div id="load-more-container" class="mt-8 text-center">
        <button id="load-more" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-full hover:bg-gray-300 transition">
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
        const productCards = document.querySelectorAll('.product-card');
        const loadMoreButton = document.getElementById('load-more');
        let productCount = 4;  // Menampilkan 4 produk pertama

        // Menyembunyikan produk lebih dari 4
        productCards.forEach((product, index) => {
            if (index >= 4) {
                product.classList.add('hidden');
            }
        });

        // Menampilkan 4 produk lebih banyak saat scroll ke bawah
        window.addEventListener('scroll', function() {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                loadMoreProducts();
            }
        });

        // Fungsi untuk menampilkan 4 produk berikutnya
        function loadMoreProducts() {
            const totalProducts = productCards.length;
            productCount += 4;  // Tambah 4 produk

            productCards.forEach((product, index) => {
                if (index < productCount) {
                    product.classList.remove('hidden');
                    product.classList.add('block');
                }
            });

            // Jika semua produk sudah ditampilkan, sembunyikan tombol Load More
            if (productCount >= totalProducts) {
                loadMoreButton.style.display = 'none';
            }
        }

        // Klik tombol Load More
        loadMoreButton.addEventListener('click', function() {
            loadMoreProducts();
        });

        // Category filtering
        const categoryButtons = document.querySelectorAll('.category-btn');
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