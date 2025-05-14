@extends('layouts.app')
@section('title', 'Detail Produk')

@section('content')
@include('layouts.navigation')

    <!-- Product Details Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <!-- Product Image Gallery -->
                <div class="md:w-1/2">
                    <div class="relative h-96 md:h-full">
                        <img src="{{ asset($produk->image) }}" alt="Product Image" class="w-full h-full object-cover">
                        <!-- Thumbnail Navigation -->
                        <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2">
                            <button class="w-3 h-3 rounded-full bg-white opacity-50"></button>
                            <button class="w-3 h-3 rounded-full bg-white"></button>
                            <button class="w-3 h-3 rounded-full bg-white opacity-50"></button>
                        </div>
                    </div>
                </div>

                <!-- Product Information -->
                <div class="md:w-1/2 p-8">
                    <div class="mb-4">
                        <span class="text-sm text-blue-500 font-semibold">Kategori -> {{ ucwords($produk->category) }}</span>
                        <h1 class="text-3xl font-bold text-gray-900 mt-2">{{ $produk->name }}</h1>
                    </div>                    
                    <p class="text-gray-600 mb-6">
                        {{-- {{ $produk->description }} --}}
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae dolor nemo dolores suscipit adipisci magni soluta nihil culpa maiores natus officiis ea deserunt necessitatibus, beatae animi voluptate delectus sunt temporibus.
                    </p>

                    <div class="mb-6">
                        {{-- Bintang --}}
                        {{-- <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="ml-2 text-gray-600">(4.5/5)</span>
                        </div> --}}
                        <p class="text-3xl font-bold text-gray-900 mb-4">Rp. {{ number_format($produk->price, 0, ',', '.') }}</p>
                    </div>

                    <!-- Size Selection -->
                    <!-- <div class="mb-6">
                        <h3 class="text-sm font-semibold text-gray-900 mb-2">Size</h3>
                        <div class="flex gap-2">
                            <button class="px-4 py-2 border rounded-md hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">S</button>
                            <button class="px-4 py-2 border rounded-md hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">M</button>
                            <button class="px-4 py-2 border rounded-md hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">L</button>
                            <button class="px-4 py-2 border rounded-md hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">XL</button>
                        </div>
                    </div> -->

                    <!-- Quantity Selection -->
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-gray-900 mb-2">Quantity</h3>
                        <div class="flex items-center">
                            <button class="px-3 py-1 border rounded-l-md hover:bg-gray-100">-</button>
                            <input type="number" value="1" min="1" class="w-16 px-3 py-1 border-t border-b text-center focus:outline-none">
                            <button class="px-3 py-1 border rounded-r-md hover:bg-gray-100">+</button>

                            <p class="ml-2 text-gray-600">
                                Stok {{ $produk->stock }}
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button class="flex-1 bg-gray-900 text-white py-3 px-6 rounded-lg hover:bg-gray-800 transition">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                        <button class="flex-1 bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition">
                            <i class="fas fa-comments"></i>
                        </button>
                        <button class="flex-1 bg-gray-900 text-white py-3 px-6 rounded-lg hover:bg-gray-800 transition">
                            Beli Sekarang
                        </button>
                    </div>

                    <!-- Delivery Info -->
                    <div class="mt-6 border-t pt-6">
                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-truck mr-2"></i>
                                Ongkir Murah
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Pembayaran Aman
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details Tabs -->
            <div class="border-t mt-8">
                <div class="p-8">
                    <div class="flex border-b mb-4">
                        <button class="px-6 py-2 text-blue-500 border-b-2 border-blue-500">Deskripsi</button>
                        <button class="px-6 py-2 text-gray-500">Ulasan</button>
                        <button class="px-6 py-2 text-gray-500">Pengiriman</button>
                    </div>
                    <div class="prose max-w-none">
                        <h3 class="text-lg font-semibold mb-4">Deskripsi Produk</h3>
                        <p class="text-gray-600 mb-4">
                            {{ $produk->description }}
                        </p>
                        {{-- <ul class="list-disc pl-5 text-gray-600 mb-4">
                            <li>High-quality fabric blend</li>
                            <li>Comfortable fit</li>
                            <li>Available in multiple sizes</li>
                            <li>Easy care instructions</li>
                            <li>Perfect for summer events</li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Related Product Cards -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://images.pexels.com/photos/5632371/pexels-photo-5632371.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Related Product 1" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">Summer Blouse</h3>
                    <p class="text-gray-600 mb-2">$49.99</p>
                    <a href="#" class="block text-center bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">View Details</a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://images.pexels.com/photos/5632397/pexels-photo-5632397.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Related Product 2" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">Casual Dress</h3>
                    <p class="text-gray-600 mb-2">$79.99</p>
                    <a href="#" class="block text-center bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">View Details</a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://images.pexels.com/photos/5632382/pexels-photo-5632382.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Related Product 3" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">Evening Gown</h3>
                    <p class="text-gray-600 mb-2">$129.99</p>
                    <a href="#" class="block text-center bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">View Details</a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://images.pexels.com/photos/5632398/pexels-photo-5632398.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Related Product 4" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">Party Dress</h3>
                    <p class="text-gray-600 mb-2">$89.99</p>
                    <a href="#" class="block text-center bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">View Details</a>
                </div>
            </div>
        </div>
    </div>

@include('layouts.footer')
@endsection

{{-- <h1 class="text-2xl font-bold text-gray-900 mt-2">
    <img src="https://images.pexels.com/photos/5632402/pexels-photo-5632402.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="User Avatar" class="w-8 h-8 rounded-full">
    {{ $produk->toko->nama_toko }}
</h1> --}}