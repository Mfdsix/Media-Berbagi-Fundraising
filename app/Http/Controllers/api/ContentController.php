<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Doc;

class ContentController extends Controller
{
	public function aboutUs()
	{
		$content = Doc::where('field', 'about_us')
		->first();

		return $this->success($content);
	}

	public function termCondition()
	{
		$content = Doc::where('field', 'term_condition')
		->first();

		return $this->success($content);
	}

	public function help()
	{
		$content = Doc::where('field', 'help')
		->first();

		return $this->success($content);
	}

}
