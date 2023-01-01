<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Qurban;
use App\Models\QurbanDetail;
use App\Models\QurbanPayment;
use App\Models\QurbanCheckout;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QurbanController extends Controller
{
	public function myQurban(Request $request) {
		$qurbans = QurbanCheckout::where('user_id', auth()->user()->id)->get();
		return $this->success($qurbans);
	}

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'qurban_items' => 'required', // kambing|2|125000,sapi|3|240000
        ]);

        if($validator->fails()){
			return $this->error(implode(', ', $validator->messages()->all()), 422);
		}

        $items = explode(',', $request->qurban_items);

        $qurban = QurbanCheckout::create([
			'user_id' => auth()->check() == true ? auth()->user()->id : null,
		]);

        $grand_price = 0;
        $details = [];
        foreach($items as $k => $v) {
            $exp = explode('|', $v);
            $exp[1] = intval(str_replace('.', '', $exp[1]));
            $exp[2] = intval(str_replace('.', '', $exp[2]));

            $total_price = $exp[1] * $exp[2];
            $grand_price += $total_price;

            $details[] = QurbanDetail::create([
                'qurban_id' => $qurban->id,
                'field' => $exp[0],
                'quantity' => $exp[1],
                'total_price' => $total_price,
            ]);
        }
        $qurban->update(['grand_price' => $grand_price]);
        $qurban->details = $details;
        
        return $this->success($qurban);
    }

    public function detail($id) {
        $qurban = QurbanCheckout::with(['details'])->findOrFail($id);
        return $this->success($qurban);
    }

    public function method($id) {
        $methods = $this->paymentMethod('all');
        return $this->success($methods);
    }

    public function saveMethod(Request $request, $id) {
        $qurban = QurbanCheckout::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required',
            'payment_code' => 'required',
            'payment_type' => 'required',
        ]);

        if($validator->fails()){
			return $this->error(implode(', ', $validator->messages()->all()), 422);
		}

        $payment = QurbanPayment::create([
            'qurban_id' => $qurban->id,
            'payment_type' => $request->payment_type,
            'payment_method' => $request->payment_method,
            'payment_code' => $request->payment_code,
            'nominal' => $qurban->grand_price,
            'status' => 'pending',
        ]);

        return $this->success($payment);
    }

    public function transaction(Request $request, $id) {
		$qurban = QurbanCheckout::with(['payment'])->findOrFail($id);

        $rules = [
            'user_id' => 'nullable',
            'donatur_name' => 'required',
            'donatur_email' => 'required',
            'donatur_whatsapp' => 'required',
            'contact_whatsapp' => 'required',
            'atas_nama' => 'required',
        ];

        $split = explode("-",$request->payment_code);

		$validator = Validator::make($request->all(), $rules);
		
        if($validator->fails()){
			return $this->error(implode(', ', $validator->messages()->all()), 422);
		}

		$payment_fee = 0;
		if($split[0] != 'wallet'){
			$baseUrl = config('app.tripay_url');
			$apiKey = config('app.tripay_api_key');

			if($split[0] != 'bank'){
				$client = new Client([
					'base_uri' => $baseUrl
				]);
				$response = $client->get('merchant/payment-channel', [
					'headers' => [
						'authorization' => 'Bearer '.$apiKey,
						'accept' => 'Application/json'
					],
					'query' => [
						'code' => $qurban->payment->payment_code
					],
					'http_errors' => false,
				]);

				$status = $response->getStatusCode();
				
				$total = $qurban->grand_price;
				
				if($status == 200){
					$body = json_decode($response->getBody())->data[0];

					if(isset($body->charged_to) && $body->charged_to == "customer"){
						$fee = $body->fee->flat;
						$fee += ceil(floatval($body->fee->percent) / 100 * (int) $total);
						$payment_fee = $fee;
					}
				}else{
					return $this->error('Gagal Menghubungkan ke Payment Gateway');
				}
			}
		}

		$post = [
			'qurban_id' => $qurban->id,
			'user_id' => auth()->check() == true ? auth()->user()->id : null,
			'donatur_name' => $request->donatur_name,
			'donatur_email' => $request->donatur_email,
			'donatur_whatsapp' => $request->donatur_whatsapp,
			'contact_whatsapp' => $request->contact_whatsapp,
			'atas_nama' => $request->atas_nama,
			'unique_code' => 0,
			'additional_fee' => $payment_fee,
			'status' => 'pending',
			'payment_type' => $qurban->payment->payment_type,
			'payment_code' => $qurban->payment->payment_code,
			'payment_method' => $qurban->payment->payment_method,
			'total' => $qurban->grand_price,
			'time_limit' => Carbon::now()->addDay(3)->toDateTimeString(),
		];

		if($qurban->payment->payment_type == 'bank' || $qurban->payment->payment_type == 'wallet'){
			$process = $this->processNonPG($post, $qurban);
		}else{
			$process = $this->processInstant($qurban, $post);
		}

		return $this->success($process);
    }

	public function processNonPG($post, $qurban){
		$qurban->payment->update([
			'donatur_name' => $post['donatur_name'],
			'donatur_email' => $post['donatur_email'],
			'donatur_whatsapp' => $post['donatur_whatsapp'],
			'contact_whatsapp' => $post['contact_whatsapp'],
			'atas_nama' => $post['atas_nama'],
		]);
		return $this->success($qurban->payment);
	}

	public function processInstant($qurban, $post){
		$merchantCode = config('app.tripay_merchant');
		$baseUrl = config('app.tripay_url');
		$apiKey = config('app.tripay_api_key');
		$privateKey = config('app.tripay_private_key');
		$merchantRef = '';
		$amount = $post['total'];

		$signature = hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey);

		$client = new Client([
			'base_uri' => $baseUrl
		]);
		$response = $client->post('transaction/create', [
			'http_errors' => false,
			'headers' => [
				'authorization' => 'Bearer '.$apiKey,
				'accept' => 'Application/json'
			],
			'form_params' => [
				'method' => $post['payment_code'],
				'amount' => $post['total'],
				'customer_name' => $post['donatur_name'],
				'customer_email' => $post['donatur_email'],
				'customer_phone' => $post['donatur_whatsapp'],
				'order_items' => [
					[
						'sku' => 'QURBAN-'.$post['qurban_id'],
						'name' => $qurban->id,
						'price' => $post['total'],
						'quantity' => 1
					]
				],
				'callback_url' => url('gateway/callback/tripay'),
				'return_url' => url('/'),
				'signature' => $signature
			]
		]);

		$status = $response->getStatusCode();
		if($status == 200){
			$body = json_decode($response->getBody())->data;
			$post['reference'] = $body->reference;

			return $this->processNonPG($post, $qurban);
		}else{
			return $this->error('Gagal Menghubungkan ke Payment Gateway');
		}
	}

	public function howToPay($id) {
		$qurban = QurbanCheckout::with(['payment'])->first();
		return $this->success($qurban);
	}
}
