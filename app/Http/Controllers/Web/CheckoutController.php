<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\VnPayService;
use App\Services\MomoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function checkoutVnpayWeb(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'guest_phone' => 'required|string|max:20',
            'guest_address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        DB::beginTransaction();
        try {
            $orderData = [
                'guest_name' => $request->guest_name,
                'guest_email' => $request->guest_email,
                'guest_phone' => $request->guest_phone,
                'guest_address' => $request->guest_address,
                'total_amount' => $totalAmount,
                'payment_status' => 'pending',
                'status' => 'pending',
            ];

            if ($request->payment_method === 'vnpay') {
                $orderData['payment_method'] = 'vnpay';
            } elseif ($request->payment_method === 'momo') {
                $orderData['payment_method'] = 'momo';
            } elseif ($request->payment_method === 'cod') {
                $orderData['payment_method'] = 'cod';
            } elseif ($request->payment_method === 'bank_transfer') {
                $orderData['payment_method'] = 'bank_transfer';
            } else {
                return redirect()->back()->with('error', 'Invalid payment method.');
            }

            $order = Order::create($orderData);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            if ($order->payment_method === 'vnpay') {
                $paymentUrl = VnPayService::createPaymentUrl($order);
                return redirect()->away($paymentUrl);
            } elseif ($order->payment_method === 'momo') {
                $paymentUrl = MomoService::createPayment($order);
                return redirect()->away($paymentUrl);
            } elseif ($order->payment_method === 'cod' || $order->payment_method === 'bank_transfer') {
                $bankInfo = config('payment_gateway.bank_transfer');
                $qrData = "Bank: {$bankInfo['bank_name']}\nAccount Number: {$bankInfo['bank_account_number']}\nAccount Name: {$bankInfo['bank_account_name']}\nNote: Order #{$order->id}";
                // Generate QR code image URL or base64 here (implementation depends on QR code library)
                $qrCodeUrl = route('api.qrcode', ['data' => urlencode($qrData)]);

                Session::forget('cart');
                return view('checkout.success', [
                    'order' => $order,
                    'bank_transfer' => [
                        'bank_name' => $bankInfo['bank_name'],
                        'bank_account_number' => $bankInfo['bank_account_number'],
                        'bank_account_name' => $bankInfo['bank_account_name'],
                        'transfer_note' => "Order #{$order->id}",
                        'qr_code_url' => $qrCodeUrl,
                        'qr_code_text' => $qrData,
                    ],
                ]);
            } else {
                // For other payment methods, fallback
                Session::forget('cart');
                return redirect()->route('checkout_success');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }

    public function checkoutMomoWeb(Request $request)
    {
        // This method can be removed or merged into checkoutVnpayWeb as above
        return $this->checkoutVnpayWeb($request);
    }
}
