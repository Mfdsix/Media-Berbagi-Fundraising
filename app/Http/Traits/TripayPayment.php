<?php

namespace App\Http\Traits;

use App\Models\Funding;
use App\Models\Fundraiser;
use App\Models\FundraiserTransaction;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\InstantProgram;


trait TripayPayment
{
    private static $PAYMENT_GROUP = [
        'Virtual Account' => 'va',
        'Convenience Store' => 'store',
        'E-Wallet' => 'ewallet',
    ];

    public static function getPaymentMethods($credential)
    {
        $methods = [];
        $baseUrl = isset($credential['tripay_merchant_url']) ? $credential['tripay_merchant_url'] : null;
        $apiKey = isset($credential['tripay_merchant_api_key']) ? $credential['tripay_merchant_api_key'] : null;

        $client = new Client([
            'base_uri' => $baseUrl,
        ]);
        $response = $client->get('merchant/payment-channel', [
            'headers' => [
                'authorization' => 'Bearer ' . $apiKey,
                'accept' => 'Application/json',
            ],
            'http_errors' => false,
        ]);

        $status = $response->getStatusCode();
        if ($status == 200) {
            $body = json_decode($response->getBody())->data;

            foreach ($body as $k => $v) {
                if ($v->active) {
                    $group = isset(self::$PAYMENT_GROUP[$v->group]) ? self::$PAYMENT_GROUP[$v->group] : 'others';
                    $item = [
                        'title' => $v->name,
                        'code' => $v->code,
                        'type' => $v->type,
                        'fee' => [
                            'flat' => $v->fee_customer->flat,
                            'percent' => $v->fee_customer->percent,
                        ],
                        'icon' => $v->icon_url,
                    ];

                    if (!isset($methods[$group])) {
                        $methods[$group] = [];
                    }
                    array_push($methods[$group], $item);
                }
            }
        }

        return $methods;
    }

    public static function getTransactionFee($total, $fee)
    {
        $totalFee = ((float) $fee['percent'] * $total) + $fee['flat'];
        return $total + $totalFee;
    }

    public static function postTransaction($credential, $post, $campaign)
    {

        $baseUrl = isset($credential['tripay_merchant_url']) ? $credential['tripay_merchant_url'] : null;
        $merchantCode = isset($credential['tripay_merchant_code']) ? $credential['tripay_merchant_code'] : null;
        $privateKey = isset($credential['tripay_merchant_private_key']) ? $credential['tripay_merchant_private_key'] : null;
        $apiKey = isset($credential['tripay_merchant_api_key']) ? $credential['tripay_merchant_api_key'] : null;
        $merchantRef = 'INV-' . date('YmdHis') . Str::random(8);
        $amount = $post['total'];

        $payloads = [
            'method' => $post['payment_code'],
            'merchant_ref' => $merchantRef,
            'amount' => $amount,
            'customer_name' => $post['donature_name'],
            'customer_email' => $post['donature_email'] ?? 'mediaberbagi@gmail.com',
            'customer_phone' => $post['donature_phone'] ?? '085xxxxxxx',
            'order_items' => [
                [
                    'sku' => 'CAMPAIGN-' . $campaign->id,
                    'name' => $campaign->title,
                    'price' => $amount,
                    'quantity' => 1,
                    'product_url' => url('/' . $campaign->slug),
                    'image_url' => asset('/storage/' . $campaign->featured_path),
                ],
            ],
            'signature' => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey),
        ];
        $client = new Client([
            'base_uri' => $baseUrl,
        ]);
        $response = $client->post('transaction/create', [
            'headers' => [
                'authorization' => 'Bearer ' . $apiKey,
                'accept' => 'Application/json',
            ],
            RequestOptions::JSON => $payloads,
            'http_errors' => false,
        ]);

        $status = $response->getStatusCode();
        if ($status == 200) {
            $requestPayment = json_decode($response->getBody())->data;
            $post['reference'] = $requestPayment->reference;
            $post['bill_no'] = $requestPayment->merchant_ref;
            $post['pay_code'] = $requestPayment->pay_code;
            $post['additional_fee'] = ceil($requestPayment->total_fee);
            $post['total'] = $post['total'] + ceil($requestPayment->total_fee);
            if (isset($requestPayment->qr_url)) {
                $post['pay_url'] = $requestPayment->qr_url;
            } else {
                $post['pay_url'] = $requestPayment->pay_url;
            }
            $fundingCreation = Funding::create($post);
            return [
                'type' => 'data',
                'data' => $fundingCreation,
            ];
        }

