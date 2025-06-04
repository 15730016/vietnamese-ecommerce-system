<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quản Trị - @yield('title', 'Trang Chủ')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="bg-white w-64 shadow-md flex flex-col">
            <div class="p-4 text-xl font-bold border-b border-gray-200">
                Trang Quản Trị
            </div>
            <nav class="flex-1 overflow-y-auto">
                <ul class="p-4 space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-200 @if(request()->routeIs('admin.dashboard')) bg-gray-200 font-semibold @endif">Trang Chủ</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.banners.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200 @if(request()->routeIs('admin.banners.*')) bg-gray-200 font-semibold @endif">Banner</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.brands.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200 @if(request()->routeIs('admin.brands.*')) bg-gray-200 font-semibold @endif">Thương Hiệu</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200 @if(request()->routeIs('admin.categories.*')) bg-gray-200 font-semibold @endif">Danh Mục</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200 @if(request()->routeIs('admin.products.*')) bg-gray-200 font-semibold @endif">Sản Phẩm</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200 @if(request()->routeIs('admin.orders.*')) bg-gray-200 font-semibold @endif">Đơn Hàng</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200 @if(request()->routeIs('admin.users.*')) bg-gray-200 font-semibold @endif">Người Dùng</a>
                    </li>
                </ul>
            </nav>
            <div class="p-4 border-t border-gray-200">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-3 py-2 text-left text-red-600 hover:bg-red-50 rounded">
                        Đăng Xuất
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6 overflow-y-auto">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
