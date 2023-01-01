<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Topup;
use App\Models\Bank;
use Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Session;

class TopupController extends Controller
{
	public function index()
	{	
		$topup = Topup::where('user_id', Auth::user()->id)
		// ->where('status',3)
		->orderBy('req_at', 'DESC')
		->paginate(25);
		$last = Topup::orderBy('id')
		->where('user_id', Auth::user()->id)
		->first();

		$byDate = [];

		foreach($topup as $v) {
			$date = base64_encode($v->created_at->format('d F Y'));
			if(empty($byDate[$date])){				
				$byDate[$date] = [$v];
			}else{
				array_push($byDate[$date], $v);
			}
		}

		return view('front.top_up.index')->with([
			'history' => $byDate,
			'user' => Auth::user(),
			'can_topup' => ($last == null || $last->status != 0),
		]);
	}

	public function nominal()
	{
		$methods = $this->paymentMethod('all');
		return view('front.top_up.nominal')->with([
			'methods' => $methods,
		]);
	}


	public function choose_payment()
	{	
		$payment = $this->paymentAll();

		$banks = Bank::all();

		foreach ($banks as $key => $value) {
			$value->request_code = 'bank-'.$value->id.'-'.$value->bank_name;
			$value->fee = 0;
		}

		return view('front.top_up.payment')->with([
			'banks' => $banks,
			'payment' => $payment,
			'banks' => $banks,
			'user' => Auth::user()
		]);
		
	}

	public function payment(Request $request)
	{
		Session::put('payment', $request->payment);
		Session::put('payment_type', $request->payment_type);
		Session::put('payment_code', $request->payment_code);

		return redirect('/top_up/nominal');
	}

	public function save(Request $request)
	{		
		$request->validate([
			'nominal' => 'required',
		]);
		$request->merge([
			'nominal' => str_replace('.', '', $request->nominal)
		]);

		$payment_type = Session::get('payment_type');;
		$payment_code = Session::get('payment_code');;
		$payment_method = Session::get('payment');;
		$extra_cost = $this->getUnique();
		$user = Auth::user();

		// $baseUrl = config('app.tripay_url');
		// $apiKey = config('app.tripay_api_key');

		// $client = new Client([
		// 	'base_uri' => $baseUrl
		// ]);
		// $response = $client->get('merchant/payment-channel', [
		// 	'headers' => [
		// 		'authorization' => 'Bearer '.$apiKey,
		// 		'accept' => 'Application/json'
		// 	],
		// 	'query' => [
		// 		'code' => $payment_code
		// 	],
		// 	'http_errors' => false,
		// ]);

		// $status = $response->getStatusCode();
		// if($status == 200){
		// 	$body = json_decode($response->getBody())->data[0];
		// 	if($body->charged_to == "customer"){
		// 		$extra_cost = $body->fee->flat + ceil($request->nominal * $body->fee->percent);
		// 	}
		// }else{
		// 	return view('errors.error')->with([
		// 		'message' => 'Gagal Menghubungkan ke Payment Gateway'
		// 	]);
		// }

		$data = [
			'nominal' => $request->nominal, //
			'extra_cost' => $extra_cost, ///
			'grand_total' => $request->nominal + $extra_cost, //
			'payment_type' => $payment_type, //
			'payment_code' => $payment_code, //
			'payment_method' => $payment_method, //
			'user_id' => $user->id,
			'req_at' => now(), //
			'status' => 1, //
		];
		
		// $merchantCode = config('app.tripay_merchant');
		// $baseUrl = config('app.tripay_url');
		// $apiKey = config('app.tripay_api_key');
		// $privateKey = config('app.tripay_private_key');
		// $merchantRef = '';
		// $amount = $data['nominal'];
		// $signature = hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey);

		// $item = [
		// 	'sku' => 'TPUP-'.Date('dmy').sprintf('%05d', Auth::user()->id),
		// 	'name' => 'Topup Rp '.number_format($amount, 0, ',', '.'),
		// 	'price' => $data['nominal'],
		// 	'quantity' => 1
		// ];
		
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
		// 		'method' => $data['payment_code'],
		// 		'amount' => $amount,
		// 		'customer_name' => $user->name,
		// 		'customer_email' => $user->email,
		// 		'customer_phone' => '085802968281',
		// 		'order_items' => [
		// 			$item,
		// 		],
		// 		'callback_url' => url('gateway/callback/topup'),
		// 		'return_url' => url('/'),
		// 		'signature' => $signature
		// 	]
		// ]);

		// $status = $response->getStatusCode();
		// if($status == 200){
		// 	$body = json_decode($response->getBody())->data;
		// 	$data['reference'] = $body->reference;
			$data['expire_at'] = Date('Y-m-d H:i:s', strtotime('+7 days'));
		// }else{
		// 	return view('errors.error')->with([
		// 		'error' => 'Gagal Menghubungkan Ke Payment Gateway'
		// 	]);
		// }

		$topup = Topup::create($data);
		return redirect('/top_up/'.$topup->id.'/how_to_pay');
	}

