<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\VnPayService;
use App\Services\MomoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function returnVnpay(Request $request)
    {
        $params = $request->all();

        try {
            $valid = VnPayService::verifySignature($params);

            if ($valid && $params['vnp_ResponseCode'] === '00') {
                $order = Order::findOrFail($params['vnp_TxnRef']);
                $order->payment_status = 'paid';
                $order->transaction_id = $params['vnp_TransactionNo'];
                $order->status = 'processing';
                $order->save();

                Session::forget('cart');

                return view('checkout_success');
            } else {
                return view('checkout_failed');
            }
        } catch (\Exception $e) {
            return view('checkout_failed')->with('error', $e->getMessage());
        }
    }

    public function notifyMomo(Request $request)
    {
        $req = $request->all();

        try {
            $valid = MomoService::verifySignature($req);

            if ($valid && $req['resultCode'] == 0) {
                $order = Order::findOrFail($req['orderId']);
                $order->payment_status = 'paid';
                $order->transaction_id = $req['transId'];
                $order->status = 'processing';
                $order->save();

                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'fail']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function returnMomo(Request $request)
    {
        $params = $request->all();

        if (isset($params['errorCode']) && $params['errorCode'] == 0) {
            return view('checkout_success');
        } else {
            return view('checkout_failed');
        }
    }
}
