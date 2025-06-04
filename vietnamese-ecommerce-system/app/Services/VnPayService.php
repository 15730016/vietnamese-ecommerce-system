<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Exception;

class VnPayService
{
    public static function createPaymentUrl($order)
    {
        $vnpUrl = Config::get('services.vnpay.VNP_URL');
        $vnpTmnCode = Config::get('services.vnpay.VNP_TMN_CODE');
        $vnpHashSecret = Config::get('services.vnpay.VNP_HASH_SECRET');
        $vnpReturnUrl = Config::get('services.vnpay.VNP_RETURN_URL');

        if (!$vnpUrl || !$vnpTmnCode || !$vnpHashSecret || !$vnpReturnUrl) {
            throw new Exception('VNPay configuration is missing.');
        }

        $vnpParams = [
            'vnp_Version' => '2.1.0',
            'vnp_TmnCode' => $vnpTmnCode,
            'vnp_Amount' => $order->total_amount * 100,
            'vnp_Command' => 'pay',
            'vnp_CreateDate' => date('YmdHis'),
            'vnp_CurrCode' => 'VND',
            'vnp_IpAddr' => request()->ip(),
            'vnp_Locale' => 'vn',
            'vnp_OrderInfo' => 'Payment for order #' . $order->id,
            'vnp_OrderType' => 'other',
            'vnp_ReturnUrl' => $vnpReturnUrl,
            'vnp_TxnRef' => $order->id,
        ];

        ksort($vnpParams);
        $query = [];
        $hashData = '';
        foreach ($vnpParams as $key => $value) {
            $hashData .= $key . '=' . $value . '&';
            $query[] = urlencode($key) . '=' . urlencode($value);
        }
        $hashData = rtrim($hashData, '&');
        $vnpSecureHash = hash_hmac('sha512', $hashData, $vnpHashSecret);
        $query[] = 'vnp_SecureHash=' . $vnpSecureHash;

        return $vnpUrl . '?' . implode('&', $query);
    }

    public static function verifySignature($params)
    {
        $vnpHashSecret = Config::get('services.vnpay.VNP_HASH_SECRET');
        if (!$vnpHashSecret) {
            throw new Exception('VNPay hash secret is missing.');
        }

        $secureHash = $params['vnp_SecureHash'] ?? '';
        unset($params['vnp_SecureHash']);
        unset($params['vnp_SecureHashType']);

        ksort($params);
        $hashData = '';
        foreach ($params as $key => $value) {
            if ($key != 'vnp_SecureHash' && strlen($value) > 0) {
                $hashData .= $key . '=' . $value . '&';
            }
        }
        $hashData = rtrim($hashData, '&');

        $calculatedHash = hash_hmac('sha512', $hashData, $vnpHashSecret);

        return $secureHash === $calculatedHash;
    }
}
