@extends('layouts.app')

@section('title', 'Pemberitahuan')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
    <h1 class="text-3xl font-semibold text-gray-800">Pemberitahuan Sebelum Membuka Toko</h1>

    <div class="mt-8 bg-white shadow-lg rounded-lg p-6">
        <p class="text-lg text-gray-800">
            Anda akan mengubah status akun Anda menjadi <b>Penjual</b>. Setelah menjadi penjual, Anda tidak dapat kembali menjadi User biasa dan otomatis tidak akan bisa membeli produk di platform ini.
        </p>
        <p class="text-lg text-gray-800 mt-4">
            Apakah Anda yakin ingin melanjutkan untuk membuka toko?
        </p>

        <div class="mt-6">
            <!-- Jika user sudah memiliki toko, tampilkan tombol buka toko -->
            @if(Auth::user()->role === 'user')
                <div class="mt-8">
                    <a href="{{ route('buka.toko') }}" class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition text-center">
                        Ya, Buka Toko
                    </a>
                </div>
            @endif
            <br>
            <a href="{{ route('dashboard') }}" class="w-full mt-2 py-2 px-4 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition text-center">
                Tidak, Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection