<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\User;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
	public function doForgot(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required',
		]);

		if($validator->fails()){
			return $this->error(implode(', ', $validator->messages()->all()), 422);
		}

		$user = User::where('email', $request->email)
		->first();

		if(!$user){
			return $this->error("Email tidak terdaftar");
		}
		$this->sendEmail($user);
		return $this->success("success");
	}

	public function sendEmail($user)
	{
		$token = Str::random(21);
		$check = PasswordReset::where('email', $user->email)
		->first();

		if($check){
			$check->update([
				'token' => $token,
			]);
		}else{
			PasswordReset::insert([
				'email' => $user->email,
				'token' => $token,
				'created_at' => now()
			]);
		}

		Mail::send('auth.reset.mail', ['user' => $user, 'token' => $token], function ($message) use ($user){
			$message->to($user->email);
			$message->subject("Reset Password");
		});

		return true;
	}
}
