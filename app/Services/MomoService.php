<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use GuzzleHttp\Client;

class MomoService {
    public static function createPayment($order) {
        $endpoint   = Config::get('services.momo.endpoint');       // env('MOMO_ENDPOINT')
        $partnerCode= Config::get('services.momo.partner_code');  // env('MOMO_PARTNER_CODE')
        $accessKey  = Config::get('services.momo.access_key');    // env('MOMO_ACCESS_KEY')
        $secretKey  = Config::get('services.momo.secret_key');    // env('MOMO_SECRET_KEY')
        $returnUrl  = Config::get('services.momo.return_url');    // env('MOMO_RETURN_URL')
        $notifyUrl  = Config::get('services.momo.notify_url');    // env('MOMO_NOTIFY_URL')
        $orderId    = $order->id;
        $requestId  = $order->id . '_' . now()->timestamp;
        $amount     = $order->total_amount;
        $orderInfo  = "Thanh toán đơn #$orderId";
        $extraData  = "";

        $requestType = "captureWallet";
        $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$notifyUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$returnUrl&requestId=$requestId&requestType=$requestType";
        $signature = hash_hmac('sha256', $rawHash, $secretKey);

        $body = [
            "partnerCode" => $partnerCode,
            "accessKey"   => $accessKey,
            "requestId"   => $requestId,
            "amount"      => $amount,
            "orderId"     => $orderId,
            "orderInfo"   => $orderInfo,
            "redirectUrl" => $returnUrl,
            "ipnUrl"      => $notifyUrl,
            "extraData"   => $extraData,
            "requestType" => $requestType,
            "signature"   => $signature,
        ];

        $client = new Client();
        $response = $client->post($endpoint, [
            'json' => $body
        ]);
        $resData = json_decode($response->getBody(), true);
        return $resData['payUrl'] ?? null;
    }

    public static function verifySignature($req) {
        $accessKey = Config::get('services.momo.access_key');
        $secretKey = Config::get('services.momo.secret_key');
        // Parse payload từ Momo (notify)
        $orderId      = $req['orderId']      ?? '';
        $requestId    = $req['requestId']    ?? '';
        $amount       = $req['amount']       ?? '';
        $orderInfo    = $req['orderInfo']    ?? '';
        $orderType    = $req['orderType']    ?? '';
        $transId      = $req['transId']      ?? '';
        $message      = $req['message']      ?? '';
        $localMessage = $req['localMessage'] ?? '';
        $responseTime = $req['responseTime'] ?? '';
        $errorCode    = $req['errorCode']    ?? '';
        $payType      = $req['payType']      ?? '';
        $extraData    = $req['extraData']    ?? '';
        $signature    = $req['signature']    ?? '';

        $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&errorCode=$errorCode&localMessage=$localMessage&message=$message&orderId=$orderId&orderInfo=$orderInfo&orderType=$orderType&partnerCode=$partnerCode&payType=$payType&requestId=$requestId&responseTime=$responseTime&transId=$transId";
        $checkSignature = hash_hmac('sha256', $rawHash, $secretKey);
        return $signature === $checkSignature;
    }
}
