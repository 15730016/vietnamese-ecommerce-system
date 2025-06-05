@extends('layouts.admin-layout')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Đơn Hàng Hôm Nay</p>
                <p class="text-lg font-semibold text-gray-700">{{ $todayOrders ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Doanh Thu Hôm Nay</p>
                <p class="text-lg font-semibold text-gray-700">{{ number_format($todayRevenue ?? 0, 0, ',', '.') }}đ</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 7 9 19l-5.5-5.5 1.41-1.41L9 16.17 19.59 5.59 21 7Z"/></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Tổng Sản Phẩm</p>
                <p class="text-lg font-semibold text-gray-700">{{ $totalProducts ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Tổng Người Dùng</p>
                <p class="text-lg font-semibold text-gray-700">{{ $totalUsers ?? 0 }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h2 class="text-lg font-semibold mb-4">Đơn Hàng Gần Đây</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã ĐH</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách Hàng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng Tiền</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng Thái</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($recentOrders ?? [] as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $order->order_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ number_format($order->total, 0, ',', '.') }}đ</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                   ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                            Không có đơn hàng nào
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h2 class="text-lg font-semibold mb-4">Sản Phẩm Bán Chạy</h2>
        <div class="space-y-4">
            @forelse($topProducts ?? [] as $product)
            <div class="flex items-center">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded">
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-900">{{ $product->name }}</p>
                    <p class="text-sm text-gray-500">Đã bán: {{ $product->total_sold }}</p>
                </div>
                <div class="ml-auto">
                    <p class="text-sm font-medium text-gray-900">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-500 text-center">Chưa có dữ liệu</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
