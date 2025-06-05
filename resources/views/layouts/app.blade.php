<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#64748b'
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Theme */
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #64748b;
        }

        /* Base */
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out forwards;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .animate-slideIn {
            animation: slideIn 0.5s ease-out forwards;
        }

        @keyframes loading {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .animate-loading {
            animation: loading 1s linear infinite;
        }

        /* Hover Effects */
        .hover-lift {
            transition: transform 0.2s ease-in-out;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
        }

        .hover-glow {
            transition: box-shadow 0.3s ease-in-out;
        }

        .hover-glow:hover {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }

        /* Base Styles */

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        /* Icon styles */
        [class^="icon-"] {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.5em;
            height: 1.5em;
            transition: transform 0.2s;
        }
        [class^="icon-"]:hover {
            transform: scale(1.1);
        }
        .icon-cart:before { content: '🛒'; }
        .icon-chevron-down:before { content: '▼'; }
        .icon-map:before { content: '📍'; }
        .icon-phone:before { content: '📞'; }
        .icon-envelope:before { content: '✉️'; }

        /* Button styles */
        .btn {
            @apply px-4 py-2 rounded-lg transition duration-200;
        }
        .btn-primary {
            @apply bg-blue-600 text-white hover:bg-blue-700;
        }
        .btn-secondary {
            @apply bg-gray-200 text-gray-700 hover:bg-gray-300;
        }

        /* Card styles */
        .card {
            @apply bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 ease-in-out;
        }
        .card:hover {
            @apply shadow-lg transform -translate-y-1;
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.1);
        }

        /* Link hover effects */
        .nav-link {
            @apply text-gray-600 relative;
        }
        .nav-link::after {
            content: '';
            @apply absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300;
        }
        .nav-link:hover::after {
            @apply w-full;
        }
        .nav-link:hover {
            @apply text-blue-600;
        }

        /* Image hover effects */
        .img-hover {
            @apply transition-all duration-500 ease-in-out;
        }
        .img-hover:hover {
            @apply transform scale-105;
            filter: brightness(1.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50 transition-shadow duration-300">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-8">
                    @foreach($mainCategories ?? [] as $category)
                    <a href="{{ route('category.show', $category->slug) }}" class="nav-link">
                        {{ $category->name }}
                    </a>
                    @endforeach
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-gray-900">
                        <i class="icon-cart"></i>
                    </a>
                    @guest
                    <a href="{{ route('login') }}" class="nav-link">
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            Đăng ký
                        </a>
                    @else
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 nav-link">
                                <span>{{ Auth::user()->name }}</span>
                                <i class="icon-chevron-down"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Tài khoản của tôi
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 btn btn-secondary">
                                        Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-b from-gray-800 to-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 animate-fadeIn">
                <!-- Company Info -->
                <div>
                    <h3 class="text-xl font-bold mb-4">{{ config('app.name', 'Laravel') }}</h3>
                    <p class="text-gray-400">
                        Chúng tôi cung cấp những sản phẩm chất lượng cao với giá cả hợp lý nhất.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Liên kết nhanh</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('home') }}" class="text-gray-400 hover:text-white">
                                Trang chủ
                            </a>
                        </li>
                        @foreach($mainCategories ?? [] as $category)
                        <li>
                            <a href="{{ route('category.show', $category->slug) }}" class="text-gray-400 hover:text-white">
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Thông tin liên hệ</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>
                            <i class="icon-map w-6"></i>
                            123 Đường ABC, Quận XYZ, TP.HCM
                        </li>
                        <li>
                            <i class="icon-phone w-6"></i>
                            0123 456 789
                        </li>
                        <li>
                            <i class="icon-envelope w-6"></i>
                            info@example.com
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
