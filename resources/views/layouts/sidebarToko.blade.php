<!-- Sidebar -->
<aside class="bg-indigo-600 text-white w-64 min-h-screen p-4 hidden md:block">
    <div class="mb-8">
        <h1 class="text-2xl font-bold">{{ $user->toko->nama_toko }}</h1>
        <p class="text-indigo-200 text-sm">Kategori : {{ $user->toko->kategori_toko }}</p>
    </div>
    <nav>
        <ul class="space-y-2">
            <li>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-indigo-700">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Pesanan</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition">
                    <i class="fas fa-box"></i>
                    <span>Produk</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition">
                    <i class="fas fa-users"></i>
                    <span>Penjualan</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition">
                    <i class="fas fa-chart-bar"></i>
                    <span>Laporan</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</aside>