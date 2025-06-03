@extends('layouts.app')
@section('title', 'Detail Produk')

@section('content')
@include('layouts.navigation')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/2">
                    <div class="relative h-96 md:h-full">
                        <img src="{{ asset($produk->image) }}" alt="Product Image" class="w-full h-full object-cover">
                        <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2">
                            <button class="w-3 h-3 rounded-full bg-white opacity-50"></button>
                            <button class="w-3 h-3 rounded-full bg-white"></button>
                            <button class="w-3 h-3 rounded-full bg-white opacity-50"></button>
                        </div>
                    </div>
                </div>

                <div class="md:w-1/2 p-8">
                    <div class="mb-4">
                        <span class="text-sm text-blue-500 font-semibold">Kategori -> {{ ucwords($produk->category) }}</span>
                        <h1 class="text-3xl font-bold text-gray-900 mt-2">{{ $produk->name }}</h1>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 mb-4">Rp. {{ number_format($produk->price, 0, ',', '.') }}</p>
                    <p class="text-gray-600 mb-4">{{ $produk->description }}</p>

                    <form id="beliSekarangForm" method="POST" action="{{ route('payment.single', $produk->id) }}">
                        @csrf
                        @if ($produk->variants && count(json_decode($produk->variants)) > 0)
                            <div class="mb-4">
                                <label for="product-variant" class="block text-gray-700 text-sm font-bold mb-2">Varian:</label>
                                <select id="product-variant" name="varian" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    @foreach(json_decode($produk->variants) as $varian)
                                        <option value="{{ $varian }}">{{ $varian }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Tombol Beli Sekarang untuk Produk dengan Varian -->
                            <button type="button" id="beliSekarangBtn" class="flex-1 bg-green-500 text-white py-3 px-6 rounded-lg hover:bg-green-700 transition">Beli Sekarang</button>

                            <div id="varianModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                    </div>
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                Konfirmasi Varian
                                            </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500">
                                                    Anda akan membeli produk dengan varian: <span id="selected-variant-text" class="font-semibold"></span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto" onclick="lanjutkanPembayaran()">
                                                Lanjutkan Pembayaran
                                            </button>
                                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto" onclick="tutupModal()">
                                                Batal
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="selected_varian" id="selected_varian">
                        @endif
                    </form>

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

                            @if($produk->variants)
                                @php
                                    // Pastikan $produk->variants adalah array, decode JSON jika perlu
                                    $variants = is_string($produk->variants) ? json_decode($produk->variants) : $produk->variants;
                                @endphp
                                @if(count($variants) > 0)
                                    <div class="mt-4">
                                        <label for="varian" class="block text-gray-600">Pilih Varian</label>
                                        <select id="varian" class="w-full px-4 py-2 border rounded-md mt-2">
                                            @foreach($variants as $varian)
                                                <option value="{{ $varian }}">{{ $varian }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @endif

                            <div class="mt-4 flex justify-between">
                                <button id="close-modal" class="px-6 py-2 bg-gray-300 text-black rounded-lg">Batal</button>
                                <button id="add-to-cart" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tambah ke Keranjang</button>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 mt-6">
                        @auth
                            <button id="open-modal" class="flex-1 bg-gray-900 text-white py-3 px-6 rounded-lg hover:bg-gray-800 transition">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                            <button class="flex-1 bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition">
                                <i class="fas fa-comments"></i>
                            </button>
                            @if (!($produk->variants && count(json_decode($produk->variants)) > 0))
                            <!-- Tombol Beli Sekarang untuk Produk tanpa Varian -->
                            <button onclick="beliSekarangTanpaVarian(event)" class="flex-1 bg-green-500 text-white py-3 px-6 rounded-lg hover:bg-green-700 transition">
                                Beli Sekarang
                            </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="flex-1 bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition">
                                Login untuk Membeli
                            </a>
                        @endauth
                    </div>

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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
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
    // Fungsi untuk trigger Snap popup
    function triggerPayment(snapToken) {
        snap.pay(snapToken, {
            onSuccess: function(result) {
                console.log('success', result);
                window.location.href = '/pesanan-berhasil';
            },
            onPending: function(result) {
                console.log('pending', result);
                window.location.href = '/pesanan-pending';
            },
            onError: function(result) {
                console.log('error', result);
                alert('Terjadi kesalahan saat pembayaran.');
            },
            onClose: function() {
                console.log('Popup ditutup tanpa pembayaran');
            }
        });
    }

    // Ambil elemen-elemen modal Tambah ke Keranjang
    const openModalButton = document.getElementById('open-modal');
    const modal = document.getElementById('modal');
    const closeModalButton = document.getElementById('close-modal');
    const addToCartButton = document.getElementById('add-to-cart');
    const quantityInput = document.getElementById('quantity-modal');
    const productId = {{ $produk->id }}; // Mengambil ID produk dari Laravel

    // Buka modal Tambah ke Keranjang saat tombol diklik
    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    // Tutup modal Tambah ke Keranjang
    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
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
                alert(data.success); // Menampilkan pesan sukses
                modal.classList.add('hidden');
                setTimeout(() => {
                    window.location.reload(); // Menyegarkan halaman setelah 0.1 detik
                }, 100);
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

    // Fungsi untuk produk DENGAN varian
    function lanjutkanPembayaran() {
        const productId = {{ $produk->id }};
        const varian = document.getElementById('product-variant').value;
        const quantity = 1; // Default quantity untuk beli sekarang

        const productDetails = {
            id: productId,
            quantity: quantity,
            varian: varian
        };

        processPayment(productDetails);
    }

    // Fungsi untuk produk TANPA varian
    function beliSekarangTanpaVarian(event) {
        event.preventDefault();
        
        const productDetails = {
            id: {{ $produk->id }},
            quantity: 1, // Default quantity
            varian: null // Tidak ada varian
        };

        processPayment(productDetails);
    }

    // Fungsi utama untuk proses pembayaran
    function processPayment(productDetails) {
        showLoading(); // Tampilkan loading indicator

        fetch("{{ route('payment.single', $produk->id) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ 
                product: productDetails 
            }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            hideLoading(); // Sembunyikan loading indicator
            
            if (data.snap_token) {
                triggerPayment(data.snap_token);
            } else {
                showError('Gagal memproses pembayaran: ' + (data.message || 'Token tidak diterima'));
            }
        })
        .catch(error => {
            hideLoading();
            console.error('Error:', error);
            showError('Terjadi kesalahan saat memproses pembayaran');
        });
    }

    // Fungsi untuk modal varian
    function tampilkanModalVarian() {
        const varian = document.getElementById('product-variant').value;
        document.getElementById('selected-variant-text').textContent = varian;
        document.getElementById('varianModal').classList.remove('hidden');
    }

    function tutupModalVarian() {
        document.getElementById('varianModal').classList.add('hidden');
    }

    // Fungsi utilitas
    function showLoading() {
        // Buat atau tampilkan elemen loading
        let loadingElement = document.getElementById('loading-indicator');
        if (!loadingElement) {
            loadingElement = document.createElement('div');
            loadingElement.id = 'loading-indicator';
            loadingElement.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            loadingElement.innerHTML = `
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500 mx-auto"></div>
                    <p class="mt-4 text-center">Memproses pembayaran...</p>
                </div>
            `;
            document.body.appendChild(loadingElement);
        }
        loadingElement.classList.remove('hidden');
    }

    function hideLoading() {
        const loadingElement = document.getElementById('loading-indicator');
        if (loadingElement) {
            loadingElement.classList.add('hidden');
        }
    }

    function showError(message) {
        // Sembunyikan loading terlebih dahulu
        hideLoading();
        
        // Tampilkan pesan error
        alert(message);
    }

    // Inisialisasi event listeners saat DOM siap
    document.addEventListener('DOMContentLoaded', function() {
        // Untuk produk dengan varian
        const beliSekarangBtn = document.getElementById('beliSekarangBtn');
        if (beliSekarangBtn) {
            beliSekarangBtn.addEventListener('click', function(event) {
                event.preventDefault();
                tampilkanModalVarian();
            });
        }

        // Untuk tombol batal di modal varian
        const batalBtn = document.querySelector('#varianModal .bg-white');
        if (batalBtn) {
            batalBtn.addEventListener('click', tutupModalVarian);
        }
    });

    // Fungsi global untuk diakses dari HTML
    window.lanjutkanPembayaran = lanjutkanPembayaran;
    window.tutupModal = tutupModalVarian;
    window.beliSekarangTanpaVarian = beliSekarangTanpaVarian;
</script>
@endsection