@extends('layouts.app')
@section('title','Profile')
@section('style')
<!-- Optional: Custom CSS -->
@endsection

@section('content')
<!-- Navigation Bar -->
@include('layouts.navigation')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
    <h1 class="text-3xl font-semibold text-gray-800">Perbarui Profil</h1>
    
    @if(session('success'))
        <div class="alert alert-success bg-green-100 text-green-800 p-4 rounded-lg mt-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Start Form -->
    <div class="mt-8 bg-white shadow-lg rounded-lg p-6">
        <form action="{{ route('profil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Grid Layout for Compact Form -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Name Field -->
                <div class="form-group">
                    <label for="name" class="block text-lg font-medium text-gray-700">Nama</label>
                    <input type="text" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Username Field -->
                <div class="form-group">
                    <label for="username" class="block text-lg font-medium text-gray-700">Username</label>
                    <input type="username" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                    @error('username')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="block text-lg font-medium text-gray-700">Password Baru</label>
                    <input type="password" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" name="password">
                    @error('password')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Confirmation Field -->
                <div class="form-group">
                    <label for="password_confirmation" class="block text-lg font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" id="password_confirmation" name="password_confirmation">
                </div>

                <div class="col-span-2">
                    <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">Perbarui Profil</button>
                </div>
            </div>
        </form>
    </div>

    <hr class="my-8">

    <!-- Alamat Form -->
    <h1 class="text-3xl font-semibold text-gray-800">Alamat</h1>
    <div class="mt-8 bg-white shadow-lg rounded-lg p-6">
        <form action="{{ route('profil.updateAlamat') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Alamat Fields -->
                @foreach(['nama_lengkap', 'no_tlp', 'provinsi', 'kota', 'kecamatan', 'kode_pos', 'nama_jalan', 'gedung', 'no_rumah'] as $field)
                    <div class="form-group">
                        <label for="{{ $field }}" class="block text-lg font-medium text-gray-700 capitalize">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                        <input type="text" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            id="{{ $field }}" name="{{ $field }}" 
                            value="{{ old($field, $user->alamat->$field ?? '') }}" 
                            required>
                    </div>
                @endforeach

                <div class="col-span-2">
                    <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">Perbarui Alamat</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Enhanced Footer -->
@include('layouts.footer')

@endsection