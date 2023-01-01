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
use Session;
use App\Models\InstantProgram;

trait FaspayPayment
{
    private static $PAYMENT_DETAIL = [
        '702' => ['/images/payment_channel/svg/BCAmb_.svg', 'va', 'BCA Virtual Account', 4000], // virtual account
        '800' => ['/images/payment_channel/bri.png', 'va', 'BRI Virtual Account', 4000], // virtual account
        '802' => ['/images/payment_channel/svg/Mandirimb_.svg', 'va', 'Mandiri Virtual Account', 4000], // virtual account
        '801' => ['/images/payment_channel/svg/BNImb_.svg', 'va', 'BNI Virtual Account', 4000], // virtual account
        '402' => ['/images/payment_channel/svg/Permata Bankmb_.svg', 'va', 'Permata Virtual Account / PermataNet', 4000], // virtual account
        '408' => ['/images/payment_channel/svg/Maybankmb_.svg', 'va', 'Maybank Virtual Account', 4000], // virtual account
        '818' => ['/images/payment_channel/svg/Sinarmasmb_.svg', 'va', 'Sinarmas Virtual Account', 4000], // virtual account
        '825' => ['/images/payment_channel/cimb-niaga.png', 'va', 'CIMB Virtual Account', 4000], // virtual account
        '708' => ['/images/payment_channel/svg/Danamonmb_.svg', 'va', 'Danamon Virtual Account', 4000], // virtual account
        '401' => ['/images/payment_channel/bri-epay.png', 'ibank', 'BRI ePay', 5000], // internet banking
        '405' => ['/images/payment_channel/bca-klikpay.png', 'ibank', 'BCA KlikPay', 6000], // internet banking
        '700' => ['/images/payment_channel/octo-clicks.png', 'ibank', 'Octo Clicks', 5000], // internet banking
        '701' => ['/images/payment_channel/svg/Danamonmb_.svg', 'ibank', 'Danamon Online Banking', 5000], // internet banking
        '814' => ['/images/payment_channel/svg/Maybankmb_.svg', 'ibank', 'Maybank2U', 4000], // internet banking
        '420' => ['/images/payment_channel/permata-net.png', 'ibank', 'PermataNet', 4000], // internet banking
        '810' => ['/images/payment_channel/b-secure.png', 'others', 'B-Secure', null], // online debit
        '709' => ['/images/payment_channel/kredivo.png', 'others', 'Kredivo', null], // online credit
        '807' => ['/images/payment_channel/akulaku.png', 'others', 'Akulaku', null], // online credit
        '820' => ['/images/payment_channel/indodana.png', 'others', 'Indodana', null], // online credit
        '711' => ['/images/payment_channel/svg/QRIS (Quick Response Code Indonesia Standard) Logo (SVG) - Vector69Com 1mb_.svg', 'qris', 'QRIS', "0.7"], // qris payment
        '713' => ['/images/payment_channel/svg/Shoope Paymb_.svg', 'ewallet', 'ShopeePay Jump App', "1.5"], // e money
        '812' => ['/images/payment_channel/svg/OVOmb_.svg', 'ewallet', 'OVO', "1.5"], // e money
        '819' => ['/images/payment_channel/svg/DANAmb_.svg', 'ewallet', 'DANA', "1.5"], // e money
        '716' => ['/images/payment_channel/svg/Link Ajamb_.svg', 'ewallet', 'LinkAja AppLink', 3000], // e money
        '704' => ['/images/payment_channel/sakuku.png', 'ewallet', 'Sakuku', 6000], // e money
        '302' => ['/images/payment_channel/svg/Link Ajamb_.svg', 'ewallet', 'LinkAja', 3000], // e money
        '706' => ['/images/payment_channel/indomart.png', 'store', 'Indomaret Payment point', 2000], // retail payment
        '707' => ['/images/payment_channel/alfamart.png', 'store', 'Alfagroup', 5000], // retail payment
        '400' => ['/images/payment_channel/bri.png', 'others', 'Lainnya', null], // etc
        '410' => ['/images/payment_channel/bri.jpg', 'others', 'Lainnya', null], // etc
        '718' => ['/images/payment_channel/bri.jpg', 'others', 'Lainnya', null], // etc
    ];

    public static function getPaymentMethods($credential)
    {
        $baseUrl = isset($credential['faspay_merchant_url']) ? $credential['faspay_merchant_url'] : null;
        $merchant_id = isset($credential['faspay_merchant_id']) ? $credential['faspay_merchant_id'] : null;
        $merchant_name = isset($credential['faspay_merchant_name']) ? $credential['faspay_merchant_name'] : null;
        $username = isset($credential['faspay_merchant_user']) ? $credential['faspay_merchant_user'] : null;
        $password = isset($credential['faspay_merchant_password']) ? $credential['faspay_merchant_password'] : null;

        $signature = sha1(md5(($username . $password)));

        $client = new Client();
        $response = $client->post($baseUrl . 'cvr/100001/10', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            RequestOptions::JSON => [
                'request' => 'Request List of Payment Gateway',
                'merchant_id' => $merchant_id,
                'merchant' => $merchant_name,
                'signature' => $signature,
            ],
            'http_errors' => false,
        ]);

