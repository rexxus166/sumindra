@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('style')
<!-- Optional: Custom CSS -->
@endsection

@section('content')
<div class="min-h-screen flex">

    @include('layouts.sidebarToko')

    <!-- Main Content -->
    <div class="flex-1">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm">
            <div class="flex items-center justify-between p-4">
                <button class="md:hidden text-gray-600 hover:text-gray-900">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </header>

        <!-- Detail Pesanan Content -->
        <main class="p-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-medium mb-4">Detail Pesanan #{{ $order->order_id }}</h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- ID Pesanan -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">ID Pesanan</h3>
                        <p class="text-xl">{{ $order->order_id }}</p>
                    </div>

                    <!-- Nama Pelanggan -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Nama Pelanggan</h3>
                        <p class="text-xl">{{ $order->user->name }}</p>
                    </div>

                    <!-- Produk -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Produk</h3>
                        <ul>
                            @foreach(json_decode($order->products, true) as $product)
                                <li class="text-sm">
                                    {{ $product['name'] }} (varian: {{ $product['variant'] }}) - Rp. {{ number_format($product['price'], 0, ',', '.') }} x {{ $product['quantity'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Status Pesanan -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Status Pesanan</h3>
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-{{ $order->status_color }}-100 text-{{ $order->status_color }}-800">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <!-- Total -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Total</h3>
                        <p class="text-xl">Rp. {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    </div>

                    <!-- Tanggal Pesanan -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Tanggal Pesanan</h3>
                        <p class="text-xl">{{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                    </div>

                    <!-- Alamat Pengiriman -->
                    <div class="col-span-2">
                        <h3 class="text-sm font-medium text-gray-500">Alamat Pengiriman</h3>
                        <p class="text-sm">{{ $order->shipping_address }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('list.pesanan') }}" class="text-blue-600 hover:text-blue-800">Kembali ke Daftar Pesanan</a>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection