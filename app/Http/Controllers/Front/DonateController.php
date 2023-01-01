<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Funding;
use App\Models\Bank;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Carbon;
use App\Mail\PayReminder;
use Mail;
use Session;
use Auth;
use Setting;

class DonateController extends Controller
{	

	public function input_nominal($id){
		$project = Project::findOrFail($id);

		return view('front.donate.nominal')->with([
			'project' => $project,
		]);
	}

	public function choose_payment($id)
	{
		$project = Project::findOrFail($id);
		// $methods = $this->paymentMethod('all');
		$payment = $this->paymentAll();
		$wallet_available = 0;

		if(Auth::check()){
			$saldo = Auth::user()->saldo;
			if($saldo >= 1000){
				$wallet_available = $saldo;
			}
		}

		$banks = Bank::all();

		foreach ($banks as $key => $value) {
			$value->request_code = 'bank-'.$value->id.'-'.$value->bank_name;
			$value->fee = 0;
		}

		return view('front.donate.payment')->with([
			'project' => $project,
			'banks' => $banks,
			'payment' => $payment,
			'wallet_available' => $wallet_available,
		]);
	}

	public function payment($id, Request $request)
	{
		$project = Project::findOrFail($id);

		Session::put('payment', $request->payment);
		Session::put('payment_type', $request->payment_type);
		Session::put('payment_code', $request->payment_code);

		return redirect('/project/'.$id.'/nominal?n='.$request->n);
	}

	public function nominal($id, Request $request){
		$project = Project::findOrFail($id);
		$request->merge([
			'nominal' => str_replace('.', '', $request->nominal)
		]);
		$rules = [
			'nominal' => 'required|numeric',
			'donature_name' => 'required',
			'donature_email' => 'required',
			'donature_phone' => 'numeric|nullable',
			'special_message' => 'nullable|string',
		];

		Session::put('nominal', $request->nominal);
		
		if(session('payment_type') == 'wallet'){
			$saldo = Auth::user()->saldo;
			$rules['nominal'] .= '|min:1000|max:'.$saldo;
		}else{
			$rules['nominal'] .= '|min:10000';
		}

		$request->validate($rules);
		Session::put('payment_fee', 0);
		Session::put('unique_code', 0);

		// if(session('payment_type') != 'wallet'){
			// $baseUrl = config('app.tripay_url');
			// $apiKey = config('app.tripay_api_key');

			// if(session('payment_type') == 'bank'){
				Session::put('payment_fee', 0);
			// }else{
			// 	$client = new Client([
			// 		'base_uri' => $baseUrl
			// 	]);
			// 	$response = $client->get('merchant/payment-channel', [
			// 		'headers' => [
			// 			'authorization' => 'Bearer '.$apiKey,
			// 			'accept' => 'Application/json'
			// 		],
			// 		'query' => [
			// 			'code' => Session::get('payment_code')
			// 		],
			// 		'http_errors' => false,
			// 	]);

			// 	$status = $response->getStatusCode();
			// 	$total = Session::get('nominal') + Session::get('unique_code');	
			// 	if($status == 200){
			// 		$body = json_decode($response->getBody())->data[0];
			// 		if($body->fee_customer){
			// 			$fee = $body->fee_customer->flat;
			// 			$fee += ceil(floatval($body->fee_customer->percent) / 100 * (int) $total);
			// 			Session::put('payment_fee', $fee);
			// 		}
			// 	}else{
			// 		abort(500);
			// 	}
			// }
		// }

		if(session('payment_type') == 'bank'){
			$total = (int)$request->nominal + $this->getUnique();
		}else{
			$total = (int) $request->nominal;
		}

		$payment_type = Session::get('payment_type');
		$post = [
			'project_id' => $id,
			'user_id' => Auth::check() ? Auth::user()->id : null,
			'nominal' => $request->nominal,
			'payment_method' => session('payment'),
			'donature_name' => $request->donature_name,
			'donature_email' => $request->donature_email,
			'donature_phone' => $request->donature_phone,
			'special_message' => $request->special_message,
			'is_anonymous' => $request->has('is_anonymous') ? 1 : 0,
			'unique_code' => $this->getUnique(),
			'additional_fee' => Session::get('payment_fee'),
			'status' => 'pending',
			'payment_type' => $payment_type,
			'payment_code' => session('payment_code'),
			'total' => $total,
			'time_limit' => Carbon::now()->addDay(3)->toDateTimeString(),
			'fund_type' => 'donation',
		];

		if($payment_type == 'bank' || $payment_type == 'wallet'){
			$process = $this->processNonPG($post);
		}else{
			$process = $this->processInstant($project, $post);
		}

		Session::forget('nominal');
		Session::forget('unique_code');
		Session::forget('payment');

		// dd($process);

		if($post['payment_type'] == 'bank'){
			return redirect('donation/'.$process->id)->with([
				'success' => 'Transaksi anda telah disimpan, silahkan melakukan pembayaran'
			]);
		}else{
			return redirect($process);
			// return redirect('payment/'.$process->id.'/how_to_pay')->with([
			// 	'success' => 'Transaksi anda telah disimpan, silahkan melakukan pembayaran'
			// ]);
		}
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
		return $funding;
	}

