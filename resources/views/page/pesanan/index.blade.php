@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('style')
<!-- Optional: Custom CSS -->
@endsection

@section('content')
@include('layouts.navigation')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Sidebar -->
        <div class="col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col items-center mb-6">
                    <img src="https://images.pexels.com/photos/5632402/pexels-photo-5632402.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                         class="w-24 h-24 rounded-full mb-4">
                    <h2 class="text-xl font-semibold">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-600">Anggota Sejak {{ Auth::user()->created_at->format('Y') }}</p>
                </div>
                <nav class="space-y-2">
                    <a href="{{ route('profil') }}" class="block px-4 py-2 rounded-md hover:bg-gray-50 text-gray-700">
                        <i class="fas fa-user mr-2"></i> Profil
                    </a>
                    <a href="{{ route('pesanan') }}" class="block px-4 py-2 rounded-md bg-blue-50 text-blue-700 font-medium">
                        <i class="fas fa-shopping-bag mr-2"></i> Pesanan
                    </a>
                    <a href="{{ route('settings') }}" class="block px-4 py-2 rounded-md hover:bg-gray-50 text-gray-700">
                        <i class="fas fa-cog mr-2"></i> Pengaturan
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Form -->
        <div class="col-span-1 md:col-span-3">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Riwayat Pesanan</h1>
                    <!-- Filter Dropdown -->
                    <select class="border rounded-md px-4 py-2">
                        <option>Semua Pesanan</option>
                        <option>Di Kemas</option>
                        <option>Dalam Perjalanan</option>
                        <option>Di Terima</option>
                        <option>Di Batalkan</option>
                    </select>
                </div>

                <!-- Orders List -->
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div class="border rounded-lg p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $order->order_id }}</h3>
                                    <p class="text-gray-600">{{ $order->created_at->format('F d, Y') }}</p>
                                </div>
                                <span class="px-3 py-1 
                                    {{ $order->status == 'success' ? 'bg-green-100 text-green-700' : 
                                    ($order->status == 'processing' ? 'bg-blue-100 text-blue-700' : 
                                    ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 
                                    ($order->status == 'failed' ? 'bg-red-100 text-red-700' : 
                                    ($order->status == 'cancelled' ? 'bg-red-100 text-red-700' : '')))) }} 
                                    rounded-full">{{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                @foreach ($order->products as $product)
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded">
                                    <div>
                                        <h4 class="font-semibold">{{ $product->name }}</h4>
                                        <p class="text-gray-600">Varian: {{ $product->variant }}</p>
                                        <p class="text-gray-600">Jumlah: {{ $product->quantity }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="border-t pt-4 flex justify-between items-center">
                                <div>
                                    <p class="text-gray-600">Jumlah Total: <span class="font-semibold">Rp. {{ number_format($order->total_amount, 0, ',', '.') }}</span></p>
                                    {{-- <p class="text-gray-600">Metode Pembayaran: {{ $order->payment_method ?? 'N/A' }}</p> --}}
                                </div>
                                <button class="px-4 py-2 border border-blue-500 text-blue-500 rounded hover:bg-blue-50">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection