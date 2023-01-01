<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class SliderController extends Controller
{
	public function index(Request $request)
	{
		$position = $request->position ?? null;
		$slider = Slider::when($position, function($q) use($position){
			return $q->where('position', $position);
		})
		->get();

		return $this->success($slider);
	}
}