	public function processInstant($project, $post){

		$funding = Funding::orderBy('id','DESC')->firstOrFail();
		$signature = sha1(md5((env('MERCHANT_USER').env('MERCHANT_PASSWORD').md5($funding->id))));
		$payloads = [
			"request" => "Post Data Transaction",
			"merchant_id" => env('MERCHANT_ID'),
			"merchant" => env('MERCHANT_NAME'),
			"bill_no" => md5($funding->id),
			"bill_reff" => "0",
			"bill_date" => now()->format('Y-m-d H:i:s'),
			"bill_expired" => $post['time_limit'],
			"bill_desc" => "Pembayaran ".$project->title,
			"bill_currency" => "IDR",
			"bill_gross" => "0",
			"bill_miscfee" => "0",
			"bill_total" => $post['total'],
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
					"product" => "Invoice No. inv-".$funding->id."/".now()->format('Y-m')."/".md5($funding->id),
					"qty" => "1",
					"amount" => "1000000",
					"payment_plan" => "01",
					"merchant_id" => "99999",
				],
			],
			"reserve1" => "",
			"reserve2" => "",
			"signature" => $signature,
		];

		$baseUrl = env('MERCHANT_URL');

		$client = new Client();
		$response = $client->post($baseUrl.'cvr/300011/10', [
			'headers' => [
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
			],
			RequestOptions::JSON => $payloads,
			'http_errors' => false,
		]);

		$status = $response->getStatusCode();
		if($status == 200){
			$body = $response->getBody();
			$stringBody = (string) $body;
			$json = json_decode($stringBody);
			if($json == null) {
				$payment = false;
			}else{
				if(isset($json->response_error)) {
					// error
					dd($json->response_error);
				}else{
					$post['reference'] = $json->trx_id;
					Funding::create($post);
					return $json->redirect_url;

				}
			}
		}else{
			abort(404);
		}

		// $merchantCode = config('app.tripay_merchant');
		// $baseUrl = config('app.tripay_url');
		// $apiKey = config('app.tripay_api_key');
		// $privateKey = config('app.tripay_private_key');
		// $merchantRef = '';
		// $amount = $post['total'];

		// $signature = hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey);

		// $client = new Client([
		// 	'base_uri' => $baseUrl
		// ]);
		// $response = $client->post('transaction/create', [
		// 	'http_errors' => false,
		// 	'headers' => [
		// 		'authorization' => 'Bearer '.$apiKey,
		// 		'accept' => 'Application/json'
		// 	],
		// 	'form_params' => [
		// 		'method' => $post['payment_code'],
		// 		'amount' => $post['total'],
		// 		'customer_name' => $post['donature_name'],
		// 		'customer_email' => $post['donature_email'],
		// 		'customer_phone' => $post['donature_phone'],
		// 		'order_items' => [
		// 			[
		// 				'sku' => 'WAKAF-'.$post['project_id'],
		// 				'name' => $project->title,
		// 				'price' => $post['total'],
		// 				'quantity' => 1
		// 			]
		// 		],
		// 		'callback_url' => url('gateway/callback/tripay'),
		// 		'return_url' => url('/'),
		// 		'signature' => $signature
		// 	]
		// ]);

		// $status = $response->getStatusCode();
		// if($status == 200){
		// 	$body = json_decode($response->getBody())->data;
		// 	$post['reference'] = $body->reference;

		// 	return $this->processNonPG($post);
		// }else{
		// 	abort(500);
		// }
	}

	public function getRandom(){
		$nominal = Session::get('nominal');
		$method = Session::get('payment');

		$number = mt_rand(100,500);
		$check = Funding::where('nominal', $nominal)
		->where('status', 'pending')
		->where('unique_code' ,$number)
		->first();

		if($check){
			return $this->getRandom();
		}else{
			return $number;
		}
	}
}
