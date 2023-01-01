<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fundraiser;
use App\Models\Funding;
use App\User;
use Storage;
use Auth;

class PendingController extends Controller
{
	public function index()
	{
		$datas = Fundraiser::where('is_confirmed', 0)
		->paginate(15);

		return view('admin.pending.index')->with([
			'datas' => $datas
		]);
	}

	public function show($id){
		$data = Fundraiser::findOrFail($id);

		return view('admin.pending.show')->with([
			'data' => $data,
		]);	
	}

	public function verify($id){
		$data = Fundraiser::findOrFail($id);
		$data->update([
			'is_confirmed' => 1
		]);

		return redirect('admin/pending')->with([
			'success' => 'User Berhasil Diverifikasi'
		]);
	}
}
