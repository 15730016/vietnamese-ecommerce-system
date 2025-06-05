<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quản Trị - @yield('title', 'Trang Chủ')</title>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100">
    <!-- Top Navigation -->
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                        <img alt="Logo" class="w-8" src="{{ asset('images/logo-haxu-tron.png') }}">
                        <span class="ml-3 text-lg font-semibold text-gray-900">HaXuVina</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                              {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span>Trang Chủ</span>
                    </a>
                    <a href="{{ route('admin.products.index') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                              {{ request()->routeIs('admin.products.*') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span>Sản Phẩm</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                              {{ request()->routeIs('admin.orders.*') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span>Đơn Hàng</span>
                    </a>
                </div>

                <!-- Right side buttons -->
                <div class="flex items-center space-x-4">
                    <div class="relative" id="profileMenuContainer">
                        <button class="flex items-center space-x-2 focus:outline-none" id="profileMenuButton">
                            <img src="{{ asset('images/logo-haxu-tron.png') }}" alt="Avatar" class="w-8 h-8 rounded-full">
                            <span class="text-sm font-medium text-gray-700">Admin</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden" id="profileMenu">
                            <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Hồ sơ
                            </a>
                            <a href="{{ route('admin.password.reset') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Đặt lại mật khẩu
                            </a>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    Đăng Xuất
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    Trang Chủ
                </a>
                <a href="{{ route('admin.products.index') }}" 
                   class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.products.*') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    Sản Phẩm
                </a>
                <a href="{{ route('admin.orders.index') }}" 
                   class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.orders.*') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    Đơn Hàng
                </a>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-6">
            @yield('content')
        </div>
    </div>

    <script>
        // Toggle mobile menu
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Toggle profile menu
        const profileButton = document.getElementById('profileMenuButton');
        const profileMenu = document.getElementById('profileMenu');
        const profileMenuContainer = document.getElementById('profileMenuContainer');

        profileButton.addEventListener('click', () => {
            profileMenu.classList.toggle('hidden');
        });

        // Close profile menu when clicking outside
        document.addEventListener('click', (event) => {
            if (!profileMenuContainer.contains(event.target)) {
                profileMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
