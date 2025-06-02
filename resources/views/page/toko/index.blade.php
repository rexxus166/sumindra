@extends('layouts.app')

@section('title', 'Dashboard Toko')

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

        <!-- Dashboard Content -->
        <main class="p-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 text-sm font-medium">Total Penjualan</h3>
                        <i class="fas fa-dollar-sign text-blue-500 bg-blue-100 p-3 rounded-full"></i>
                    </div>
                    <p class="text-2xl font-bold">Rp. {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
                    <p class="text-green-500 text-sm"><i class="fas fa-arrow-up"></i> 12% vs last month</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 text-sm font-medium">Total Pesanan</h3>
                        <i class="fas fa-shopping-cart text-purple-500 bg-purple-100 p-3 rounded-full"></i>
                    </div>
                    <p class="text-2xl font-bold">{{ $totalPesanan }}</p>
                    <p class="text-green-500 text-sm"><i class="fas fa-arrow-up"></i> 8% vs last month</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 text-sm font-medium">Total Pelanggan</h3>
                        <i class="fas fa-users text-green-500 bg-green-100 p-3 rounded-full"></i>
                    </div>
                    <p class="text-2xl font-bold">{{ $totalPelanggan }}</p>
                    <p class="text-green-500 text-sm"><i class="fas fa-arrow-up"></i> 15% vs last month</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 text-sm font-medium">Total Produk</h3>
                        <i class="fas fa-box text-orange-500 bg-orange-100 p-3 rounded-full"></i>
                    </div>
                    <p class="text-2xl font-bold">{{ $totalProduk }}</p>
                    <p class="text-red-500 text-sm"><i class="fas fa-arrow-down"></i> 3% vs last month</p>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-medium">Pesanan Terbaru</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($pesananTerbaru as $pesanan)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $pesanan->order_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $pesanan->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @php
                                        $products = json_decode($pesanan->products, true);
                                        $groupedProducts = [];

                                        // Kelompokkan produk berdasarkan nama produk
                                        foreach ($products as $product) {
                                            $groupedProducts[$product['name']][] = $product['variant'];
                                        }

                                        // Format produk dengan varian
                                        $formattedProducts = [];
                                        foreach ($groupedProducts as $productName => $variants) {
                                            // Jika hanya ada satu varian, tampilkan produk saja
                                            if (count($variants) > 1) {
                                                // Jika ada beberapa varian, tampilkan varian yang dibeli
                                                $formattedProducts[] = $productName . ', varian: ' . implode(', ', $variants);
                                            } else {
                                                // Jika hanya satu varian, tampilkan produk dan varian tersebut
                                                $formattedProducts[] = $productName . ', varian: ' . $variants[0];
                                            }
                                        }

                                        echo implode('; ', $formattedProducts);
                                    @endphp
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">Rp. {{ number_format($pesanan->total_amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-{{ $pesanan->status_color }}-100 text-{{ $pesanan->status_color }}-800">{{ ucfirst($pesanan->status) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $pesanan->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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