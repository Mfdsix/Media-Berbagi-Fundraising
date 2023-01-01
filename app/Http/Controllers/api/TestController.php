<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class TestController extends Controller
{
	public function wa(Request $request)
	{
		$validate = Validator::make($request->all(), [
			'phone' => 'required',
			'message' => 'required'
		]);

		if($validate->fails()){
			return $this->error(implode(', ', $validate->messages()->all()), 422);
		}

		$result = $this->sendWa($request->phone, $request->message);
		return $this->success($result);
	}
}
