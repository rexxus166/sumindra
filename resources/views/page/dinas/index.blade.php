@extends('layouts.app')
@section('title', 'Dashboard Dinas')

@section('content')
{{-- Pastikan ini adalah navigasi yang benar untuk user dinas --}}
@include('layouts.navigation')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-24">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Dashboard Dinas</h1>

    {{-- Ringkasan Statistik Utama --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Pengguna</p>
                    <p class="text-3xl font-semibold text-gray-900">{{ number_format($totalUsers) }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                    <i class="fas fa-users fa-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Penjual</p>
                    <p class="text-3xl font-semibold text-gray-900">{{ number_format($totalSellers) }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full text-green-600">
                    <i class="fas fa-store fa-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Produk</p>
                    <p class="text-3xl font-semibold text-gray-900">{{ number_format($totalProducts) }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full text-yellow-600">
                    <i class="fas fa-box-open fa-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Transaksi</p>
                    <p class="text-3xl font-semibold text-gray-900">{{ number_format($totalTransactions) }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full text-purple-600">
                    <i class="fas fa-exchange-alt fa-lg"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail Transaksi Berdasarkan Status --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-500 text-sm font-medium">Transaksi Pending</p>
            <p class="text-2xl font-semibold text-yellow-600">{{ number_format($pendingTransactions) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-500 text-sm font-medium">Transaksi Selesai</p>
            <p class="text-2xl font-semibold text-green-600">{{ number_format($completedTransactions) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-500 text-sm font-medium">Transaksi Dibatalkan</p>
            <p class="text-2xl font-semibold text-red-600">{{ number_format($canceledTransactions) }}</p>
        </div>
    </div>

    {{-- Grafik (menggunakan Chart.js, perlu diinstal atau di-CDN) --}}
    {{-- Bagian Setelah Diubah --}}
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Pendaftaran Pengguna (7 Hari Terakhir)</h2>
        {{-- Tambahkan wrapper div ini --}}
        <div class="relative h-80"> {{-- Wrapper ini yang akan mengontrol tinggi --}}
            <canvas id="userRegistrationChart" class="w-full h-full"></canvas> {{-- Canvas akan mengisi wrapper --}}
        </div>
    </div>

    @include('page.dinas.layout.aksescpt')
</div>

{{-- SERTAKAN BAGIAN SCRIPT INI DI SINI --}}
@section('script')
{{-- Sertakan Chart.js dari CDN (atau instal via NPM jika Anda menggunakan Vite/Webpack) --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pastikan userRegistrations ada sebelum digunakan
        const userRegistrations = @json($userRegistrations ?? []); // Gunakan null coalescing operator untuk keamanan

        const labels = userRegistrations.map(item => item.date);
        const data = userRegistrations.map(item => item.count);

        const ctx = document.getElementById('userRegistrationChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendaftaran Pengguna',
                    data: data,
                    backgroundColor: 'rgba(59, 130, 246, 0.2)', // blue-500 with opacity
                    borderColor: 'rgba(59, 130, 246, 1)', // blue-500
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Pendaftaran'
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                }
            }
        });
    });
</script>
@endsection
@endsection