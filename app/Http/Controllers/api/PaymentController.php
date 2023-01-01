<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Funding;
use App\Models\Bank;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Carbon;
use App\Mail\PayReminder;
use Mail;
use Session;
use Setting;
use Validator;
use Auth;

class PaymentController extends Controller
{
	public function method()
	{
		$methods = $this->paymentMethod('bank');
		$wallet_available = 0;

		if(Auth::check()){
			$saldo = Auth::user()->saldo;
			if($saldo >= 1000){
				$wallet_available = $saldo;
			}
		}

		$fulltype = [
			'ewallet' => 'E-Wallet (Pembayaran Instan & Mudah)',
			'wallet' => 'Dompet Amal Maghfiroh (Minimal 1000)',
			'instant' => 'Pembayaran Instan (Terverifikasi Otomatis)',
			'bank' => 'Transfer Bank (Verifikasi dalam 1x24 jam)',
			'stores' => 'Convenience Store',
		];

		$parsed = [];
		foreach ($methods as $key => $value) {

			array_push($parsed, [
				'type' => $key,
				// 'fulltype' => $fulltype[$key],
				'fulltype' => $fulltype['bank'],
				'items' => $value
			]);
		}

		return $this->success($parsed);
	}

	public function payment_request($id, Request $request)
	{
		$project = Project::find($id);

		if(!$project){
			return $this->error('Program Tidak Ditemukan', 404);
		}

		$request->merge([
			'nominal' => str_replace('.', '', $request->nominal)
		]);

		$rules = [
			'payment_code' => 'required',
			'nominal' => 'required|integer',
			'donature_name' => 'required',
			'donature_email' => 'required',
			'is_anonymous' => 'required',
		];

		$split = explode("-",$request->payment_code);

		if($split[0] == 'wallet'){
			$saldo = Auth::user()->saldo;
			$rules['nominal'] .= '|min:1000|max:'.$saldo;
		}else{
			$rules['nominal'] .= '|min:10000';
		}

		$validate = Validator::make($request->all(), $rules);
		if($validate->fails()){
			return $this->error(implode(', ', $validate->messages()->all()), 422);
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
						'code' => $split[1]
					],
					'http_errors' => false,
				]);

				$status = $response->getStatusCode();
				$total = $request->nominal;
				if($status == 200){
					$body = json_decode($response->getBody())->data[0];
					if($body->charged_to == "customer"){
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
			'project_id' => $id,
			'user_id' => Auth::check() ? Auth::user()->id : null,
			'nominal' => $request->nominal,
			'payment_method' => $split[2],
			'donature_name' => $request->donature_name,
			'donature_email' => $request->donature_email,
			'donature_phone' => $request->donature_phone ?? '085802968281',
			'special_message' => $request->special_message,
			'wish_message' => $request->wish_message,
			'is_anonymous' => $request->is_anonymous,
			'unique_code' => 0,
			'additional_fee' => $payment_fee,
			'status' => 'pending',
			'payment_type' => $split[0],
			'payment_code' => $split[1],
			'total' => (int)$request->nominal,
			'time_limit' => Carbon::now()->addDay(3)->toDateTimeString(),
			'fund_type' => $project->type,
		];

		if($split[0] == 'bank' || $split[0] == 'wallet'){
			$process = $this->processNonPG($post);
		}else{
			$process = $this->processInstant($project, $post);
		}

		return $process;
	}

	public function processNonPG($post){
		if($post['payment_type'] == 'wallet'){
			$user = Auth::user();
			$user->update([
				'saldo' => $user->saldo - $post['total']
			]);
			$post['status'] = 'paid';
		}
		$funding = Funding::create($post);
		return $this->success($funding);
	}

	public function processInstant($project, $post){
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
				'customer_name' => $post['donature_name'],
				'customer_email' => $post['donature_email'],
				'customer_phone' => $post['donature_phone'],
				'order_items' => [
					[
						'sku' => 'DONASI-'.$post['project_id'],
						'name' => $project->title,
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

			return $this->processNonPG($post);
		}else{
			return $this->error('Gagal Menghubungkan ke Payment Gateway');
		}
	}
}
