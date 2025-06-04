@extends('layouts.app') {{-- Menggunakan layout dasar Anda --}}
@section('title', 'Manajemen Penjual Dinas')

@section('content')
@include('layouts.navigation') {{-- Asumsi ini adalah navigasi utama --}}

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-24">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Manajemen Penjual</h1>

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Daftar Penjual</h2>
            {{-- Tombol Tambah Penjual (opsional, jika dinas bisa menambah penjual) --}}
            {{-- <a href="#" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                <i class="fas fa-plus mr-2"></i> Tambah Penjual
            </a> --}}
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Toko / Penjual
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status Akun
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Terdaftar Sejak
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($sellers as $seller)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $seller->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $seller->name }} {{-- Jika nama toko ada di kolom lain, ganti ini --}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $seller->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{-- Anda bisa menambahkan logic untuk status penjual, misal 'verified', 'pending', 'suspended' --}}
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($seller->is_active ?? true) bg-green-100 text-green-800 {{-- Asumsi ada kolom is_active --}}
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ($seller->is_active ?? true) ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $seller->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                {{-- Anda perlu membuat rute dan method controller untuk masing-masing aksi ini --}}
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Lihat</a>
                                <a href="#" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Tidak ada data penjual ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        <div class="mt-4">
            {{ $sellers->links() }} {{-- Ini akan merender link pagination Tailwind CSS --}}
        </div>
    </div>
    
    @include('page.dinas.layout.aksescpt')
    
</div>
@endsection