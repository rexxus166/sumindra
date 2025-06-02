@extends('layouts.app')

@section('title', 'Daftar Pesanan')

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

        <!-- Daftar Pesanan Content -->
        <main class="p-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-medium mb-4">Daftar Pesanan</h2>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($orders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $order->order_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $order->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-{{ $order->status_color }}-100 text-{{ $order->status_color }}-800">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $order->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <!-- Edit Button -->
                                    <a href="#" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                                    <!-- Detail Button -->
                                    <a href="{{ route('pesanan.show', $order->order_id) }}" class="text-blue-600 hover:text-blue-800">Lihat Detail</a>
                                </td>
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