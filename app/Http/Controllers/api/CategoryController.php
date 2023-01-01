<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectCategory;

class CategoryController extends Controller
{
	public function index()
	{
		$categories = ProjectCategory::all();

		foreach ($categories as $key => $value) {
			$value->path_icon = asset($value->path_icon);
		}
		return $this->success($categories);
	}
}
