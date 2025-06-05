@extends('layouts.admin')

@section('title', 'Bảng Điều Khiển')

@section('content')
<div>
    <!-- Tiêu đề trang -->
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">Bảng Điều Khiển</h1>
        <p class="mt-2 text-sm text-gray-700">Xem tổng quan về hoạt động của website</p>
    </div>

    <!-- Thông báo lỗi/thành công -->
    @if(session('error'))
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <!-- Thống kê tổng quan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Tổng số người dùng -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 text-sm">Tổng Người Dùng</h2>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalUsers) }}</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center text-sm">
                    <span class="text-{{ $userGrowth >= 0 ? 'green' : 'red' }}-500 mr-2">
                        {{ $userGrowth >= 0 ? '↑' : '↓' }} {{ abs(round($userGrowth, 1)) }}%
                    </span>
                    <span class="text-gray-600">So với tháng trước</span>
                </div>
            </div>
        </div>

        <!-- Tổng đơn hàng -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 text-sm">Tổng Đơn Hàng</h2>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalOrders) }}</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center text-sm">
                    <span class="text-{{ $orderGrowth >= 0 ? 'green' : 'red' }}-500 mr-2">
                        {{ $orderGrowth >= 0 ? '↑' : '↓' }} {{ abs(round($orderGrowth, 1)) }}%
                    </span>
                    <span class="text-gray-600">So với tháng trước</span>
                </div>
            </div>
        </div>

        <!-- Doanh thu -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 text-sm">Doanh Thu</h2>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalRevenue / 1000000, 1) }}M</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center text-sm">
                    <span class="text-{{ $revenueGrowth >= 0 ? 'green' : 'red' }}-500 mr-2">
                        {{ $revenueGrowth >= 0 ? '↑' : '↓' }} {{ abs(round($revenueGrowth, 1)) }}%
                    </span>
                    <span class="text-gray-600">So với tháng trước</span>
                </div>
            </div>
        </div>

        <!-- Số lượng sản phẩm -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 text-sm">Sản Phẩm</h2>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalProducts) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ và Đơn hàng gần đây -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Biểu đồ doanh thu -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Biểu Đồ Doanh Thu</h3>
            <canvas id="revenueChart" class="w-full h-64"></canvas>
        </div>

        <!-- Đơn hàng gần đây -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Đơn Hàng Gần Đây</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã ĐH</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách Hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng Thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng Tiền</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentOrders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $order->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $order->status === 'completed' ? 'Hoàn thành' : 'Đang xử lý' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($order->total_amount) }}đ
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Biểu đồ doanh thu
    const revenueData = @json($revenueData);
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: revenueData.map(item => item.month),
            datasets: [{
                label: 'Doanh thu (triệu đồng)',
                data: revenueData.map(item => item.revenue),
                borderColor: 'rgb(59, 130, 246)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('vi-VN') + 'M';
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection
