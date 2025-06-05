<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Thống kê tổng quan
            $totalUsers = User::count();
            $totalOrders = Order::count();
            $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
            $totalProducts = Product::count();

            // Thống kê tăng trưởng so với tháng trước
            $lastMonth = Carbon::now()->subMonth();
            $lastMonthUsers = User::whereMonth('created_at', $lastMonth->month)->count();
            $lastMonthOrders = Order::whereMonth('created_at', $lastMonth->month)->count();
            $lastMonthRevenue = Order::where('status', 'completed')
                ->whereMonth('created_at', $lastMonth->month)
                ->sum('total_amount');

            // Tính phần trăm tăng trưởng
            $userGrowth = $lastMonthUsers > 0 ? (($totalUsers - $lastMonthUsers) / $lastMonthUsers) * 100 : 0;
            $orderGrowth = $lastMonthOrders > 0 ? (($totalOrders - $lastMonthOrders) / $lastMonthOrders) * 100 : 0;
            $revenueGrowth = $lastMonthRevenue > 0 ? (($totalRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 : 0;

            // Lấy dữ liệu biểu đồ doanh thu 12 tháng
            $revenueData = [];
            for ($i = 11; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $revenue = Order::where('status', 'completed')
                    ->whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->sum('total_amount');
                $revenueData[] = [
                    'month' => 'T' . ($month->month),
                    'revenue' => $revenue / 1000000 // Chuyển đổi sang đơn vị triệu
                ];
            }

            // Lấy danh sách đơn hàng gần đây
            $recentOrders = Order::with('user')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            return view('admin.dashboard', compact(
                'totalUsers',
                'totalOrders',
                'totalRevenue',
                'totalProducts',
                'userGrowth',
                'orderGrowth',
                'revenueGrowth',
                'revenueData',
                'recentOrders'
            ));
        } catch (\Exception $e) {
            \Log::error('Lỗi tại DashboardController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tải trang Bảng điều khiển');
        }
    }
}
