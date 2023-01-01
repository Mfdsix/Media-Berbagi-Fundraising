<?php

namespace App\Http\Traits\Request;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Str;

trait DurianRequest
{
    public static function createOrder($credential, $post, $campaign)
    {
        $baseUrl = isset($credential['durian_merchant_url']) ? $credential['durian_merchant_url'] : null;
        $apiKey = isset($credential['durian_merchant_api_key']) ? $credential['durian_merchant_api_key'] : null;

        $bill_no = 'INV-' . date('YmdHis') . Str::random(8);
        $requestBody = [
            'amount' => $post['total'] . '.00',
            'payment_option' => 'full_payment',
            'currency' => 'IDR',
            'order_ref_id' => $bill_no,
            'customer' => [
                'customer_ref_id' => $post['user_id'] ?? Str::random(6),
                'email' => $post['donature_email'] ?? 'mediaberbagi@gmail.com',
                'mobile' => $post['donature_phone'] ?? '085xxxxxxxxx',
                'given_name' => $post['donature_name'] ?? 'Donatur',
                'address' => [
                    'receiver_name' => $post['donature_name'] ?? 'Donatur',
                    'receiver_phone' => $post['donature_phone'] ?? '085xxxxxxxxx',
                    'label' => 'Alamat Utama',
                    'address_line_1' => 'Address Line 1',
                    'address_line_2' => 'Address Line 1',
                ],
            ],
            'items' => [
                [
                    "name" => "Donasi untuk " . $campaign->title,
                    'sku' => 'CAMPAIGN-' . $campaign->id,
                    "qty" => 1,
                    "price" => $post['total'] . ".00",
                    "logo" => asset('/storage/' . $campaign->featured_path),
                ],
            ],
            "metadata" => [
                'description' => 'Order dari donasi platform MediaBerbagi',
            ],
        ];

        $client = new Client([
            'base_uri' => $baseUrl,
        ]);
        $response = $client->post('orders', [
            'headers' => [
                'accept' => 'Application/json',
            ],
            'auth' => [
                $apiKey, null,
            ],
            RequestOptions::JSON => $requestBody,
            'http_errors' => false,
        ]);

        $status = $response->getStatusCode();
        if ($status == 201) {
            $body = json_decode($response->getBody())->data;
            $orderId = $body->id;
            $merchantRef = $body->order_ref_id;

            $post['reference'] = $orderId;
            $post['bill_no'] = $merchantRef;

            return $post;
        }
        return null;
    }

    public static function paymentCharge($credential, $post, $campaign)
    {
        $total = $post['total'] . '.00';

        $requestBody = [];
        // VA
        if ($post['payment_type'] == 'virtualaccount') {
            $requestBody = [
                'type' => 'VA',
                'request' => [
                    'order_id' => $post['reference'],
                    'bank_code' => $post['payment_code'],
                    'name' => $post['donature_name'] ?? 'Donasi',
                    'amount' => $total,
                ],
            ];
        } elseif ($post['payment_code'] == 'QRIS') {
            $requestBody = [
                'type' => 'QRIS',
                'request' => [
                    'amount' => $total,
                    'order_id' => $post['reference'],
                    'name' => $post['donature_name'] ?? 'Donasi',
                    'type' => "QRIS",
                ],
            ];
        } elseif ($post['payment_type'] == 'ewallet') {
            $requestBody = [
                'type' => 'EWALLET',
                'request' => [
                    'order_id' => $post['reference'],
                    'amount' => $post['total'],
                    'mobile' => $post['donature_phone'],
                    'wallet_type' => $post['payment_code'],
                ],
            ];
        } elseif ($post['payment_type'] == 'store') {
            $requestBody = [
                'type' => 'RETAILSTORE',
                'request' => [
                    'order_id' => $post['reference'],
                    'bank_code' => $post['payment_code'],
                    'name' => $post['donature_name'] ?? 'Donatur',
                    'amount' => $total,
                ],
            ];
        } elseif ($post['payment_type'] == 'ibank') {
            $requestBody = [
                'type' => 'ONLINE_BANKING',
                'request' => [
                    'order_id' => $post['reference'],
                    'type' => $post['payment_code'],
                    'name' => $post['donature_name'] ?? 'Donatur',
                    'amount' => $total,
                ],
                'customer_info' => [
                    'email' => $post['donature_email'] ?? 'mediaberbagi@gmail.com',
                    'given_name' => $post['donature_name'] ?? 'Donatur',
                    'id' => $post['user_id'] ?? String::random(6),
                ],
                'mobile' => $post['donature_phone'] ?? '085xxxxxxxxx',
            ];
        }

        return self::requestPaymentCharge($credential, $requestBody);
    }

    public static function requestPaymentCharge($credential, $requestBody)
    {
        $baseUrl = isset($credential['durian_merchant_url']) ? $credential['durian_merchant_url'] : null;
        $apiKey = isset($credential['durian_merchant_api_key']) ? $credential['durian_merchant_api_key'] : null;

        $client = new Client([
            'base_uri' => $baseUrl,
        ]);
        $response = $client->post('payments/charge', [
            'headers' => [
                'accept' => 'Application/json',
            ],
            'auth' => [
                $apiKey, null,
            ],
            RequestOptions::JSON => $requestBody,
            'http_errors' => false,
        ]);

        $status = $response->getStatusCode();
        if ($status == 200) {
            $body = json_decode($response->getBody())->data;
            return $body->response;
        }

        return null;
    }
}
