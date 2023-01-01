<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ProfileController extends Controller
{
	public function index(){
		$data = Auth::user();
		return view('admin.profile')->with([
			'data' => $data
		]);
	}

	public function store(Request $request){
		$data = Auth::user();

		$rules = [
			'name' => 'required|string',
			'email' => 'required|email',
			'phone' => 'nullable|numeric',
			'password' => 'nullable|min:8',
		];

		if($request->email != $data->email){
			$rules['email'] .= '|unique:users';
		}
		$request->validate($rules);
		$post = [
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
		];
		
		if($request->has('password') && $request->password != ""){
			$post['password'] = bcrypt($request->password);
		}
		$data->update($post);

		return redirect('admin/profile')->with([
			'success' => 'Profil Berhasil Diedit'
		]);
	}
}
