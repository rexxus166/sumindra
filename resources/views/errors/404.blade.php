@extends('layouts.app')
@section('title','Pengaturan Akun')
@section('style')
<!-- Optional: Custom CSS -->
@endsection

@section('content')
{{-- @include('layouts.navigation') --}}

<!-- 404 Content -->
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="max-w-lg w-full text-center">
        <div class="mb-8">
            <i class="fas fa-search text-blue-500 text-7xl mb-4"></i>
            <h1 class="text-6xl font-bold text-gray-900 mb-4">404</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Page Not Found</h2>
            <p class="text-gray-600 mb-8">
                Ups! Halaman yang Anda cari tidak ada atau telah dipindahkan.
            </p>
        </div>
        <div class="space-y-4">
            <button type="button" onclick="window.history.back()" class="inline-block px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Kembali</button>
        </div>
        <div class="mt-8">
            <p class="text-gray-600">
                Butuh Bantuan? <a href="#" class="text-blue-500 hover:text-blue-600">Contact Support</a>
            </p>
        </div>
    </div>
</div>
@endsection