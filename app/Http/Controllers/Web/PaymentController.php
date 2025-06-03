<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\VnPayService;
use App\Services\MomoService;

class PaymentController extends Controller
{
    public function returnVnpay(Request $req)
    {
        $params = $req->all();

        if (!VnPayService::verifySignature($params)) {
            return view('checkout_failed')->with('message', 'Chữ ký không hợp lệ');
        }

        $orderId = $params['vnp_TxnRef'] ?? null;
        $responseCode = $params['vnp_ResponseCode'] ?? null;
        $transactionNo = $params['vnp_TransactionNo'] ?? null;

        $order = Order::find($orderId);
        if (!$order) {
            return view('checkout_failed')->with('message', 'Đơn hàng không tồn tại');
        }

        if ($responseCode === '00') {
            $order->payment_status = 'paid';
            $order->transaction_id = $transactionNo;
            $order->save();
            return view('checkout_success', compact('order'));
        } else {
            $order->payment_status = 'failed';
            $order->save();
            return view('checkout_failed', compact('order'));
        }
    }

    public function notifyMomo(Request $req)
    {
        $payload = $req->all();

        if (!MomoService::verifySignature($payload)) {
            return response()->json(['status' => 'invalid signature'], 400);
        }

        $orderId = $payload['orderId'] ?? null;
        $errorCode = $payload['errorCode'] ?? null;
        $requestId = $payload['requestId'] ?? null;

        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['status' => 'order not found'], 404);
        }

        if ($errorCode == 0) {
            $order->payment_status = 'paid';
            $order->transaction_id = $requestId;
        } else {
            $order->payment_status = 'failed';
        }
        $order->save();

        return response()->json(['status' => 'ok']);
    }

    public function returnMomo(Request $req)
    {
        $errorCode = $req->input('errorCode');
        $orderId = $req->input('orderId');
        $order = Order::find($orderId);

        if (!$order) {
            return view('checkout_failed')->with('message', 'Đơn hàng không tồn tại');
        }

        if ($errorCode == 0) {
            return view('checkout_success', compact('order'));
        } else {
            return view('checkout_failed', compact('order'));
        }
    }
}
