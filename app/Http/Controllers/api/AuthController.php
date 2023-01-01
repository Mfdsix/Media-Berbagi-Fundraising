<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use JWTAuth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
	public function register(Request $request)
	{
		$validate = Validator::make($request->all(), [
			'name' => 'required|min:3|unique:users',
			'email' => 'required',
			'password' => 'required|min:6',
		]);

		if($validate->fails()){
			return $this->error(implode(', ', $validate->messages()->all()), 422);
		}
		$type = 'email';
		if(strpos('@', $request->email) == false){
			$request->merge([
				'phone' => $request->email,
			]);
		}

		$user = User::where('email', $request->email)
		->where('phone', $request->email)
		->first();

		if($user){
			return $this->error([
				'message' => 'Email atau Nomor Telepon sudah digunakan'
			]);
		}

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
			'phone' => $request->phone,
			'level' => 'user'
		]);

		return $this->success($user);
	}

	public function login(Request $request)
	{
		$validate = Validator::make($request->all(), [
			'name' => 'required',
			'password' => 'required',
		]);

		if($validate->fails()){
			return $this->error(implode(', ', $validate->messages()->all()), 422);
		}

		if(Auth::attempt(['name' => $request->name, 'password' => $request->password])){
			$user = Auth::user();
			$user->token = JWTAuth::fromUser($user);
			return $this->success($user);
		}else{
			if(Auth::attempt(['email' => $request->name, 'password' => $request->password])){
				$user = Auth::user();
				$user->token = JWTAuth::fromUser($user);
				return $this->success($user);
			}
		}

		return $this->error('Username atau Password Salah');
	}

	public function token(Request $request)
	{
		$validate = Validator::make($request->all(), [
			'credential' => 'required',
		]);

		if($validate->fails()){
			return $this->error(implode(', ', $validate->messages()->all()), 422);
		}

		$user = User::where('name', $request->credential)
		->orWhere('email', $request->credential)
		->first();

		if($user){
			$token = JWTAuth::fromUser($user);
			return $this->success($token);
		}

		return $this->error('User Tidak Ditemukan');
	}

	public function changePassword(Request $request) {
        $validator = FacadesValidator::make($request->all(), [
            'old_password' => 'required|max:255',
            'password' => 'required|max:255|confirmed',
        ]);

        if ($validator->fails()) {
			return $this->error(implode(', ', $validator->messages()->all()), 422);
        }

        $user = User::find(auth()->user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);

            return $this->success($user);
        } else {
            return $this->error('Password lama anda tidak tepat.');
        }
	}
}
