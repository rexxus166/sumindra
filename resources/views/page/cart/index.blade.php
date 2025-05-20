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
                        <th class="py-2 px-4 text-left">Gambar</th>
                        <th class="py-2 px-4 text-left">Produk</th>
                        <th class="py-2 px-4 text-left">Jumlah</th>
                        <th class="py-2 px-4 text-left">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPrice = 0; // Inisialisasi variabel total harga
                    @endphp

                    @foreach($carts as $cart)
                        <tr data-cart-id="{{ $cart->id }}">
                            <td class="py-2 px-4">
                                <img src="{{ asset($cart->product->image) }}" alt="{{ $cart->product->name }}" class="w-16 h-16 object-cover">
                            </td>
                            <td class="py-2 px-4">
                                {{ $cart->product->name }}
                            </td>
                            <td class="py-2 px-4 flex items-center">
                                <button class="text-xl minus-btn px-3 py-1 border rounded-l-md hover:bg-gray-100">-</button>
                                <input type="number" value="{{ $cart->quantity }}" class="quantity-input w-16 px-3 py-1 border-t border-b text-center focus:outline-none" readonly>
                                <button class="text-xl plus-btn px-3 py-1 border rounded-r-md hover:bg-gray-100">+</button>
                            </td>
                            <td class="py-2 px-4">
                                Rp. {{ number_format($cart->product->price, 0, ',', '.') }}
                            </td>
                        </tr>

                        @php
                            // Hitung total harga
                            $totalPrice += $cart->quantity * $cart->product->price;
                        @endphp
                    @endforeach
                </tbody>
            </table>

            <!-- Menampilkan Total Harga -->
            <div class="mt-4 flex justify-end text-xl font-semibold">
                <p>Total: Rp. {{ number_format($totalPrice, 0, ',', '.') }}</p>
            </div>

            <div class="mt-6 flex justify-end">
                <button id="pay-button" class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition">
                    Bayar Sekarang
                </button>
            </div>
        @endif
    </div>
</div>

@include('layouts.footer')

@endsection

@section('script')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('#pay-button').addEventListener('click', function (event) {
        event.preventDefault();

        // Mengambil Snap Token dari backend
        fetch("{{ route('payment.create') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.snap_token) {
                snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        console.log(result);
                        alert('Pembayaran berhasil!');
                    },
                    onPending: function(result) {
                        console.log(result);
                        alert('Pembayaran sedang diproses!');
                    },
                    onError: function(result) {
                        console.log(result);
                        alert('Terjadi kesalahan saat pembayaran!');
                    }
                });
            } else {
                alert('Gagal mendapatkan Snap Token');
            }
        })
        .catch(error => {
            console.error(error);
            alert('Terjadi kesalahan dalam mendapatkan Snap Token');
        });
    });
});


    document.addEventListener('DOMContentLoaded', function () {
        // Mendapatkan semua tombol + dan -
        const minusButtons = document.querySelectorAll('.minus-btn');
        const plusButtons = document.querySelectorAll('.plus-btn');

        // Fungsi untuk mengupdate jumlah produk
        function updateQuantity(cartId, quantity) {
            // Mengirim data melalui AJAX ke server
            fetch(`/keranjang/update/${cartId}`, {
                method: 'POST',
                body: JSON.stringify({ quantity: quantity }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // alert('Jumlah produk berhasil diperbarui!');
                    location.reload();  // Reload halaman untuk memperbarui tampilan keranjang
                } else {
                    alert('Terjadi kesalahan saat memperbarui jumlah produk.');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Terjadi kesalahan');
            });
        }

        // Menambahkan event listener untuk tombol minus
        minusButtons.forEach(button => {
            button.addEventListener('click', function () {
                const cartId = this.closest('tr').getAttribute('data-cart-id');
                const quantityInput = this.closest('tr').querySelector('.quantity-input');
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    quantity--;
                    quantityInput.value = quantity;
                    updateQuantity(cartId, quantity);
                }
            });
        });

        // Menambahkan event listener untuk tombol plus
        plusButtons.forEach(button => {
            button.addEventListener('click', function () {
                const cartId = this.closest('tr').getAttribute('data-cart-id');
                const quantityInput = this.closest('tr').querySelector('.quantity-input');
                let quantity = parseInt(quantityInput.value);
                quantity++;
                quantityInput.value = quantity;
                updateQuantity(cartId, quantity);
            });
        });
    });
</script>
@endsection