<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use GuzzleHttp\Client;
use Exception;

class MomoService
{
    public static function createPayment($order)
    {
        $partnerCode = Config::get('services.momo.MOMO_PARTNER_CODE');
        $accessKey = Config::get('services.momo.MOMO_ACCESS_KEY');
        $secretKey = Config::get('services.momo.MOMO_SECRET_KEY');
        $endpoint = Config::get('services.momo.MOMO_ENDPOINT');
        $returnUrl = Config::get('services.momo.MOMO_RETURN_URL');
        $notifyUrl = Config::get('services.momo.MOMO_NOTIFY_URL');

        if (!$partnerCode || !$accessKey || !$secretKey || !$endpoint || !$returnUrl || !$notifyUrl) {
            throw new Exception('Momo configuration is missing.');
        }

        $orderId = $order->id;
        $amount = $order->total_amount;
        $orderInfo = "Payment for order #$orderId";
        $requestId = $orderId . '_' . time();
        $extraData = "";

        $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$notifyUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$returnUrl&requestId=$requestId&requestType=captureWallet";

        $signature = hash_hmac('sha256', $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => (string)$amount,
            'orderId' => (string)$orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $returnUrl,
            'ipnUrl' => $notifyUrl,
            'extraData' => $extraData,
            'requestType' => 'captureWallet',
            'signature' => $signature,
        ];

        try {
            $client = new Client();
            $response = $client->post($endpoint, [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            $body = json_decode($response->getBody(), true);

            if (isset($body['payUrl'])) {
                return $body['payUrl'];
            } else {
                throw new Exception('Momo payment URL not found in response.');
            }
        } catch (Exception $e) {
            throw new Exception('Momo payment request failed: ' . $e->getMessage());
        }
    }

    public static function verifySignature($req)
    {
        $secretKey = Config::get('services.momo.MOMO_SECRET_KEY');
        if (!$secretKey) {
            throw new Exception('Momo secret key is missing.');
        }

        $rawHash = "accessKey={$req['accessKey']}&amount={$req['amount']}&extraData={$req['extraData']}&message={$req['message']}&orderId={$req['orderId']}&orderInfo={$req['orderInfo']}&orderType={$req['orderType']}&partnerCode={$req['partnerCode']}&payType={$req['payType']}&requestId={$req['requestId']}&responseTime={$req['responseTime']}&resultCode={$req['resultCode']}&transId={$req['transId']}";

        $signature = hash_hmac('sha256', $rawHash, $secretKey);

        return $signature === $req['signature'];
    }
}