        $payment = [];

        $status = $response->getStatusCode();
        if ($status == 200) {
            $body = $response->getBody();
            $stringBody = (string) $body;
            if ($stringBody != null && $stringBody != "") {
                $json = json_decode($stringBody);
                if (!isset($json->response_error)) {
                    $payment = $json->payment_channel;
                    $group = [];
                    foreach ($payment as $p) {
                        $detail = self::$PAYMENT_DETAIL[$p->pg_code];
                        $item = [
                            'title' => $detail[2],
                            'code' => $p->pg_code,
                            'type' => $detail[1],
                            'fee' => [
                                'flat' => 0,
                                'percent' => 0,
                            ],
                            'icon' => asset($detail[0]),
                        ];

                        if (isset($group[$detail[1]])) {
                            array_push($group[$detail[1]], $item);
                        } else {
                            $group[$detail[1]] = [$item];
                        }
                    }
                    $payment = $group;
                }
            }
        }
        return $payment;
    }

    public static function getTransactionFee($total, $fee)
    {
        $totalFee = ((float) $fee['percent'] * $total) + $fee['flat'];
        return $total + $totalFee;
    }

    public static function postTransaction($credential, $post, $campaign)
    {
        $baseUrl = isset($credential['faspay_merchant_url']) ? $credential['faspay_merchant_url'] : null;
        $merchant_id = isset($credential['faspay_merchant_id']) ? $credential['faspay_merchant_id'] : null;
        $merchant_name = isset($credential['faspay_merchant_name']) ? $credential['faspay_merchant_name'] : null;
        $username = isset($credential['faspay_merchant_user']) ? $credential['faspay_merchant_user'] : null;
        $password = isset($credential['faspay_merchant_password']) ? $credential['faspay_merchant_password'] : null;
        $bill_no = 'INV-' . date('YmdHis') . Str::random(8);

        $signature = sha1(md5(($username . $password . $bill_no)));
        $payloads = [
            "request" => "Post Data Transaction",
            "merchant_id" => $merchant_id,
            "merchant" => $merchant_name,
            "bill_no" => $bill_no,
            "bill_reff" => "0",
            "bill_date" => now()->format('Y-m-d H:i:s'),
            "bill_expired" => $post['time_limit'],
            "bill_desc" => "Pembayaran " . $campaign->title,
            "bill_currency" => "IDR",
            "bill_gross" => "0",
            "bill_miscfee" => "0",
            "bill_total" => $post['total'] . '00',
            "cust_no" => $post['user_id'],
            "cust_name" => $post['donature_name'],
            "payment_channel" => $post['payment_code'],
            "pay_type" => "1",
            "bank_userid" => "",
            "msisdn" => $post['donature_phone'],
            "email" => $post['donature_email'],
            "terminal" => "10",
            "billing_name" => "0",
            "billing_lastname" => "0",
            "billing_address" => "",
            "billing_address_city" => "",
            "billing_address_region" => "",
            "billing_address_state" => "",
            "billing_address_poscode" => "",
            "billing_msisdn" => "",
            "billing_address_country_code" => "",
            "receiver_name_for_shipping" => "",
            "shipping_lastname" => "",
            "shipping_address" => "",
            "shipping_address_city" => "",
            "shipping_address_region" => "",
            "shipping_address_state" => "",
            "shipping_address_poscode" => "",
            "shipping_msisdn" => "",
            "shipping_address_country_code" => "",
            "item" => [
                [
                    "product" => "Invoice No. " . $bill_no,
                    "qty" => "1",
                    "amount" => $post['total'] . '00',
                    "payment_plan" => "01",
                    "merchant_id" => "99999",
                ],
            ],
            "reserve1" => "",
            "reserve2" => "",
            "signature" => $signature,
        ];

        $client = new Client();
        $response = $client->post($baseUrl . 'cvr/300011/10', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            RequestOptions::JSON => $payloads,
            'http_errors' => false,
        ]);

        $status = $response->getStatusCode();
        if ($status == 200) {
            $body = $response->getBody();
            $stringBody = (string) $body;
            $json = json_decode($stringBody);
            if ($json == null) {
                $payment = false;
            } else {
                if (isset($json->response_error)) {
                    return null;
                } else {
                    if ($post['payment_type'] == 'emoney' && $post['payment_code'] != 812) {
                        $post['reference'] = $json->redirect_url;
                    } else if ($post['payment_type'] == 'qris') {
                        if (isset($json->web_url)) {
                            $post['reference'] = $json->web_url;
                        } else {
                            return null;
                        }
                    }else if ($post['payment_type'] == 'ewallet' ){
                        $post['reference'] = $json->redirect_url;
                    } else {
                        $post['reference'] = $json->trx_id;
                    }

                    if($post["payment_method"] == "QRIS"){
                        //get qris image url
                        $post["reference"] = $json->alt_url;
                    }
                    
                    $post['bill_no'] = $json->bill_no;

                    //add to fee
                    $fee = self::$PAYMENT_DETAIL[$post["payment_code"]][3];
                    if(is_string($fee)) {
                        $fee = (float)$fee;
                        $post['additional_fee'] = $post["nominal"] * $fee / 100;
                    }else{
                        $post['additional_fee'] = $fee;
                    }

                    $fundingCreation = Funding::create($post);

                    if ($post['payment_code'] == 812) {
                        $signature = sha1(md5(($credential['faspay_merchant_user']. $credential['faspay_merchant_password'] . $json->trx_id)));
                        $baseUrl = $credential['faspay_merchant_url'] . 'pws/ovo_direct';
                        return [
                            'type' => 'view',
                            'funding' => $fundingCreation,
                            'data' => view('front.donate.ovo')->with([
                                'trx_id' => $json->trx_id,
                                'ovo_number' => $post['donature_phone'],
                                'signature' => $signature,
                                'url' => $baseUrl,
                                'project_id' => $fundingCreation->id,
                            ]),
                        ];
                    }

                    return [
                        'type' => 'data',
                        'data' => $fundingCreation,
                    ];
                }
            }
        }

        return null;
    }

    public static function getTransactionDetail($credential, $transaction)
    {
        $icon = asset("images/payment_channel/default.png");
        if (isset(self::$PAYMENT_DETAIL[$transaction->payment_code])) {
            $icon = asset(self::$PAYMENT_DETAIL[$transaction->payment_code][0]);
        }

        return [
            'pay_code' => $transaction->reference,
            'invoice' => $transaction->bill_no,
            'instruction' => [],
            'icon' => $icon,
        ];
    }

    public static function paymentCallback($credential, Request $request)
    {
        $username = isset($credential['faspay_merchant_user']) ? $credential['faspay_merchant_user'] : null;
        $password = isset($credential['faspay_merchant_password']) ? $credential['faspay_merchant_password'] : null;

        $data_notif = file_get_contents('php://input');
        $data = json_decode($data_notif);
        $funding = null;

        $response_code = "00";
        $response_desc = "Payment Sukses";

        if (!$data) {
            $response_code = "01";
            $response_desc = "Payment Data Not Provided Correctly";

            $response = array(
                "response" => "Payment Notification",
                "response_code" => $response_code,
                "response_desc" => $response_desc,
            );
            echo json_encode($response);
            return;
        } else {
            $signature = sha1(md5(($username . $password . $data->bill_no . $data->payment_status_code)));
            if ($data->signature == $signature) {
                // if (true) {

                if ($data->payment_status_code == '2') {

                    // process payment
                    try {
                        // Transaction
                        $funding = Funding::where('bill_no', $data->bill_no)
                            ->where('payment_code', $data->payment_channel_uid)
                            ->first();

                        if (!$funding) {
                            $response_code = "01";
                            $response_desc = "Payment Gagal, Transaksi Tidak Ditemukan";
                        } elseif ($funding->status != 'pending') {
                            $response_code = "01";
                            $response_desc = "Payment Gagal, Transaksi ini tidak aktif";
                        } else {
                            DB::transaction(function () use ($funding) {

                                $funding->update([
                                    'status' => 'paid',
                                ]);

                                $response_code = "00";
                                $response_desc = "Success";
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
                        }
                    } catch (Exception $e) {
                        DB::rollback();
                        $response_code = "01";
                        $response_desc = "Payment Gagal, " . $e->getMessage();
                    }
                } else {
                    $response_code = "01";
                    $response_desc = "Payment Gagal dengan status code " . $data->payment_status_code;
                }

            } else {
                $response_code = "01";
                $response_desc = "Payment Gagal, signature tidak cocok";
            }
        }

        $response = array(
            "response" => "Payment Notification",
            "trx_id" => $data->trx_id,
            "merchant_id" => $data->merchant_id,
            "merchant" => $data->merchant,
            "bill_no" => $data->bill_no,
            "response_code" => $response_code,
            "response_desc" => $response_desc,
            "response_date" => date('Y-m-d H:is'),
            "funding" => $funding,
        );
       return json_encode($response);
    }
}
