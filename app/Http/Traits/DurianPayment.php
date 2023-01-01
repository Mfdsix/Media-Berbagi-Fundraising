<?php

namespace App\Http\Traits;

use App\Http\Traits\Request\DurianRequest;
use App\Models\Funding;
use App\Models\Fundraiser;
use App\Models\FundraiserTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\InstantProgram;


trait DurianPayment
{
    use DurianRequest;

    private static $PAYMENT_GROUP = [
        'VA' => 'va',
        'RETAILSTORE' => 'store',
        'QRIS' => 'ewallet',
        'EWALLET' => 'ewallet',
        'ONLINE_BANKING' => 'ibank',
    ];

    public static function getPaymentMethods()
    {
        $content = file_get_contents(app_path("Http/Traits/Material/durian-payment-methods.json"));
        $json = json_decode($content);

        $group = [];
        foreach ($json as $k => $v) {
            $groupName = isset(self::$PAYMENT_GROUP[$v->type]) ? self::$PAYMENT_GROUP[$v->type] : 'others';
            $item = [
                'title' => $v->title,
                'code' => $v->code,
                'type' => $v->type,
                'fee' => [
                    'flat' => 0,
                    'percent' => 0,
                ],
                'icon' => asset('/images/payment_channel/' . $v->icon),
            ];

            if (isset($group[$groupName])) {
                array_push($group[$groupName], $item);
            } else {
                $group[$groupName] = [$item];
            }
        }

        return $group;
    }

    public static function getTransactionFee($total, $fee)
    {
    }

    public static function postTransaction($credential, $post, $campaign)
    {
        $order = self::createOrder($credential, $post, $campaign);
        if ($order) {
            $charge = self::paymentCharge($credential, $order, $campaign);
            if ($charge) {
                // handle each response
                if ($post['payment_type'] == 'virtualaccount') {
                    $order['pay_code'] = $charge->account_number;
                } elseif ($post['payment_code'] == 'QRIS') {
                    $order['qr_type'] = 'base64';
                    $order['qr_code'] = $charge->qr_code;
                } elseif ($post['payment_type'] == 'ewallet') {
                    if (isset($charge->checkout_url)) {
                        $order['pay_url'] = $charge->checkout_url;
                    }
                } elseif ($post['payment_type'] == 'store') {
                    $order['pay_code'] = $charge->account_number;
                } elseif ($post['payment_type'] == 'ibank') {
                    $order['pay_url'] = $charge->web_url;
                }
                // $order['total'] = str_replace($charge->paid_amount, '.00', '');
                // if ($order['total'] != $order['nominal']) {
                //     $order['additional_fee'] = (int) $order['total'] - (int) $order['nominal'];
                // }

                $fundingCreation = Funding::create($order);
                return [
                    'type' => 'data',
                    'data' => $fundingCreation,
                ];
            }
        }

        return null;
    }

    public static function getTransactionDetail($credential, $transaction)
    {
        $content = file_get_contents(app_path("Http/Traits/Material/durian-payment-methods.json"));
        $json = json_decode($content);

        $icon = asset("images/payment_channel/default.png");
        foreach ($json as $k => $v) {
            if ($v->title == $transaction->payment_method) {
                $icon = asset('/images/payment_channel/' . $v->icon);
            }
        }

        return [
            'pay_code' => $transaction->pay_code,
            'invoice' => $transaction->bill_no,
            'icon' => $icon,
            'instruction' => [],
        ];
    }

    public static function paymentCallback($credential, Request $request)
    {
        $json = $request->getContent();
        $data = json_decode($json);

        if ($data->event == "payment.completed") {

            $data = $data->data;
            $funding = Funding::where('reference', $data->order_id)
                ->where('total', $data->amount)
                ->first();

            if (!$funding) {
                return json_encode(['error' => 'Transaction Not Found, Reference:' . $data->order_id]);
            } elseif ($funding->status != 'pending') {
                return json_encode(['error' => 'Transaction Status Changed, ' . $funding->status]);
            }

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
                return json_encode(['error' => 'Update Failed, ' . $e->getMessage()]);
            }

        }

        return json_encode(['message' => 'Unhandled Event Type: ' . $data->event]);
    }
}
