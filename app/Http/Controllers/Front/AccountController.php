<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Fundraiser;
use Auth;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {

                if (Auth::user()->level == 'admin') {
                    return redirect('/admin');
                } elseif (Auth::user()->level == 'fundraiser') {
                    return redirect('/fundraiser');
                }

            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $user = null;

        if (Auth::check()) {
            $user = Auth::user();
        }
        if($request->resend != null) {
            $user->sendEmailVerificationNotification();
            return redirect('/my-account')->with('success', 'Verification email has been sent.');
        }
        return view('front.profile.index')->with([
            'user' => $user,
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('front.profile.edit')->with([
            'user' => $user,
        ]);
    }

    public function intro()
    {
        $user = Auth::user();
        $fundraiser = null;

        if ($user->is_fundraiser == 1) {
            $fundraiser = Fundraiser::where('user_id', $user->id)->first();
            if ($fundraiser) {
                $fundraiser->funnel = ($fundraiser->success_transaction > 0 && $fundraiser->transaction > 0) ? ceil($fundraiser->success_transaction / $fundraiser->transaction * 100) : 0;
            }
        }

        return view('front.profile.intro')->with([
            'user' => $user,
            'fundraiser' => $fundraiser,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if($request->email != $user->email) {
            $request->validate([
                'name' => 'required|min:5|string',
                'foto' => 'nullable|max:500|mimes:jpeg,jpg,png',
                'email' => 'required|email|unique:users',
            ]);
        }else{
            $request->validate([
                'name' => 'required|min:5|string',
                'foto' => 'nullable|max:500|mimes:jpeg,jpg,png',
            ]);
        }

        $filename = $user->path_foto;

        if ($request->hasFile('foto')) {
            if ($user->path_foto != null) {
                Storage::delete($user->path_foto);
            }
            $filename = $request->file('foto')->store('uploads/donaturs');
        }

        // if password null
        if ($request->password == null) {
            $user->update([
                'name' => $request->name,
                'path_foto' => $filename,
                'email' => $request->email,
            ]);
        } else {
            // check if passworld lama match with current password
            if (Hash::check($request->password_lama, $user->password)) {
                $user->update([
                    'name' => $request->name,
                    'path_foto' => $filename,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            } else {
                return redirect()->back()->with('error', 'Password lama tidak sesuai');
            }
        }

        return redirect('my-account/edit')->with([
            'success' => 'Akun Berhasil Diperbarui',
        ]);
    }
}
