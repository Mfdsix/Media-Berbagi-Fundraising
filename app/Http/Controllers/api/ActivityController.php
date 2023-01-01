<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;

class ActivityController extends Controller
{
	public function index(Request $request)
	{
		$page = ($request->page) ?? 1;
		$limit = $request->limit ?? 10;

		$activities = Activity::when(true, function($q) use($page, $limit) {
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
		->where('activity_date', '>=', now())
		->orderBy('activity_date', 'ASC')
		->get();

		foreach ($activities as $key => $value) {
			$value->path = asset('storage/'.$value->path);
		}

		return $this->success($activities);
	}

	public function show($id)
	{
		$activity = Activity::find($id);

		if($activity){
			$activity->path = asset($activity->path);
			return $this->success($activity);
		}

		return $this->error('Kegiatan Tidak Ditemukan', 404);
	}
}
