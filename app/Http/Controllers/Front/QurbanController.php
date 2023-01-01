<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Qurban;
use App\Models\QurbanDetail;
use App\Models\QurbanPayment;
use App\Models\Bank;
use Auth;
use Session;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\RequestException;

class QurbanController extends Controller
{
    public function index()
    {
		$qurbans = Qurban::all();
		return view('front.qurban.index')->with([
			'datas' => $qurbans,
		]);
    }

    public function nominal(Request $request, $id)
	{	
		$qurbans = Qurban::all();
		return view('front.qurban.nominal')->with([
		'datas' => $qurbans,
		]);
	}

	public function nominal_process(Request $request, $id) {
		// note kalo payment g ada jadi error wkw						
		$request->merge([
			'nominal' => str_replace('.', '', $request->nominal)
		]);
		$request->merge([
			'payment' => session('payment')
		]);
		$rules = [
			'payment' => 'required',
			'qurban' => 'required',
			'atas_nama' => 'required',
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
		
		$x = $request->validate($rules);
		Session::put('payment_fee', 0);
		Session::put('unique_code', 0);

		$qurban = $request->qurban;
		if($qurban != null) {
			$qurban = json_decode(base64_decode($qurban), 1);
		}



		$payment_type = Session::get('payment_type');
		$post = [
			// 'project_id' => $id,
			'user_id' => Auth::check() ? Auth::user()->id : null,
			// 'nominal' => $request->nominal,
			'donatur_name' => $request->donature_name,
			'donatur_email' => $request->donature_email,
			'donatur_whatsapp' => $request->donature_phone,
			'unique_code' => $this->getUnique(),
			// 'additional_fee' => Session::get('payment_fee'),
			'status' => 'pending',
			'payment_type' => $payment_type,
			'payment_code' => session('payment_code'),
			'payment_method' => session('payment'),
			'nominal' => (int)$request->nominal + $this->getUnique(),
			'time_limit' => Carbon::now()->addDay(3)->toDateTimeString(),
			'atas_nama' => $request->atas_nama,
			'status' => 'pending',
		];

		// dd($qurban);

		$paymentr = QurbanPayment::create($post);		

		foreach($qurban as $k => $q) {
			$qurbanItems = Qurban::find($k);
			QurbanDetail::create([
				'qurban_id' => $qurbanItems->id,
				'quantity' => $q,
				'total_price' => $qurbanItems->price,
				'qurban_payment_id' => $paymentr->id,
				'user_id' => $paymentr->user_id,
			]);
		}


		if($payment_type == 'bank' || $payment_type == 'wallet'){
			// $process = $this->processNonPG($post);
		}else{

			$process = $this->processInstant($post);
		}


		Session::forget('nominal');
		Session::forget('unique_code');
		Session::forget('payment');

		// if($post['payment_type'] == 'wallet'){
		// 	return redirect('donation/'.$process->id)->with([
		// 		'success' => 'Transaksi anda telah disimpan, silahkan melakukan pembayaran'
		// 	]);
		// }else{
		// 	return redirect('payment/'.$process->id.'/how_to_pay')->with([
		// 		'success' => 'Transaksi anda telah disimpan, silahkan melakukan pembayaran'
		// 	]);
		// }


		if($post['payment_type'] == 'bank'){
			return redirect('/qurban/'.$paymentr->id.'/how_to_pay')->with([
				'success' => 'Transaksi anda telah disimpan, silahkan melakukan pembayaran'
			]);
		}else{
			return redirect($process);
		}
 

	}

	public function processInstant($post) {
		$funding = QurbanPayment::orderBy('id','DESC')->firstOrFail();
		$signature = sha1(md5((env('MERCHANT_USER').env('MERCHANT_PASSWORD').md5($funding->id))));
		$payloads = [
			"request" => "Post Data Transaction",
			"merchant_id" => env('MERCHANT_ID'),
			"merchant" => env('MERCHANT_NAME'),
			"bill_no" => md5($funding->id),
			"bill_reff" => "0",
			"bill_date" => now()->format('Y-m-d H:i:s'),
			"bill_expired" => $post['time_limit'],
			"bill_desc" => "Pembayaran qurban atas nama ".$post['donatur_name'],
			"bill_currency" => "IDR",
			"bill_gross" => "0",
			"bill_miscfee" => "0",
			"bill_total" => $post['nominal'],
			"cust_no" => $post['user_id'],
			"cust_name" => $post['donatur_name'],
			"payment_channel" => $post['payment_code'],
			"pay_type" => "1",
			"bank_userid" => "",
			"msisdn" => $post['donatur_whatsapp'],
			"email" => $post['donatur_email'],
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
	}

    public function history(Qurban $qurbans)
	{
		$qurban = QurbanDetail::where('user_id', Auth::user()->id)->get();

		return view('front.qurban.history',compact('qurban'));
	}

	public function choose_payment($id)
	{
		// $methods = $this->paymentMethod('all');
		$payment = $this->paymentAll();
		$wallet_available = 0;

		if(Auth::check()){
			$saldo = Auth::user()->saldo;
			if($saldo >= 10000){
				$wallet_available = $saldo;
			}
		}

		$banks = Bank::all();

		foreach ($banks as $key => $value) {
			$value->request_code = 'bank-'.$value->id.'-'.$value->bank_name;
			$value->fee = 0;
		}		

		return view('front.qurban.payment')->with([
			'banks' => $banks,
			'payment' => $payment,
			'wallet_available' => $wallet_available,
		]);
	}

	public function payment(Request $request,$id) {		
		Session::put('payment', $request->payment);
		Session::put('payment_type', $request->payment_type);
		Session::put('payment_code', $request->payment_code);

		return redirect('/qurban/'.$id.'/nominal?n='.$request->n.'&q='.$request->q);
	}

	public function how_to_pay(Request $request, $id) {
		$transaction = QurbanPayment::where('id', $id)
		->firstOrFail();

		if($transaction->user_id != null && ($transaction->user_id != Auth::user()->id)){
			abort(404);
		}

		if($transaction->status != 'pending'){
			return redirect('/donation/'.$id)->with([
				'warning' => 'Status Donasi Telah Berubah'
			]);
		}

		$limit = explode(' ', $transaction->time_limit);
		$nominal = $transaction->nominal + $transaction->unique_code;
		$front = substr($nominal, 0, strlen($nominal)-3);
		$last = substr($nominal, strlen($nominal)-3, 3);

		$transaction->time_limit = $this->date_to_idn($limit[0]).' '.$limit[1];
		$transaction->nominal = $nominal;
		$transaction->nominal_formatted = str_replace(',', '.', number_format($front)).'.<span class="text-warning">'.$last.'</span>';

		// $payment = null;
		// if($transaction->payment_type == 'bank'){
			$payment = Bank::where('id', $transaction->payment_code)
			->first();

			$view = 'front.qurban.how_to_pay';
		// }else{

		// 	$baseUrl = config('app.tripay_url');
		// 	$apiKey = config('app.tripay_api_key');

		// 	$client = new Client([
		// 		'base_uri' => $baseUrl
		// 	]);
		// 	$response = $client->get('transaction/detail', [
		// 		'headers' => [
		// 			'authorization' => 'Bearer '.$apiKey,
		// 			'accept' => 'Application/json'
		// 		],
		// 		'http_errors' => false,
		// 		'query' => [
		// 			'reference' => $transaction->reference,
		// 		]
		// 	]);

		// 	$status = $response->getStatusCode();
		// 	if($status == 200){
		// 		$body = json_decode($response->getBody())->data;
		// 		$payment = $body;
		// 		$nominal = $payment->amount;

		// 		$front = substr($nominal, 0, strlen($nominal)-3);
		// 		$last = substr($nominal, strlen($nominal)-3, 3);
		// 		$transaction->nominal = $nominal;
		// 		$transaction->nominal_formatted = str_replace(',', '.', number_format($front)).'.<span class="text-warning">'.$last.'</span>';

		// 		$transaction->time_limit = $this->date_to_idn(Date('Y-m-d', $payment->expired_time)).' '.Date('H:i:s', $payment->expired_time);
		// 		$transaction->icon = $this->getIcon($payment->payment_name);
		// 	}elseif($status == 404){
		// 		return view('notif')->with([
		// 			'title' => json_decode($response->getBody())->message,
		// 			'desc' => 'Mohon maaf, kami mengalami masalah mengakses transaksi anda'
		// 		]);
		// 	}else{
		// 		abort(500);
		// 	}

		// 	$view = 'front.qurban.how_to_pay';
		// }

		return view($view)->with([
			'transaction' => $transaction,
			'payment' => $payment,
			'unique_code' => $last,
		]);
	}

	public function proof($id) {
		$transaction = QurbanPayment::where('id', $id)
		->where('status', 'pending')
		->firstOrFail();

		if($transaction->user_id != null && ($transaction->user_id != Auth::user()->id)){
			abort(404);
		}

		if(!in_array($transaction->status, ['pending', 'rejected'])){
			return redirect('/donation/'.$id)->with([
				'warning' => 'Mohon Maaf, Status Donasi Telah Berubah'
			]);
		}

		$limit = explode(' ', $transaction->time_limit);
		$transaction->nominal = str_replace(',', '.', number_format($transaction->nominal));
		$transaction->time_limit = $this->date_to_idn($limit[0]).' '.$limit[1];

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

		return view('front.qurban.proof')->with([
			'data' => $transaction,
			'payment' => $bank,
		]);
	}

	public function proof_store(Request $request, $id) {
		$transaction = QurbanPayment::where('id', $id)
		->firstOrFail();

		if($transaction->user_id != null && ($transaction->user_id != Auth::user()->id)){
			abort(404);
		}

		if(!in_array($transaction->status, ['pending', 'rejected'])){
			return redirect('/donation/'.$id)->with([
				'warning' => 'Mohon Maaf, Status Donasi Telah Berubah'
			]);
		}

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
				'status' => 'waiting'
			]);
		}

		return redirect('/qurban/my-qurban')->with([
			'success' => 'Bukti Pembayaran Berhasil Diunggah'
		]);		
	}

}
