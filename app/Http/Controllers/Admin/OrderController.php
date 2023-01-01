<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;

class OrderController extends Controller
{
	public function index()
	{
		$projects = Project::where(function($q){
			$q->where('date_target', null)
			->orWhere('date_target', '>=', now());
		})
		->where('is_hidden', 0)
		->orderBy('order_number')
		->get();

		return view('admin.order.index')->with([
			'datas' => $projects
		]);
	}

	public function save(Request $request)
	{
		$request->validate([
			'order' => 'required'
		]);

		$order = 1;
		foreach ($request->order as $key => $value) {
			Project::where('id', $value)
			->update([
				'order_number' => (int)$order
			]);

			$order++;
		}

		return redirect('/admin/order')->with([
			'success' => 'Berhasil Mengubah Urutan'
		]);
	}
}