        return null;
    }

    public static function getTransactionDetail($credential, $transaction)
    {
        $baseUrl = isset($credential['tripay_merchant_url']) ? $credential['tripay_merchant_url'] : null;
        $apiKey = isset($credential['tripay_merchant_api_key']) ? $credential['tripay_merchant_api_key'] : null;

        $client = new Client([
            'base_uri' => $baseUrl,
        ]);
        $response = $client->get('transaction/detail', [
            'headers' => [
                'authorization' => 'Bearer ' . $apiKey,
                'accept' => 'Application/json',
            ],
            'query' => [
                'reference' => $transaction->reference,
            ],
            'http_errors' => false,
        ]);

        $status = $response->getStatusCode();
        if ($status == 200) {
            $body = json_decode($response->getBody())->data;
            $icon = asset("images/payment_channel/default.png");

            $response = $client->get('merchant/payment-channel', [
                'headers' => [
                    'authorization' => 'Bearer ' . $apiKey,
                    'accept' => 'Application/json',
                ],
                'query' => [
                    'code' => $body->payment_method,
                ],
                'http_errors' => false,
            ]);
            $status = $response->getStatusCode();
            if ($status == 200) {
                $payment = json_decode($response->getBody());
                if (isset($payment->data) && isset($payment->data[0]->icon_url)) {
                    $icon = $payment->data[0]->icon_url;
                }
            }

            return [
                'pay_code' => $body->pay_code,
                'invoice' => $body->merchant_ref,
                'instruction' => $body->instructions,
                'icon' => $icon,
                'payment' => $body,
            ];
        }

        return null;
    }

    public static function paymentCallback($credential, Request $request)
    {
        $privateKey = isset($credential['tripay_merchant_private_key']) ? $credential['tripay_merchant_private_key'] : null;
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');

        $json = $request->getContent();

        $signature = hash_hmac('sha256', $json, $privateKey);

        if ($signature !== (string) $callbackSignature) {
            return json_encode(['success' => false,'error' => 'Invalid signature']);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return json_encode(['success' => false,'error' => 'Invalid callback event, no action was taken']);
        }

        $data = json_decode($json);

        if (!$data) {
            return json_encode(['success' => false,'error' => 'Transaction Data Not Provided Correctly']);
        } else {
            $funding = Funding::where('bill_no', $data->merchant_ref)
                ->where('payment_code', $data->payment_method_code)
                ->where('reference', $data->reference)
                ->first();

            if (!$funding) {
                return json_encode(['success' => false,'error' => 'Transaction Not Found, ' . $data->merchant_ref]);
            } elseif ($funding->status != 'pending') {
                return json_encode(['success' => false,'error' => 'Transaction Status Changed, ' . $funding->status]);
            }

            switch ($data->status) {
                case 'PAID':
                    try {
                        DB::transaction(function () use ($funding) {
                            $funding->update([
                                'status' => 'paid',
                            ]);
                            if ($funding->referral_id) {
                                $referral = Fundraiser::where('user_id', $funding->referral_id)
                                    ->first();
                                if ($referral) {
                                    if($funding->project != null){
                                        $fee_reward = $funding->project->fundraiser_reward != null ? ($funding->project->fundraiser_reward / 100) : 0.01;
                                    }else{
                                        $fee_reward = 0.01;
                                        if($funding->project_id == 0){
                                            $fee_reward = 0.01;
                                            $instant = InstantProgram::where('program', $funding->fund_type)->first();
                                            $fee_reward = $instant->commision / 100;
                                        }
                                    }
                    
                                    $commission = ($funding->nominal * $fee_reward);
                                    
                                    // add commission
                                    FundraiserTransaction::create([
                                        'type' => 'commission',
                                        'amount' => $commission,
                                        'status' => 'success',
                                        'fundraiser_id' => $referral->id,
                                        'reference_id' => $funding->id,
                                        'user_id' => $referral->user_id,
                                    ]);

                                    $referral->update([
                                        'commissions' => $referral->commissions + $commission,
                                        'collected' => $referral->collected + ($funding->nominal),
                                        'success_transaction' => $referral->success_transaction + 1,
                                    ]);
                                }
                            }

                            DB::commit();
                        });

                        return json_encode(['success' => true, 'funding' => $funding]);
                    } catch (Exception $e) {
                        DB::rollback();
                        return json_encode(['success' => false,'error' => 'Update Failed, ' . $e->getMessage()]);
                    }

                case 'EXPIRED':
                    $funding->update([
                        'status' => 'expired',
                    ]);
                    return json_encode(['success' => false]);

                case 'FAILED':
                    $funding->update([
                        'status' => 'failed',
                    ]);
                    return json_encode(['success' => false]);

                default:
                    return json_encode(['success' => false,'error' => 'Unrecognized payment status']);
            }
        }
    }
}
