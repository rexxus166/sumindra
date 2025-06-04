{{-- Tautan Cepat untuk Manajemen --}}
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-900 mb-4">Akses Cepat</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="{{ route('dinas.users') }}" class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition duration-200"> {{-- KEMBALIKAN KE ROUTE --}}
            <i class="fas fa-users mr-3 text-blue-600"></i>
            <span class="font-medium text-blue-800">Manajemen Pengguna</span>
        </a>
        <a href="{{ route('dinas.sellers') }}" class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition duration-200"> {{-- KEMBALIKAN KE ROUTE --}}
            <i class="fas fa-store mr-3 text-green-600"></i>
            <span class="font-medium text-green-800">Manajemen Penjual</span>
        </a>
        <a href="{{ route('dinas.products') }}" class="flex items-center p-4 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition duration-200"> {{-- KEMBALIKAN KE ROUTE --}}
            <i class="fas fa-box-open mr-3 text-yellow-600"></i>
            <span class="font-medium text-yellow-800">Manajemen Produk</span>
        </a>
        <a href="{{ route('dinas.transactions') }}" class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition duration-200"> {{-- KEMBALIKAN KE ROUTE --}}
            <i class="fas fa-exchange-alt mr-3 text-purple-600"></i>
            <span class="font-medium text-purple-800">Manajemen Transaksi</span>
        </a>
        <a href="#" class="flex items-center p-4 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition duration-200">
            <i class="fas fa-chart-line mr-3 text-indigo-600"></i>
            <span class="font-medium text-indigo-800">Laporan & Analisis</span>
        </a>
        <a href="#" class="flex items-center p-4 bg-red-50 hover:bg-red-100 rounded-lg transition duration-200">
            <i class="fas fa-cogs mr-3 text-red-600"></i>
            <span class="font-medium text-red-800">Pengaturan Umum</span>
        </a>
    </div>
</div>