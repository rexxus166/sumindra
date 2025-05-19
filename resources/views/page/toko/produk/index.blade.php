@extends('layouts.app')
@section('title','Kelola Produk')
@section('style')
<!-- Optional: Custom CSS -->
@endsection

@section('content')
<div class="min-h-screen flex">

    @include('layouts.sidebarToko')

    <!-- Main Content -->
    <div class="flex-1">
        
            <!-- Products Content -->
            <main class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900">Produk</h1>
                    <div class="flex space-x-3">
                        <div class="relative">
                            <input type="text" placeholder="Search products..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <a href="{{ route('produk.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                            <i class="fas fa-plus mr-2"></i> Add Product
                        </a>
                    </div>
                </div>

                <!-- Product Categories -->
                <!-- <div class="flex space-x-2 mb-6">
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Semua Produk</button>
                    <button class="px-4 py-2 bg-white text-gray-700 rounded-lg hover:bg-gray-50">Pakaian</button>
                    <button class="px-4 py-2 bg-white text-gray-700 rounded-lg hover:bg-gray-50">Makanan</button>
                </div> -->

                <!-- Products Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse ($produk as $item)
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="w-full aspect-[4/3] bg-gray-100 overflow-hidden">
                                <img src="{{ $item->image ? asset($item->image) : 'https://via.placeholder.com/300x200' }}" alt="{{ $item->name }}"
                                    class="w-full h-full object-contain transition-transform duration-300 hover:scale-105">
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $item->name }}</h3>
                                <p class="text-sm text-gray-500 mb-2">{{ $item->category }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-900">Rp. {{ number_format($item->price, 0, ',', '.') }}</span>
                                    @php
                                        $stokLabel = $item->stock > 10 ? 'In Stock' : ($item->stock > 0 ? 'Low Stock' : 'Out of Stock');
                                        $stokColor = $item->stock > 10 ? 'text-green-600' : ($item->stock > 0 ? 'text-yellow-600' : 'text-red-600');
                                    @endphp
                                    <span class="text-sm {{ $stokColor }}">{{ $stokLabel }}</span>
                                </div>
                                <div class="mt-4 flex space-x-2">
                                    <a href="{{ route('produk.edit', $item->id) }}" class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 text-center">Edit</a>
                                    <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus produk ini?')" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">Belum ada produk tersedia.</p>
                    @endforelse
                </div>

                <!-- Pagination -->
                
            </main>
        </div>
    </div>
@endsection

@section('script')
<script>
    // Mobile menu toggle
    document.querySelector('button.md\\:hidden').addEventListener('click', function() {
        const sidebar = document.querySelector('aside');
        sidebar.classList.toggle('hidden');
    });
</script>
@endsection