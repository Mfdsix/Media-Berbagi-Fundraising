<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inbox;
use Auth;

class NotificationController extends Controller
{
	public function index(Request $request){
		$page = ($request->page) ?? 1;
		$limit = $request->limit ?? 15;

		$inbox = Inbox::where('user_id', Auth::user()->id)
		->when(true, function($q) use($page, $limit){
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
		->orderBy('created_at', 'DESC')
		->get();

		foreach ($inbox as $key => $value) {
			$value->project = $value->project;
		}

		return $this->success($inbox);
	}

	public function show($id)
	{
		$inbox = Inbox::where('id', $id)
		->where('user_id', Auth::user()->id)
		->first();

		if(!$inbox){
			return $this->error('Notifikasi Tidak Ditemukan');
		}
		$inbox->project = $inbox->project;

		return $this->success($inbox);
	}
}
