<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notif;
use App\Mail\NotifMail;
use App\User;
use Mail;

class NotifController extends Controller
{
	public function index()
	{
		$datas = Notif::orderBy('created_at', 'ASC')
		->paginate(25);

		return view('admin.notif.index')->with([
			'datas' => $datas
		]);
	}

	public function create()
	{
		return view('admin.notif.form');
	}

	public function store(Request $request)
	{
		$request->validate([
			'title' => 'required',
			'content' => 'required',
		]);

		Notif::create($request->all());
		return redirect('admin/notif')->with([
			'success' => 'Berhasil Menambahkan Notifikasi'
		]);
	}

	public function send(Request $request)
	{
		$notif = Notif::find($request->id);
		$current = $notif->sended;
		if(!$notif){
			return response()->json([
				'success' => false,
				'message' => 'Notif Tidak Ditemukan'
			]);
		}

		$email = User::where('level', 'fundraiser')
		->pluck('email');

		foreach ($email as $key => $value) {
			Mail::to($value)->send(new NotifMail($notif));
			$current++;
		}

		$notif->update([
			'sended' => $current
		]);

		return response()->json([
			'success' => true,
			'message' => 'ok',
			'sended' => $current
		]);
	}
}
