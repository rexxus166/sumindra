@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
@include('layouts.navigation')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Keranjang Belanja</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($carts->isEmpty())
            <p class="text-center text-gray-600 py-8">Keranjang Anda kosong.</p>
        @else
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="py-2 px-4 text-left">Produk</th>
                        <th class="py-2 px-4 text-left">Jumlah</th>
                        <th class="py-2 px-4 text-left">Harga</th>
                        <th class="py-2 px-4 text-left">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                        <tr>
                            <td class="py-2 px-4">
                                {{ $cart->product->name }}
                            </td>
                            <td class="py-2 px-4">
                                {{ $cart->quantity }}
                            </td>
                            <td class="py-2 px-4">
                                Rp. {{ number_format($cart->product->price, 0, ',', '.') }}
                            </td>
                            <td class="py-2 px-4">
                                Rp. {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 flex justify-end">
                <a href="#" class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition">
                    Lanjutkan ke Pembayaran
                </a>
            </div>
        @endif
    </div>
</div>

@include('layouts.footer')
@endsection