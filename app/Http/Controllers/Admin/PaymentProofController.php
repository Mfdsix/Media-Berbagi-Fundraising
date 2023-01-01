<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\Bank;

class PaymentProofController extends Controller
{
	public function index(){
		$datas = Funding::where('status', 'waiting')
		->orderBy('created_at', 'DESC')
		->paginate(25);

		return view('admin.payment_proof.index')->with([
			'datas' => $datas
		]);
	}

	public function show($id){
		$data = Funding::findOrFail($id);

		if($data->payment_type == 'bank'){
			$bankAccount = Bank::where('id', $data->payment_code)
			->first();

			$bank = [
				'name' => $bankAccount->bank_name,
				'icon' => asset('storage/'.$bankAccount->path_icon)
			];
		}else{
			$bank = [
				'name' => $data->payment_method,
				'icon' => asset($this->getIcon($data->payment_method))
			];
		}

		return view('admin.payment_proof.show')->with([
			'data' => $data,
			'bank' => $bank
		]);
	}

	public function verify($id, Request $request){
		$data = Funding::findOrFail($id);

		$data->update([
			'status' => 'paid',
		]);

		return redirect('admin/payment_proof')->with([
			'success' => 'Bukti Pembayaran Telah Diverifikasi'
		]);
	}

	public function reject($id, Request $request){
		$data = Funding::findOrFail($id);

		$data->update([
			'status' => 'rejected',
			'reject_reason' => $request->reject_reason
		]);

		return redirect('admin/payment_proof')->with([
			'error' => 'Bukti Pembayaran Telah Ditolak'
		]);
	}
}
