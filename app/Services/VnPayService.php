<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class VnPayService {
    public static function createPaymentUrl($order) {
        $vnpUrl      = Config::get('services.vnpay.url');       // lấy từ env('VNP_URL')
        $vnpTmnCode  = Config::get('services.vnpay.tmn_code'); // lấy từ env('VNP_TMN_CODE')
        $vnpHash     = Config::get('services.vnpay.hash_secret'); // từ env('VNP_HASH_SECRET')
        $vnpReturn   = Config::get('services.vnpay.return_url');  // từ env('VNP_RETURN_URL')
        $amount      = $order->total_amount * 100;
        $createDate  = now()->format('YmdHis');
        $orderId     = $order->id;
        $locale      = 'vn';
        $ipAddr      = request()->ip();

        $data = [
            'vnp_Version'    => '2.1.0',
            'vnp_TmnCode'    => $vnpTmnCode,
            'vnp_Amount'     => $amount,
            'vnp_Command'    => 'pay',
            'vnp_OrderInfo'  => "Thanh toán đơn #$orderId",
            'vnp_OrderType'  => 'other',
            'vnp_Locale'     => $locale,
            'vnp_ReturnUrl'  => $vnpReturn,
            'vnp_IpAddr'     => $ipAddr,
            'vnp_CreateDate' => $createDate,
            'vnp_TxnRef'     => $orderId,
        ];
        ksort($data);
        $query = http_build_query($data);
        $hashData = implode('&', array_map(
            fn($k, $v) => "$k=$v",
            array_keys($data),
            $data
        ));
        $data['vnp_SecureHash'] = hash_hmac('sha512', $hashData, $vnpHash);
        return $vnpUrl . '?' . http_build_query($data);
    }

    public static function verifySignature($params) {
        $vnpHash = Config::get('services.vnpay.hash_secret');
        $secureHash = $params['vnp_SecureHash'] ?? '';
        unset($params['vnp_SecureHash'], $params['vnp_SecureHashType']);
        ksort($params);
        $hashData = implode('&', array_map(
            fn($k, $v) => "$k=$v",
            array_keys($params),
            $params
        ));
        $checkHash = hash_hmac('sha512', $hashData, $vnpHash);
        return $secureHash === $checkHash;
    }
}
