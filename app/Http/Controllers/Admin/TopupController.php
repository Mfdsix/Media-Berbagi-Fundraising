<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Topup;
use App\Models\Bank;
use App\User;

class TopupController extends Controller
{
	public function index()
	{
		$topup = Topup::leftJoin('users as u', 'u.id', 'topups.user_id')
		->orderBy('id', 'DESC')
		->select('topups.*', 'u.name as username')
		->paginate(25);

		return view('admin.topup.index')->with([
			'datas' => $topup
		]);
	}

	public function proof($id) 
	{
		$data = Topup::findOrFail($id);
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

		return view('admin.topup.proof')->with([
			'data' => $data,
			'bank' => $bank
		]);
	}
	public function verify($id, Request $request){
		$data = Topup::findOrFail($id);

		$data->update([
			'status' => 3,
		]);

		$user = User::find($data->user_id);
		$user->saldo = intval($user->saldo) + intval($data->nominal);
		$user->save();

		return redirect('admin/topup')->with([
			'success' => 'Bukti Pembayaran Telah Diverifikasi'
		]);
	}

	public function reject($id, Request $request){
		$data = Topup::findOrFail($id);

		$data->update([
			'status' => 4,
			'reject_reason' => $request->reject_reason
		]);

		return redirect('admin/topup')->with([
			'error' => 'Bukti Pembayaran Telah Ditolak'
		]);
	}
}
