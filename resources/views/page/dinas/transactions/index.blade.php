@extends('layouts.app') {{-- Menggunakan layout dasar Anda --}}
@section('title', 'Manajemen Transaksi Dinas')

@section('content')
@include('layouts.navigation') {{-- Asumsi ini adalah navigasi utama --}}

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-24">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Manajemen Transaksi</h1>

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Daftar Transaksi</h2>
            {{-- Tidak ada tombol tambah transaksi karena transaksi dibuat oleh user --}}
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID Transaksi
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pelanggan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Transaksi
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                #{{ $transaction->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $transaction->user->name ?? 'Pengguna Tidak Ditemukan' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp{{ number_format($transaction->total_amount, 0, ',', '.') }} {{-- Asumsi ada kolom total_amount --}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @php
                                    $statusColor = '';
                                    switch($transaction->status) {
                                        case 'pending': $statusColor = 'bg-yellow-100 text-yellow-800'; break;
                                        case 'success': $statusColor = 'bg-green-100 text-green-800'; break;
                                        case 'cancelled': $statusColor = 'bg-red-100 text-red-800'; break;
                                        case 'shipped': $statusColor = 'bg-blue-100 text-blue-800'; break; // Contoh status lain
                                        default: $statusColor = 'bg-gray-100 text-gray-800'; break;
                                    }
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $transaction->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                {{-- Anda perlu membuat rute dan method controller untuk masing-masing aksi ini --}}
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Lihat Detail</a>
                                {{-- <a href="#" class="text-green-600 hover:text-green-900 mr-3">Ubah Status</a> --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Tidak ada data transaksi ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        <div class="mt-4">
            {{ $transactions->links() }} {{-- Ini akan merender link pagination Tailwind CSS --}}
        </div>
    </div>

    @include('page.dinas.layout.aksescpt')
    
</div>
@endsection