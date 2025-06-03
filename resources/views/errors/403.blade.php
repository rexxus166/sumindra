@extends('layouts.app')
@section('title','403')
@section('style')
<!-- Optional: Custom CSS -->
@endsection

@section('content')
{{-- @include('layouts.navigation') --}}

<!-- 403 Content -->
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="max-w-lg w-full text-center">
        <div class="mb-8">
            <i class="fas fa-lock text-red-500 text-7xl mb-4"></i>
            <h1 class="text-6xl font-bold text-gray-900 mb-4">403</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Akses Ditolak</h2>
            <p class="text-gray-600 mb-8">
                Maaf! Anda tidak memiliki izin untuk mengakses halaman ini.
            </p>
        </div>
        <div class="space-y-4">
            <div class="space-x-4">
                @if(Auth::check()) {{-- Pastikan pengguna sudah login --}}
                    @php
                        $dashboardRoute = '';
                        if (Auth::user()->role === 'user') {
                            $dashboardRoute = route('dashboard');
                        } elseif (Auth::user()->role === 'admin') {
                            $dashboardRoute = route('toko.index');
                        } elseif (Auth::user()->role === 'dinas') {
                            $dashboardRoute = route('dinas.dashboard');
                        }
                    @endphp
            
                    <a href="{{ $dashboardRoute }}" class="inline-block px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        <i class="fas fa-home mr-2"></i> Kembali ke Dashboard
                    </a>
                @else
                    {{-- Opsional: Tampilkan tautan default atau pesan jika pengguna belum login --}}
                    <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        <i class="fas fa-home mr-2"></i> Kembali ke Halaman Login
                    </a>
                @endif
            </div>
            <div class="mt-8 text-gray-600">
                Jika Anda percaya ini adalah kesalahan, silahkan hubungi tim dukungan :
            </div>
            <div class="flex justify-center space-x-4 mt-4">
                <a href="mailto:support@sumindra.com" class="text-blue-500 hover:text-blue-600">
                    <i class="fas fa-envelope mr-2"></i>
                    support@sumindra.imyu.biz.id
                </a>
                <span class="text-gray-300">|</span>
                <a href="tel:+1234567890" class="text-blue-500 hover:text-blue-600">
                    <i class="fas fa-phone mr-2"></i>
                    +62 812 3456 7890
                </a>
            </div>
        </div>
        <div class="mt-8 p-4 bg-yellow-50 rounded-lg">
            <p class="text-yellow-800">
                <i class="fas fa-info-circle mr-2"></i>
                Halaman ini mungkin terbatas untuk pengguna yang terdaftar atau memerlukan izin khusus.
            </p>
        </div>
    </div>
</div>

@endsection