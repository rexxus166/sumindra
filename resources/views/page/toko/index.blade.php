<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Online Shop</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
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
                            <span>Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-box"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-users"></i>
                            <span>Customers</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-chart-bar"></i>
                            <span>Reports</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <button class="md:hidden text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-500 text-sm font-medium">Total Sales</h3>
                            <i class="fas fa-dollar-sign text-blue-500 bg-blue-100 p-3 rounded-full"></i>
                        </div>
                        <p class="text-2xl font-bold">$24,780</p>
                        <p class="text-green-500 text-sm"><i class="fas fa-arrow-up"></i> 12% vs last month</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-500 text-sm font-medium">Total Orders</h3>
                            <i class="fas fa-shopping-cart text-purple-500 bg-purple-100 p-3 rounded-full"></i>
                        </div>
                        <p class="text-2xl font-bold">1,482</p>
                        <p class="text-green-500 text-sm"><i class="fas fa-arrow-up"></i> 8% vs last month</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-500 text-sm font-medium">Total Customers</h3>
                            <i class="fas fa-users text-green-500 bg-green-100 p-3 rounded-full"></i>
                        </div>
                        <p class="text-2xl font-bold">892</p>
                        <p class="text-green-500 text-sm"><i class="fas fa-arrow-up"></i> 15% vs last month</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-500 text-sm font-medium">Total Products</h3>
                            <i class="fas fa-box text-orange-500 bg-orange-100 p-3 rounded-full"></i>
                        </div>
                        <p class="text-2xl font-bold">246</p>
                        <p class="text-red-500 text-sm"><i class="fas fa-arrow-down"></i> 3% vs last month</p>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-lg font-medium">Recent Orders</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">#ORD-001</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">John Doe</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">iPhone 13 Pro</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">$999</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Delivered</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">2023-07-20</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">#ORD-002</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Jane Smith</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">MacBook Air</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">$1,299</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">2023-07-19</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">#ORD-003</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Robert Johnson</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">AirPods Pro</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">$249</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Shipped</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">2023-07-18</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">#ORD-004</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Emily Davis</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">iPad Mini</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">$499</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Cancelled</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">2023-07-17</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.querySelector('button.md\\:hidden').addEventListener('click', function() {
            const sidebar = document.querySelector('aside');
            sidebar.classList.toggle('hidden');
        });
    </script>
</body>
</html>