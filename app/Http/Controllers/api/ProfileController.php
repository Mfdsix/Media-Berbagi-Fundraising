<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Funding;
use Auth;
use Validator;
use Storage;

class ProfileController extends Controller
{
	public function show()
	{
		$user = User::where('id', Auth::user()->id)->first();
		return $this->success($user);
	}

	public function update(Request $request)
	{
		$user = Auth::user();
		$rules = [];

		if($request->has('name')){
			$rules['name'] = 'required|min:5';
		}
		if($request->has('phone')){
			$rules['phone'] = 'required|min:9';
			if($user->phone != $request->phone){
				$rules['phone'] .= "|unique:users";
			}
		}
		if($request->has('email')){
			$rules['email'] = 'required|email';
			if($user->email != $request->email){
				$rules['email'] .= "|unique:users";
			}
		}

		$validate = Validator::make($request->all(), $rules);
		if($validate->fails()){
			return $this->error(implode(', ', $validate->messages()->all()), 422);
		}

		$user->update($request->all());
		return $this->success("Profil Berhasil Diperbarui");
	}

	public function password(Request $request)
	{
		$validate = Validator::make($request->all(), [
			'old_password' => 'required',
			'new_password' => 'required|min:6'
		]);
		if($validate->fails()){
			return $this->error(implode(', ', $validate->messages()->all()), 422);
		}

		$user = User::where('id', Auth::user()->id)
		->first();

		if(!$user){
			return $this->error("User Tidak Ditemukan");
		}

		if($request->old_password == $request->new_password){
			return $this->error("Password Tidak Boleh Sama");	
		}

		if(Hash::check($request->old_password, $user->password)){
			$user->update([
				'password' => bcrypt($request->new_password)
			]);
			return $this->success("Password Berhasil Diubah");
		}else{
			return $this->error("Password salah");	
		}
	}

	public function donation()
	{
		$donation = Funding::where('user_id', Auth::user()->id)
		->where('status', 'paid')
		->selectRaw("COUNT('id') as donations, SUM('nominal') as amount")
		->first();

		return $this->success([
			'donations' => $donation->donations ?? 0,
			'amount' => $donation->amount ?? 0,
		]);
	}

	public function photo(Request $request)
	{
		$validate = Validator::make($request->all(), [
			'photo' => 'required|max:2000',
		]);
		if($validate->fails()){
			return $this->error(implode(', ', $validate->messages()->all()), 422);
		}

		if(!in_array($request->photo->extension(), ['png','jpg','jpeg'])){
			return $this->error('Format File Tidak Diperbolehkan');
		}

		$user = User::where('id', Auth::user()->id)
		->first();

		if(!$user){
			return $this->error("User Tidak Ditemukan");
		}

		$filename = $user->path_foto;
		if($request->hasFile('photo')){
			if($user->path_foto != null){
				if(Storage::exists($user->photo)){
					Storage::delete($user->path_foto);
				}
			}
			$filename = $request->file('photo')->store('uploads/users');
		}

		$user->update([
			'path_foto' => $filename
		]);

		return $this->success([
			'filename' => asset('storage/'.$filename)
		]);
	}
}
