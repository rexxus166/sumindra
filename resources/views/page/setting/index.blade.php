@extends('layouts.app')
@section('title','Pengaturan Akun')
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
                    <a href="#" class="block px-4 py-2 rounded-md hover:bg-gray-50 text-gray-700">
                        <i class="fas fa-shopping-bag mr-2"></i> Pesanan
                    </a>
                    <a href="{{ route('settings') }}" class="block px-4 py-2 rounded-md bg-blue-50 text-blue-700 font-medium">
                        <i class="fas fa-cog mr-2"></i> Pengaturan
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-span-1 md:col-span-3">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-2xl font-bold mb-6">Pengaturan Akun</h1>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Account Settings -->
                <div class="space-y-6">
                    <!-- Password Change Section -->
                    <div class="border-b pb-6">
                        <h2 class="text-lg font-semibold mb-4">Ganti Password</h2>
                        <form action="{{ route('settings.password.update') }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="current-password" class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
                                <input type="password" id="current-password" name="current-password"
                                       autocomplete="current-password"
                                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div>
                                <label for="new-password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                <input type="password" id="new-password" name="new-password"
                                       autocomplete="new-password"
                                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div>
                                <label for="new-password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                                <input type="password" id="new-password_confirmation" name="new-password_confirmation"
                                       autocomplete="new-password"
                                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <button type="submit"
                                    class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Perbarui Password
                            </button>
                        </form>
                    </div>

                    <!-- Delete Account -->
                    <div>
                        <h2 class="text-lg font-semibold text-red-600 mb-4">Hapus Akun</h2>
                        <p class="text-gray-600 mb-4">Setelah akun dihapus, data kamu tidak dapat dikembalikan. Pastikan keputusan ini sudah final.</p>
                        <form action="{{ route('profil.destroy') }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus akun? Semua data akan hilang!')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                Hapus Akun
                            </button>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection