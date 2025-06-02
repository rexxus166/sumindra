@extends('layouts.app')
@section('title','Profile')
@section('style')
<!-- Optional: Custom CSS -->
@endsection

@section('content')
@include('layouts.navigation')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Sidebar -->
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
                    <a href="{{ route('profil') }}" class="block px-4 py-2 rounded-md bg-blue-50 text-blue-700 font-medium">
                        <i class="fas fa-user mr-2"></i> Profil
                    </a>
                    <a href="{{ route('pesanan') }}" class="block px-4 py-2 rounded-md hover:bg-gray-50 text-gray-700">
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
                <h1 class="text-2xl font-bold mb-6">Informasi Profil</h1>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('profil.updateAll') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Information -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                @error('username') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                       class="w-full px-4 py-2 rounded-md border border-gray-300 bg-gray-100 cursor-not-allowed" readonly>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                                <input type="text" name="no_tlp" value="{{ old('no_tlp', optional($user->alamat)->no_tlp) }}"
                                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('no_tlp') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                <input type="text" name="provinsi" value="{{ old('provinsi', optional($user->alamat)->provinsi) }}"
                                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                                <input type="text" name="kota" value="{{ old('kota', optional($user->alamat)->kota) }}"
                                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                <input type="text" name="kecamatan" value="{{ old('kecamatan', optional($user->alamat)->kecamatan) }}"
                                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                                <input type="text" name="kode_pos" value="{{ old('kode_pos', optional($user->alamat)->kode_pos) }}"
                                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jalan</label>
                                <input type="text" name="nama_jalan" value="{{ old('nama_jalan', optional($user->alamat)->nama_jalan) }}"
                                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gedung</label>
                                <input type="text" name="gedung" value="{{ old('gedung', optional($user->alamat)->gedung) }}"
                                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No Rumah</label>
                                <input type="text" name="no_rumah" value="{{ old('no_rumah', optional($user->alamat)->no_rumah) }}"
                                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-md transition duration-200">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection