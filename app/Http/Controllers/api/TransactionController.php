<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\Bank;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Storage;
use Auth;
use Validator;


class TransactionController extends Controller
{
	public function index(Request $request)
	{
		$type = ($request->type) ?? null;
		$page = ($request->page) ?? 1;
		$limit = $request->limit ?? 10;
		$status = $request->status ?? null;
		$category = $request->category_id ?? null;
		$days = $request->days ?? null;
		$dateRange = $request->dateRange ? explode(',', $request->dateRange) : [];

		$fund = Funding::leftJoin('projects as p', 'p.id', '=', 'fundings.project_id')
		->select('fundings.*', 'p.category_id')
		->where('fundings.user_id', Auth::user()->id)
		->when($type, function($q) use ($type){
			return $q->where('fundings.fund_type', $type);
		})
		->when(true, function($q) use($page, $limit) {
			if($page == 0){
				$page = 1;
			}
			if($limit == 0){
				$limit = 15;
			}
			if($limit > 30){
				$limit = 30;
			}

			return $q->offset(($page-1) * $limit)
			->limit($limit);
		})
		->when($status, function($q) use ($status){
			return $q->where('fundings.status', $status);
		})
		->when($category, function($q) use ($category){
			return $q->where('category_id', $category);
		})
		->when($days, function($q) use ($days){
			$range = Date('Y-m-d H:i:s', strtotime('-'.$days.' days'));
			return $q->where('fundings.created_at', '>=', $range);
		})
		->when((count($dateRange) == 2), function($q) use ($dateRange){
			return $q->where('fundings.created_at', '>=', Date('Y-m-d H:i:s', strtotime($dateRange[0])))
			->where('fundings.created_at', '<', Date('Y-m-d H:i:s', strtotime($dateRange[1].'+1 days')));
		})
		->orderBy('id', 'DESC')
		->get();

		foreach ($fund as $key => $value) {
			$value->project = $value->project;
			$value->category = $value->category();
		}

		return $this->success($fund);
	}

	public function show($id)
	{
		$fund = Funding::find($id);

		if(!$fund){
			return $this->error("Transaksi Tidak Ditemukan", 404);
		}

		return $this->success($fund);
	}

	public function how_to_pay($id)
	{
		$transaction = Funding::find($id);

		if(!$transaction){
			return $this->error("Transaksi Tidak Ditemukan", 404);
		}

		if($transaction->status != 'pending'){
			return $this->error("Status Transaksi Sudah Berubah");
		}

		$limit = explode(' ', $transaction->time_limit);
		$nominal = $transaction->nominal + $transaction->unique_code;
		$front = substr($nominal, 0, strlen($nominal)-3);
		$last = substr($nominal, strlen($nominal)-3, 3);

		$transaction->time_limit = $this->date_to_idn($limit[0]).' '.$limit[1];
		$transaction->nominal = $nominal;
		$transaction->nominal_formatted = str_replace(',', '.', number_format($front)).'.<span class="text-warning">'.$last.'</span>';

		$payment = null;
		if($transaction->payment_type == 'bank'){
			$payment = Bank::where('id', $transaction->payment_code)
			->first();
		}else{

			$baseUrl = config('app.tripay_url');
			$apiKey = config('app.tripay_api_key');

			$client = new Client([
				'base_uri' => $baseUrl
			]);
			$client->get('transaction/detail', [
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
				return view('notif')->with([
					'title' => json_decode($response->getBody())->message,
					'desc' => 'Mohon maaf, kami mengalami masalah mengakses transaksi anda'
				]);
			}else{
				return $this->error("Gagal Menghubungkan ke Payment Gateway");
			}
		}

		if($payment == null) {
			return response()->json([
				"message" => "Payment Method Tidak Ditemukan"
			], 400);
		}else{
			return $this->success([
				'transaction' => $transaction,
				'payment' => $payment,
				'instruction' => [
					"Rp $transaction->nominal", // nominal
					"Silahkan transfer ke nomor berikut ini sesuai metode pembayaran yang dipilih:", // instruksi
					"ke rekening $payment->bank_name", // nama bank
					"a.n $payment->bank_username", // bank username
					"$payment->bank_number", // bank number
					"Silahkan melakukan transfer sebelum $transaction->time_limit WIB, atau donasi akan otomatis dibatalkan oleh sistem kami.", // instruksi
					"PENTING! Mohon transfer tepat sampai 3 angka terakhir agar donasi anda lebih mudah diverifikasi", // penting 1
					"PENTING! Setelah transfer, mohon untuk mengirim bukti pembayaran dengan klik tombol di bawah", //penting 2
				],
			]);
		}
	}

	public function proof($id, Request $request)
	{
		$transaction = Funding::where('id', $id)
		->first();

		if($transaction == null){
			return $this->error('Transaksi Tidak Ditemukan', 404);
		}

		if($transaction->user_id != null && ($transaction->user_id != Auth::user()->id)){
			return $this->error('Transaksi Tidak Ditemukan', 404);
		}

		if(!in_array($transaction->status, ['pending', 'rejected'])){
			return $this->error('Status Transaksi Telah Berubah');
		}

		$validate = Validator::make($request->all(), [
			'file' => 'required|mimes:jpg,png,pdf,jpeg|max:2400'
		]);

		if($validate->fails()){
			return $this->error(implode(', ', $validate->messages()->all()), 422);
		}

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

		return $this->success("Upload Berhasil");
	}
}
