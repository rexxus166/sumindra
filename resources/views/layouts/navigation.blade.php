<!-- Navigation Bar -->
<nav class="bg-white shadow-lg fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                @auth
                    <!-- Jika user sudah login, arahkan ke dashboard -->
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <img src="{{ asset('image/sumindra-logo.png') }}" alt="Sumindra Logo" style="max-width: 200px; max-height: 75px;">
                        <span class="ml-2 text-xl font-bold text-gray-800 hidden md:block">Sumindra</span>
                    </a>
                @else
                    <!-- Jika user belum login, arahkan ke halaman utama ("/") -->
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('image/sumindra-logo.png') }}" alt="Sumindra Logo" style="max-width: 200px; max-height: 75px;">
                        <span class="ml-2 text-xl font-bold text-gray-800 hidden md:block">Sumindra</span>
                    </a>
                @endauth
            </div>            

            <!-- Search Bar -->
            @if (Route::is('dashboard') || Route::is('produk.show') || Route::is('welcome') || Route::is('search'))
                <div class="flex-1 max-w-lg mx-4">
                    <form action="{{ route('search') }}" method="GET" class="relative">
                        <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        {{-- <button type="submit" class="absolute right-3 top-2">
                            <i class="fas fa-search text-gray-400"></i>
                        </button> --}}
                    </form>
                </div>
            @endif

            <!-- User Menu and Cart -->
            <div class="ml-4 flex items-center space-x-4">
                @auth
                    <a href="{{ route('cart') }}" class="text-gray-600 hover:text-gray-900">
                        <div class="relative">
                            <i class="fas fa-shopping-cart text-2xl"></i>
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                                {{ $cartCount > 0 ? $cartCount : '0' }} <!-- Menampilkan jumlah keranjang -->
                            </span>
                        </div>
                    </a>
                    <!-- User Menu Dropdown -->
                    <div class="relative">
                        <!-- User Menu Dropdown, hide on mobile -->
                        <button id="dropdownButton" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 hidden md:flex">
                            <img src="https://images.pexels.com/photos/5632402/pexels-photo-5632402.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="User Avatar" class="w-8 h-8 rounded-full">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <!-- Dropdown Menu (Initially hidden) -->
                        <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden">
                            <a href="{{ route('profil') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pesanan</a>
                            <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                            <div class="border-t border-gray-100"></div>
                             <!-- Logout Link (using <a> but POST method) -->
                            <a href="#" id="logoutLink" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</a>
                        </div>
                    </div>
                @else
                    <!-- Jika user belum login -->
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">
                        <div class="relative">
                            <i class="fas fa-shopping-cart text-2xl"></i> <!-- Menampilkan ikon keranjang -->
                            <!-- Tidak ada angka karena user belum login -->
                        </div>
                    </a>
                    <!-- Login/Register buttons if user is not logged in -->
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-user mr-1"></i> Masuk
                        </a>
                        <span class="text-gray-300">|</span>
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900">Daftar</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Script to Toggle Dropdown -->
<script>
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    document.getElementById('logoutLink').addEventListener('click', function(e) {
                                e.preventDefault(); // Prevent the default anchor link behavior
                                
                                // Create a form and submit it using POST method
                                var form = document.createElement('form');
                                form.method = 'POST';
                                form.action = '{{ route('logout') }}'; // The logout route

                                // Add CSRF token to the form
                                var csrfToken = document.createElement('input');
                                csrfToken.type = 'hidden';
                                csrfToken.name = '_token';
                                csrfToken.value = '{{ csrf_token() }}';
                                form.appendChild(csrfToken);

                                // Submit the form
                                document.body.appendChild(form);
                                form.submit();
                            });

    dropdownButton.addEventListener('click', function (event) {
        event.stopPropagation(); // Prevent click from closing immediately
        dropdownMenu.classList.toggle('hidden'); // Toggle the "hidden" class to show/hide the menu
    });

    // Close dropdown if clicking outside
    window.addEventListener('click', function (e) {
        if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden'); // Hide the menu when clicking outside
        }
    });
</script>
