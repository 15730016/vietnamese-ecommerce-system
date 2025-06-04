<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\VnPayService;
use App\Services\MomoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $user = Auth::user();

        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->price * $item->quantity;
        }

        $request->validate([
            'payment_method' => 'required|in:cod,bank_transfer,vnpay,momo',
        ]);

        DB::beginTransaction();
        try {
            $orderData = [
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'status' => 'pending',
            ];

            $order = Order::create($orderData);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->price * $item->quantity,
                ]);
            }

            DB::commit();

            if ($order->payment_method === 'vnpay') {
                $paymentUrl = VnPayService::createPaymentUrl($order);
                return response()->json(['payment_url' => $paymentUrl]);
            } elseif ($order->payment_method === 'momo') {
                $paymentUrl = MomoService::createPayment($order);
                return response()->json(['payment_url' => $paymentUrl]);
            } elseif ($order->payment_method === 'cod' || $order->payment_method === 'bank_transfer') {
                // Generate QR code and text for bank transfer payment
                if ($order->payment_method === 'bank_transfer') {
                    $bankInfo = config('payment_gateway.bank_transfer');
                    $qrData = "Bank: {$bankInfo['bank_name']}\nAccount Number: {$bankInfo['bank_account_number']}\nAccount Name: {$bankInfo['bank_account_name']}\nNote: Order #{$order->id}";
                    // Generate QR code image URL or base64 here (implementation depends on QR code library)
                    $qrCodeUrl = route('api.qrcode', ['data' => urlencode($qrData)]);

                    return response()->json([
                        'message' => 'Order placed successfully. Please follow the payment instructions.',
                        'bank_transfer' => [
                            'bank_name' => $bankInfo['bank_name'],
                            'bank_account_number' => $bankInfo['bank_account_number'],
                            'bank_account_name' => $bankInfo['bank_account_name'],
                            'transfer_note' => "Order #{$order->id}",
                            'qr_code_url' => $qrCodeUrl,
                            'qr_code_text' => $qrData,
                        ],
                    ]);
                }

                return response()->json(['message' => 'Order placed successfully. Please follow the payment instructions.']);
            } else {
                return response()->json(['error' => 'Invalid payment method'], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Checkout failed: ' . $e->getMessage()], 500);
        }
    }
}
