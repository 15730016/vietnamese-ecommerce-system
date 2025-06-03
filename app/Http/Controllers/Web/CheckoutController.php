<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\VnPayService;
use App\Services\MomoService;

class CheckoutController extends Controller
{
    public function checkoutVnpayWeb(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống');
        }

        $order = new Order();
        $order->user_id = null;
        $order->status = 'pending';
        $order->guest_name = $request->input('name');
        $order->guest_email = $request->input('email');
        $order->guest_phone = $request->input('phone');
        $order->guest_address = $request->input('address');
        $order->total_amount = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        $order->save();

        // Save order items logic can be added here

        $paymentUrl = VnPayService::createPaymentUrl($order);
        return redirect()->away($paymentUrl);
    }

    public function checkoutMomoWeb(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống');
        }

        $order = new Order();
        $order->user_id = null;
        $order->status = 'pending';
        $order->guest_name = $request->input('name');
        $order->guest_email = $request->input('email');
        $order->guest_phone = $request->input('phone');
        $order->guest_address = $request->input('address');
        $order->total_amount = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        $order->save();

        // Save order items logic can be added here

        $paymentUrl = MomoService::createPayment($order);
        return redirect()->away($paymentUrl);
    }
}
