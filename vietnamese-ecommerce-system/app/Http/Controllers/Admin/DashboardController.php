<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $orderCount = Order::count();
        $todayRevenue = Order::whereDate('created_at', now())->sum('total_amount');
        $newCustomers = User::whereDate('created_at', now())->count();

        $topProduct = Product::withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->first();

        $topProductName = $topProduct ? $topProduct->name : null;

        $chartDates = [];
        $chartCounts = [];

        $orders = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        foreach ($orders as $order) {
            $chartDates[] = $order->date;
            $chartCounts[] = $order->count;
        }

        return view('admin.dashboard', compact(
            'orderCount',
            'todayRevenue',
            'newCustomers',
            'topProductName',
            'chartDates',
            'chartCounts'
        ));
    }
}
