<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($type = null)
    {
        $id = Auth::user()->id;
        $users = User::when(true, function ($q) use ($type) {
            if (in_array($type, ['accounting', 'admin', 'user', 'gerai', 'program'])) {
                return $q->where('level', $type);
            }
            if ($type == 'fundraiser') {
                return $q->where('level', 'user')
                    ->where('is_fundraiser', 1);
            }

            return $q->where('level', 'admin');
        })
        ->where('id', '!=', $id)
        ->get();

        return view('admin.user.index')->with([
            'datas' => $users,
            'type' => $type ?? 'admin',
        ]);
    }

    public function create()
    {
        return view('admin.user.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'level' => 'required|in:admin,accounting,gerai,program',
        ]);

        $request->merge([
            'password' => bcrypt($request->password),
        ]);

        User::create($request->all());
        return redirect('/admin/user/' . $request->level);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.form')->with([
            'data' => $user,
        ]);
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8',
        ]);

        if ($request->name != $user->name) {
            $request->validate([
                'name' => 'unique:users',
            ]);
        }
        if ($request->email != $user->email) {
            $request->validate([
                'email' => 'unique:users',
            ]);
        }

        $update = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password != null) {
            $update['password'] = bcrypt($request->password);
        }

        $user->update($update);
        return redirect('/admin/user/' . $user->level);
    }
    // destroy
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back();
    }
}
