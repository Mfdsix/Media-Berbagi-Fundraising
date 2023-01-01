<?php

namespace App\Http\Controllers\Gerai;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('gerai.profile')->with([
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $data = Auth::user();

        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|min:8',
        ];

        if ($request->email != $data->email) {
            $rules['email'] .= '|unique:users';
        }
        $request->validate($rules);
        $post = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->has('password') && $request->password != "") {
            $post['password'] = bcrypt($request->password);
        }
        $data->update($post);

        return redirect('gerai/profile')->with([
            'success' => 'Profil Berhasil Diedit',
        ]);
    }
}
