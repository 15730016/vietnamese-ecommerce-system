<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function list()
    {
        $user = Auth::user();
        $orders = Order::with('orderItems.product')->where('user_id', $user->id)->paginate(15);

        return response()->json($orders);
    }

    public function detail($id)
    {
        $user = Auth::user();
        $order = Order::with('orderItems.product')->where('user_id', $user->id)->findOrFail($id);

        return response()->json($order);
    }
}
