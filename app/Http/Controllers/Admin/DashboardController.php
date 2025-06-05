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
        try {
            // Lấy thống kê cho ngày hôm nay
            $today = Carbon::today();
            
            $todayOrders = Order::whereDate('created_at', $today)->count();
            $todayRevenue = Order::whereDate('created_at', $today)->sum('total');
            $totalProducts = Product::count();
            $totalUsers = User::count();

            // Lấy 5 đơn hàng gần đây nhất
            $recentOrders = Order::with('user')
                                ->latest()
                                ->take(5)
                                ->get();

            // Lấy 5 sản phẩm bán chạy nhất
            $topProducts = Product::withCount(['orderItems as total_sold' => function($query) {
                                    $query->whereHas('order', function($q) {
                                        $q->where('status', 'completed');
                                    });
                                }])
                                ->orderByDesc('total_sold')
                                ->take(5)
                                ->get();

            return view('admin.dashboard', compact(
                'todayOrders',
                'todayRevenue',
                'totalProducts',
                'totalUsers',
                'recentOrders',
                'topProducts'
            ));
        } catch (\Exception $e) {
            \Log::error('Dashboard Error: ' . $e->getMessage());
            return redirect()->back()->withErrors('Đã xảy ra lỗi khi tải trang Dashboard.');
        }
    }
}
