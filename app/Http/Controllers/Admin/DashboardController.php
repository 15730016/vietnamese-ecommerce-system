<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Lấy thống kê cho ngày hôm nay
        $today = Carbon::today();
        
        // Đơn hàng và doanh thu hôm nay
        $todayOrders = Order::whereDate('created_at', $today)->count();
        $todayRevenue = Order::whereDate('created_at', $today)
            ->where('status', 'completed')
            ->sum('total');

        // Tổng số sản phẩm và người dùng
        $totalProducts = Product::count();
        $totalUsers = User::count();

        // Đơn hàng gần đây
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Sản phẩm bán chạy
        $topProducts = Product::withCount(['orderItems as total_sold' => function($query) {
                $query->whereHas('order', function($q) {
                    $q->where('status', 'completed');
                });
            }])
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // Nếu không có sản phẩm bán chạy, lấy sản phẩm theo lượt bán mặc định
        if ($topProducts->isEmpty()) {
            $topProducts = Product::orderByDesc('created_at')->take(5)->get();
        }

        return view('admin.dashboard', compact(
            'todayOrders',
            'todayRevenue',
            'totalProducts',
            'totalUsers',
            'recentOrders',
            'topProducts'
        ));
    }
}
