<!-- Enhanced Footer -->
<footer class="bg-gray-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo and About -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center mb-4">
                    <img src="{{ asset('image/sumindra-logo.png') }}" alt="Sumindra Logo" style="max-width: 200px; max-height: 75px;">
                    <span class="ml-2 text-2xl font-bold">Sumindra</span>
                </div>
                <p class="text-gray-400 mb-4">Ini adalah Platform digital yang membantu UMKM dalam manajemen usaha, pemasaran, dan peningkatan daya saing melalui teknologi.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>

            <!-- Menu -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Menu</h3>
                <ul class="space-y-2">
                    <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-white">Beranda</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Produk</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Kontak</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                <ul class="space-y-2">
                    <li class="flex items-center text-gray-400">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        123 Street Name, Indramayu, Indonesia
                    </li>
                    <li class="flex items-center text-gray-400">
                        <i class="fas fa-phone mr-2"></i>
                        +62 812 345 6789
                    </li>
                    <li class="flex items-center text-gray-400">
                        <i class="fas fa-envelope mr-2"></i>
                        info@sumindra.imyu.biz.id
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-5 pt-5 text-center">
            <p class="text-gray-400">&copy; 2025 Sumindra. All rights reserved.</p>
        </div>
    </div>
</footer>