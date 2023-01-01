<?php

namespace App\Http\Controllers;

use App\Http\Traits\DurianPayment;
use App\Http\Traits\FaspayPayment;
use App\Http\Traits\TripayPayment;
use App\Models\PaymentCredential;
use App\Models\Setting;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getPaymentMethods()
    {
        $setting = Setting::find(1);
        if ($setting && $setting->payment_gateway_vendor) {

            $credential = PaymentCredential::pluck('value', 'key');

            if ($setting->payment_gateway_vendor == 'faspay') {
                return FaspayPayment::getPaymentMethods($credential);
            } elseif ($setting->payment_gateway_vendor == 'tripay') {
                return TripayPayment::getPaymentMethods($credential);
            } elseif ($setting->payment_gateway_vendor == 'durian') {
                return DurianPayment::getPaymentMethods($credential);
            }
        }

        return [];
    }

    public function postTransaction($post, $project)
    {
        $setting = Setting::find(1);
        if ($setting && $setting->payment_gateway_vendor) {

            $credential = PaymentCredential::pluck('value', 'key');

            if ($setting->payment_gateway_vendor == 'faspay') {
                return FaspayPayment::postTransaction($credential, $post, $project);
            } elseif ($setting->payment_gateway_vendor == 'tripay') {
                return TripayPayment::postTransaction($credential, $post, $project);
            } elseif ($setting->payment_gateway_vendor == 'durian') {
                return DurianPayment::postTransaction($credential, $post, $project);
            }
        }

        return false;
    }

    public static function getTransactionDetail($reference)
    {
        $setting = Setting::find(1);
        if ($setting && $setting->payment_gateway_vendor) {

            $credential = PaymentCredential::pluck('value', 'key');

            if ($setting->payment_gateway_vendor == 'faspay') {
                return FaspayPayment::getTransactionDetail($credential, $reference);
            } elseif ($setting->payment_gateway_vendor == 'tripay') {
                return TripayPayment::getTransactionDetail($credential, $reference);
            } elseif ($setting->payment_gateway_vendor == 'durian') {
                return DurianPayment::getTransactionDetail($credential, $reference);
            }
        }

        return false;
    }

    public function paymentCallback($type, Request $request)
    {
        if ($type) {
            $credential = PaymentCredential::pluck('value', 'key');
            if ($type == 'faspay') {
                $payment = FaspayPayment::paymentCallback($credential, $request);
                $response = json_decode($payment);
                if ($response->response_code == "00") {
                    $funding = $response->funding;
                    $this->templateMessage([
                        "type" => "thanks",
                        "funding" => $funding,
                    ]);
                    unset($response->funding);
                }
                return response()->json($response);
            } elseif ($type == 'tripay') {
                $payment = TripayPayment::paymentCallback($credential, $request);
                $response = json_decode($payment);
                if ($response->success == true) {
                    $funding = $response->funding;
                    $this->templateMessage([
                        "type" => "thanks",
                        "funding" => $funding,
                    ]);
                    unset($response->funding);
                }
                return response()->json($response);
            } elseif ($type == 'durian') {
                $payment = DurianPayment::paymentCallback($credential, $request);
                $response = json_decode($payment);
                if (isset($response->success) && $response->success == true) {
                    $funding = $response->funding;
                    $this->templateMessage([
                        "type" => "thanks",
                        "funding" => $funding,
                    ]);
                    unset($response->funding);
                }
                return response()->json($response);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Unknown Payment Gateway: ' . ($type ?? '-'),
        ], 400);
    }
}
