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
        <p class="text-gray-600">Browse our latest products and find what you love.</p>
    </div>

    <!-- Category Filters -->
    <div class="mb-8">
        <div class="flex flex-wrap gap-4">
            <button class="category-btn active px-6 py-2 rounded-full bg-blue-500 text-white hover:bg-blue-600 transition" data-category="all">
                All Products
            </button>
            <button class="category-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition" data-category="fashion">
                Fashion
            </button>
            <button class="category-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition" data-category="culinary">
                Culinary
            </button>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Fashion Products -->
        <div class="product-card bg-white rounded-lg shadow-md overflow-hidden" data-category="fashion">
            <div class="relative">
                <img src="https://images.pexels.com/photos/5632386/pexels-photo-5632386.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Elegant Dress" class="w-full h-64 object-cover">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Elegant Dress</h3>
                <div class="flex items-center mb-2">
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="ml-2 text-gray-600">(4.5)</span>
                </div>
                <p class="text-gray-600 mb-4">$99.99</p>
                <a href="product-fashion.html" class="block text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">View Details</a>
            </div>
        </div>

        <!-- Culinary Products -->
        <div class="product-card bg-white rounded-lg shadow-md overflow-hidden" data-category="culinary">
            <div class="relative">
                <img src="https://images.pexels.com/photos/5632382/pexels-photo-5632382.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Gourmet Coffee" class="w-full h-64 object-cover">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Gourmet Coffee</h3>
                <div class="flex items-center mb-2">
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <span class="ml-2 text-gray-600">(4.0)</span>
                </div>
                <p class="text-gray-600 mb-4">$24.99</p>
                <a href="product-food.html" class="block text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">View Details</a>
            </div>
        </div>

        <!-- More Fashion Products -->
        <div class="product-card bg-white rounded-lg shadow-md overflow-hidden" data-category="fashion">
            <div class="relative">
                <img src="https://images.pexels.com/photos/5632371/pexels-photo-5632371.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Casual Dress" class="w-full h-64 object-cover">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Casual Dress</h3>
                <div class="flex items-center mb-2">
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="ml-2 text-gray-600">(5.0)</span>
                </div>
                <p class="text-gray-600 mb-4">$79.99</p>
                <a href="product-fashion.html" class="block text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">View Details</a>
            </div>
        </div>

        <!-- More Culinary Products -->
        <div class="product-card bg-white rounded-lg shadow-md overflow-hidden" data-category="culinary">
            <div class="relative">
                <img src="https://images.pexels.com/photos/5632398/pexels-photo-5632398.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Artisan Chocolate" class="w-full h-64 object-cover">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Artisan Chocolate</h3>
                <div class="flex items-center mb-2">
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="ml-2 text-gray-600">(4.5)</span>
                </div>
                <p class="text-gray-600 mb-4">$19.99</p>
                <a href="product-food.html" class="block text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">View Details</a>
            </div>
        </div>
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