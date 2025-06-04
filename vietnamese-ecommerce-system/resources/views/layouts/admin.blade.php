<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Panel - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex flex-col md:flex-row">

        <!-- Sidebar -->
        <div class="bg-white shadow-lg w-full md:w-64 min-h-screen">
            <div class="p-4 text-2xl font-bold border-b border-gray-200">
                Admin Panel
            </div>
            <nav class="mt-4">
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-green-500 hover:text-white">Dashboard</a>
                <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 hover:bg-green-500 hover:text-white">Users</a>
                <a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 hover:bg-green-500 hover:text-white">Categories</a>
                <a href="{{ route('admin.brands.index') }}" class="block py-2 px-4 hover:bg-green-500 hover:text-white">Brands</a>
                <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 hover:bg-green-500 hover:text-white">Products</a>
                <a href="{{ route('admin.orders.index') }}" class="block py-2 px-4 hover:bg-green-500 hover:text-white">Orders</a>
                <a href="{{ route('admin.vouchers.index') }}" class="block py-2 px-4 hover:bg-green-500 hover:text-white">Vouchers</a>
                <a href="{{ route('admin.flash-sales.index') }}" class="block py-2 px-4 hover:bg-green-500 hover:text-white">Flash Sales</a>
                <a href="{{ route('admin.banners.index') }}" class="block py-2 px-4 hover:bg-green-500 hover:text-white">Banners</a>
                <a href="{{ route('admin.posts.index') }}" class="block py-2 px-4 hover:bg-green-500 hover:text-white">Posts</a>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 p-6">
            <!-- Topbar -->
            <div class="flex justify-between items-center mb-6">
                <div class="text-xl font-semibold">@yield('title')</div>
                <div>
                    <span class="mr-4">Admin User</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Content -->
            <div>
                @yield('content')
            </div>
        </div>
    </div>

</body>
</html>