	public function how_to_pay($id)
	{
		$transaction = Topup::where('id', $id)
		->where('user_id', Auth::user()->id)
		->where('status', 1)
		->firstOrFail();

		$limit = explode(' ', $transaction->expire_at);
		$nominal = $transaction->grand_total;
		$front = substr($nominal, 0, strlen($nominal)-3);
		$last = substr($nominal, strlen($nominal)-3, 3);

		$transaction->expire_at = $this->date_to_idn($limit[0]).' '.$limit[1];
		$transaction->nominal = $nominal;
		$transaction->nominal_formatted = str_replace(',', '.', number_format($front)).'.<span class="text-primary">'.$last.'</span>';

		$payment = null;
		// $baseUrl = config('app.tripay_url');
		// $apiKey = config('app.tripay_api_key');

		// $client = new Client([
		// 	'base_uri' => $baseUrl
		// ]);
		// $response = $client->get('transaction/detail', [
		// 	'headers' => [
		// 		'authorization' => 'Bearer '.$apiKey,
		// 		'accept' => 'Application/json'
		// 	],
		// 	'http_errors' => false,
		// 	'query' => [
		// 		'reference' => $transaction->reference,
		// 	]
		// ]);

		// $status = $response->getStatusCode();
		// if($status == 200){
		// 	$body = json_decode($response->getBody())->data;
		// 	$payment = $body;
		// 	$nominal = $payment->amount;

		// 	$front = substr($nominal, 0, strlen($nominal)-3);
		// 	$last = substr($nominal, strlen($nominal)-3, 3);
		// 	$transaction->nominal = $nominal;
		// 	$transaction->nominal_formatted = str_replace(',', '.', number_format($front)).'.<span class="text-primary">'.$last.'</span>';

		// 	$transaction->time_limit = $this->date_to_idn(Date('Y-m-d', $payment->expired_time)).' '.Date('H:i:s', $payment->expired_time);
		// 	$transaction->icon = $this->getIcon($payment->payment_name);
		// }elseif($status == 404){
		// 	return view('errors.error')->with([
		// 		'error' => json_decode($response->getBody())->message,
		// 	]);
		// }else{
		// 	return view('errors.error')->with([
		// 		'error' => 'Gagal Menghubungkan Ke Payment Gateway',
		// 	]);
		// }

		if($transaction->payment_type == 'bank'){
			$bankAccount = Bank::where('id', $transaction->payment_code)
			->first();

			$bank = [
				'name' => $bankAccount->bank_name,
				'icon' => asset('storage/'.$bankAccount->path_icon),
				'number' => $bankAccount->bank_number,
				'username' => $bankAccount->bank_username
				//dd($bankAccount)
			];
		}else{
			$bank = [
				'name' => $transaction->payment_method,
				'icon' => asset($this->getIcon($transaction->payment_method)),
				'number' => $transaction->bank_number
			];
		}

		return view('front.top_up.how_to_pay')->with([
			'transaction' => $transaction,
			'bank' => $bank,
			'unique_code' => $last,
			// 'payment' => $payment
		]);
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

		return view('front.top_up.show')->with([
			'transaction' => $transaction,
			'payment' => $payment,
		]);
	}

	public function cancel($id)
	{
		$topup = Topup::where('id', $id)
		->where('status', 0)
		->firstOrFail();

		$topup->update([
			'status' => 2
		]);

		return redirect('/top_up');
	}

	public function proof($id) {
		$transaction = TopUp::where('id', $id)
		// ->where('status', 2)
		->firstOrFail();

		if($transaction->user_id != null && ($transaction->user_id != Auth::user()->id)){
			abort(404);
		}

		$transaction->nominal = str_replace(',', '.', number_format($transaction->nominal));

		if($transaction->payment_type == 'bank'){
			$bankAccount = Bank::where('id', $transaction->payment_code)
			->first();

			$bank = [
				'name' => $bankAccount->bank_name,
				'icon' => asset('storage/'.$bankAccount->path_icon)
			];
		}else{
			$bank = [
				'name' => $transaction->payment_method,
				'icon' => asset($this->getIcon($transaction->payment_method))
			];
		}

		return view('front.top_up.proof')->with([
			'data' => $transaction,
			'payment' => $bank,
		]);
	}

	public function store_proof($id, Request $request)
	{
		$transaction = Topup::where('id', $id)
		->firstOrFail();

		if($transaction->user_id != null && ($transaction->user_id != Auth::user()->id)){
			abort(404);
		}

		// if(!in_array($transaction->status, ['pending', 'rejected'])){
		// 	return redirect('/top_up/'.$id)->with([
		// 		'warning' => 'Mohon Maaf, Status Donasi Telah Berubah'
		// 	]);
		// }

		$request->validate([
			'file' => 'required|mimes:jpg,png,pdf,jpeg|max:2400'
		]);

		if($request->hasFile('file')){
			if($transaction->path_proof != null){
				Storage::delete($transaction->path_proof);
			}

			$filename = $request->file('file')->store('uploads/payment_proof');
			$transaction->update([
				'path_proof' => $filename,
				'status' => 2
			]);
		}

		return redirect('/top_up')->with([
			'success' => 'Bukti Pembayaran Berhasil Diunggah'
		]);		
	}
}
