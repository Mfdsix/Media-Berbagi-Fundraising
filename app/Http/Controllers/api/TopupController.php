<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Topup;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use Auth;

class TopupController extends Controller
{
    public function method() {
        $methods = $this->paymentMethod('all');
        return $this->success($methods);
    }

    public function save(Request $request) {
        $validator = Validator::make($request->all(), [
			'nominal' => 'required',
			'payment_type' => 'required',
			'payment_code' => 'required',
			'payment_method' => 'required',
		]);

        if($validator->fails()){
			return $this->error(implode(', ', $validator->messages()->all()), 422);
		}

		$request->merge([
			'nominal' => str_replace('.', '', $request->nominal)
		]);
		
		$payment_type = $request->payment_type;
		$payment_code = $request->payment_code;
		$payment_method = $request->payment_method;

		$extra_cost = 0;
		$user = auth()->user();

		$baseUrl = config('app.tripay_url');
		$apiKey = config('app.tripay_api_key');

		$client = new Client([
			'base_uri' => $baseUrl
		]);
		$response = $client->get('merchant/payment-channel', [
			'headers' => [
				'authorization' => 'Bearer '.$apiKey,
				'accept' => 'Application/json'
			],
			'query' => [
				'code' => $payment_code
			],
			'http_errors' => false,
		]);

		$status = $response->getStatusCode();
		if($status == 200){
			$body = json_decode($response->getBody())->data[0];
			if(isset($body->charged_to) && $body->charged_to == "customer"){
				$extra_cost = $body->fee->flat + ceil($request->nominal * $body->fee->percent);
			}
		}else{
			return view('errors.error')->with([
				'message' => 'Gagal Menghubungkan ke Payment Gateway'
			]);
		}

		$data = [
			'nominal' => $request->nominal,
			'extra_cost' => $extra_cost,
			'grand_total' => $request->nominal + $extra_cost,
			'payment_type' => $payment_type,
			'payment_code' => $payment_code,
			'payment_method' => $payment_method,
			'user_id' => $user->id,
			'req_at' => now(),
			'status' => 0,
		];
		
		$merchantCode = config('app.tripay_merchant');
		$baseUrl = config('app.tripay_url');
		$apiKey = config('app.tripay_api_key');
		$privateKey = config('app.tripay_private_key');
		$merchantRef = '';
		$amount = $data['nominal'];
		$signature = hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey);

		$item = [
			'sku' => 'TPUP-'.Date('dmy').sprintf('%05d', auth()->user()->id),
			'name' => 'Topup Rp '.number_format($amount, 0, ',', '.'),
			'price' => $data['nominal'],
			'quantity' => 1
		];
		
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
				'method' => $data['payment_code'],
				'amount' => $amount,
				'customer_name' => $user->name,
				'customer_email' => $user->email,
				'customer_phone' => $user->phone,
				'order_items' => [
					$item,
				],
				'callback_url' => url('gateway/callback/topup'),
				'return_url' => url('/'),
				'signature' => $signature
			]
		]);

		$status = $response->getStatusCode();
		if($status == 200){
			$body = json_decode($response->getBody())->data;
			$data['reference'] = $body->reference;
			$data['expire_at'] = Date('Y-m-d H:i:s', strtotime('+7 days'));
		}else{
			return view('errors.error')->with([
				'error' => 'Gagal Menghubungkan Ke Payment Gateway'
			]);
		}

		$topup = Topup::create($data);
		return $this->success($topup);
    }

    public function how_to_pay($id)
	{
		$transaction = Topup::where('id', $id)
		->where('user_id', Auth::user()->id)
		->where('status', 0)
		->firstOrFail();

		$limit = explode(' ', $transaction->expire_at);
		$nominal = $transaction->grand_total;
		$front = substr($nominal, 0, strlen($nominal)-3);
		$last = substr($nominal, strlen($nominal)-3, 3);

		$transaction->expire_at = $this->date_to_idn($limit[0]).' '.$limit[1];
		$transaction->nominal = $nominal;
		$transaction->nominal_formatted = str_replace(',', '.', number_format($front)).'.<span class="text-warning">'.$last.'</span>';

		$payment = null;
		$baseUrl = config('app.tripay_url');
		$apiKey = config('app.tripay_api_key');

		$client = new Client([
			'base_uri' => $baseUrl
		]);
		$response = $client->get('transaction/detail', [
			'headers' => [
				'authorization' => 'Bearer '.$apiKey,
				'accept' => 'Application/json'
			],
			'http_errors' => false,
			'query' => [
				'reference' => $transaction->reference,
			]
		]);

		$status = $response->getStatusCode();
		if($status == 200){
			$body = json_decode($response->getBody())->data;
			$payment = $body;
			$nominal = $payment->amount;

			$front = substr($nominal, 0, strlen($nominal)-3);
			$last = substr($nominal, strlen($nominal)-3, 3);
			$transaction->nominal = $nominal;
			$transaction->nominal_formatted = str_replace(',', '.', number_format($front)).'.<span class="text-warning">'.$last.'</span>';

			$transaction->time_limit = $this->date_to_idn(Date('Y-m-d', $payment->expired_time)).' '.Date('H:i:s', $payment->expired_time);
			$transaction->icon = $this->getIcon($payment->payment_name);
		}elseif($status == 404){
			return view('errors.error')->with([
				'error' => json_decode($response->getBody())->message,
			]);
		}else{
			return view('errors.error')->with([
				'error' => 'Gagal Menghubungkan Ke Payment Gateway',
			]);
		}

		$timeExplode = $parts = preg_split('/\s+/', $transaction->time_limit);
		$transaction->time_limit = $timeExplode[0]." ".$timeExplode[1]." ".$timeExplode[2];
		$transaction->time_only = last($timeExplode);

        $datas = [
			'transaction' => $transaction,
			'payment' => $payment,
		];

        return $this->success($datas);
	}

	public function detail($id)
	{
		$transaction = Topup::where('id', $id)
		->where('user_id', Auth::user()->id)
		->firstOrFail();

		$payment = [
			'payment_method' => $transaction->payment_method,
			'payment_type' => $transaction->payment_type,
			'icon' => $this->getIcon($transaction->payment_method),
		];

		$datas = [
			'transaction' => $transaction,
			'payment' => $payment,
		];

        return $this->success($datas);
	}

	public function cancel($id)
	{
		$topup = Topup::where('id', $id)
		->where('status', 0)
		->firstOrFail();

		$topup->update([
			'status' => 2
		]);

        return $this->success($topup);
	}

	public function history() {
		$histories = Topup::where('user_id', auth()->user()->id)->get();
		return $this->success($histories);
	}
}
