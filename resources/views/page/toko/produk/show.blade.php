@extends('layouts.app')
@section('title', 'Detail Produk')

@section('content')
@include('layouts.navigation')

    <!-- Product Details Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <!-- Product Image Gallery -->
                <div class="md:w-1/2">
                    <div class="relative h-96 md:h-full">
                        <img src="{{ asset($produk->image) }}" alt="Product Image" class="w-full h-full object-cover">
                        <!-- Thumbnail Navigation -->
                        <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2">
                            <button class="w-3 h-3 rounded-full bg-white opacity-50"></button>
                            <button class="w-3 h-3 rounded-full bg-white"></button>
                            <button class="w-3 h-3 rounded-full bg-white opacity-50"></button>
                        </div>
                    </div>
                </div>

                <!-- Product Information -->
                <div class="md:w-1/2 p-8">
                    <div class="mb-4">
                        <span class="text-sm text-blue-500 font-semibold">Kategori -> {{ ucwords($produk->category) }}</span>
                        <h1 class="text-3xl font-bold text-gray-900 mt-2">{{ $produk->name }}</h1>
                    </div>                    
                    <p class="text-gray-600 mb-6">
                        <!-- {{ $produk->description }} -->
                    </p>

                    <p class="text-3xl font-bold text-gray-900 mb-4">Rp. {{ number_format($produk->price, 0, ',', '.') }}</p>

                    <p class="text-gray-600 mb-4">
                            {{ $produk->description }}
                    </p>

                    <!-- Bintang -->
                    <!-- <div class="mb-6">
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="ml-2 text-gray-600">(4.5/5)</span>
                        </div>
                    </div> -->

                    <!-- Modal -->
                    <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden transition-opacity duration-300">
                        <div class="bg-white p-6 rounded-lg w-1/3">
                            <h3 class="text-2xl font-semibold text-center">Masukkan Jumlah</h3>
                            <div class="mt-4">
                                <div class="flex justify-center items-center">
                                    <button id="minus-modal" class="px-3 py-1 border rounded-l-md hover:bg-gray-100">-</button>
                                    <input id="quantity-modal" type="number" value="1" min="1" class="w-16 px-3 py-1 border-t border-b text-center focus:outline-none">
                                    <button id="plus-modal" class="px-3 py-1 border rounded-r-md hover:bg-gray-100">+</button>
                                </div>
                                <p class="mt-2 text-gray-600" id="stock-info-modal">Stok: {{ $produk->stock }}</p>
                            </div>
                    
                            <!-- Pilihan Varian -->
                            @if($produk->variants && count($produk->variants) > 0)
                                <div class="mt-4">
                                    <label for="varian" class="block text-gray-600">Pilih Varian</label>
                                    <select id="varian" class="w-full px-4 py-2 border rounded-md mt-2">
                                        @foreach($produk->variants as $varian)
                                            <option value="{{ $varian }}">{{ $varian }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="mt-4 flex justify-between">
                                <button id="close-modal" class="px-6 py-2 bg-gray-300 text-black rounded-lg">Batal</button>
                                <button id="add-to-cart" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tambah ke Keranjang</button>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        @auth
                            <!-- Tombol hanya tampil jika pengguna sudah login -->
                            <button id="open-modal" class="flex-1 bg-gray-900 text-white py-3 px-6 rounded-lg hover:bg-gray-800 transition">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                            <button class="flex-1 bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition">
                                <i class="fas fa-comments"></i>
                            </button>
                            <button id="beli-sekarang-button" data-id="{{ $produk->id }}" class="flex-1 bg-gray-900 text-white py-3 px-6 rounded-lg hover:bg-gray-800 transition">
                                Beli Sekarang
                            </button>
                        @else
                            <!-- Tombol arahkan ke login jika pengguna belum login -->
                            <a href="{{ route('login') }}" class="flex-1 bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition">
                                Login untuk Membeli
                            </a>
                        @endauth
                    </div>

                    <!-- Delivery Info -->
                    <div class="mt-6 border-t pt-6">
                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-truck mr-2"></i>
                                Ongkir Murah
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Pembayaran Aman
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details Tabs -->
            <div class="border-t mt-8">
                <div class="p-8">
                    <div class="flex border-b mb-4">
                        <button class="px-6 py-2 text-blue-500 border-b-2 border-blue-500">Deskripsi</button>
                        <button class="px-6 py-2 text-gray-500">Ulasan</button>
                        <button class="px-6 py-2 text-gray-500">Pengiriman</button>
                    </div>
                    <div class="prose max-w-none">
                        <h3 class="text-lg font-semibold mb-4">Deskripsi Produk</h3>
                        <p class="text-gray-600 mb-4">
                            {{ $produk->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Terkait -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Related Product Cards -->
            @foreach($relatedProducts as $related)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset($related->image) }}" alt="{{ $related->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $related->name }}</h3>
                    <p class="text-gray-600 mb-2">Rp. {{ number_format($related->price, 0, ',', '.') }}</p>
                    <a href="/produk/{{ $related->slug }}" class="block text-center bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">Lihat Detail</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@section('script')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    // Ambil elemen-elemen modal
    const openModalButton = document.getElementById('open-modal');
    const modal = document.getElementById('modal');
    const closeModalButton = document.getElementById('close-modal');
    const addToCartButton = document.getElementById('add-to-cart');
    const quantityInput = document.getElementById('quantity-modal');
    const productId = {{ $produk->id }};  // Mengambil ID produk dari Laravel

    // Buka modal saat tombol "Tambah ke Keranjang" diklik
    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
        // quantityInput.focus();
    });

    // Tutup modal
    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Beli Sekarang
    document.getElementById('beli-sekarang-button').addEventListener('click', function (e) {
        e.preventDefault();
        let productId = this.getAttribute('data-id');

        fetch(`/checkout/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.snap_token) {
                snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        alert("Pembayaran berhasil!");
                        console.log(result);
                    },
                    onPending: function(result) {
                        alert("Pembayaran sedang diproses!");
                        console.log(result);
                    },
                    onError: function(result) {
                        alert("Terjadi kesalahan saat pembayaran!");
                        console.log(result);
                    },
                    onClose: function() {
                        console.log("Snap UI ditutup.");
                    }
                });
            } else {
                alert('Gagal mendapatkan Snap Token');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan saat menghubungi server');
        });
    });

    // Menambah produk ke keranjang
    addToCartButton.addEventListener('click', () => {
        const quantity = quantityInput.value;
        const varianId = document.getElementById('varian') ? document.getElementById('varian').value : null;

        const formData = new FormData();
        formData.append('product_id', productId);
        formData.append('quantity', quantity);
        if (varianId) {
            formData.append('varian', varianId); // Kirimkan varian yang dipilih
        }

        fetch("{{ route('cart.add') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.success);  // Menampilkan pesan sukses
                modal.classList.add('hidden');
                setTimeout(() => {
                    window.location.reload();  // Menyegarkan halaman setelah 2 detik
                }, 100); // 0,1 detik setelah alert
            } else {
                alert(data.error || 'Terjadi kesalahan saat menambahkan produk ke keranjang');
            }
        })
        .catch(error => {
            console.log(error);
            alert('Terjadi kesalahan saat menambahkan produk ke keranjang');
        });
    });

    document.getElementById('plus-modal').addEventListener('click', function () {
        const currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity < {{ $produk->stock }}) {
            quantityInput.value = currentQuantity + 1;
        }
    });

    document.getElementById('minus-modal').addEventListener('click', function () {
        const currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
        }
    });

</script>
@endsection

@endsection