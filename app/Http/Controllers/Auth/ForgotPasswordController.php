<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
     */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    public function viewForgot()
    {
        return view('auth.reset.email');
    }

    public function actForgot(Request $request)
    {
        $user = User::where('email', $request->email)
            ->first();

        if (!$user) {
            return back()->with([
                'error' => 'Email tidak terdaftar',
            ]);
        }
        $this->sendEmail($user);
        $this->setWeb();
        return redirect('/forgot-success')->with([
            'email' => $request->email,
            'web_set' => $this->setWeb(),
        ]);
    }

    public function sendEmail($user)
    {
        $token = Str::random(21);
        $check = PasswordReset::where('email', $user->email)
            ->first();

        if ($check) {
            $check->update([
                'token' => $token,
            ]);
        } else {
            PasswordReset::insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => now(),
            ]);
        }

        Mail::send('auth.reset.mail', ['user' => $user, 'token' => $token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject("Reset Password");
        });

        return true;
    }

    public function viewSuccess()
    {
        return view('auth.reset.success')->with([
            'web_set' => $this->setWeb(),
        ]);
    }

    public function viewReset(Request $request)
    {
        $token = PasswordReset::where('email', $request->e)
            ->where('token', $request->t)
            ->first();

        if (!$token) {
            return abort(404);
        }

        return view('auth.reset.reset')->with([
            'web_set' => $this->setWeb(),
        ]);
    }

    public function doReset(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)
            ->first();

        if (!$user) {
            return back()->with([
                'error' => 'Email Tidak Valid',
            ]);
        }
        $token = PasswordReset::where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$token) {
            return back()->with([
                'error' => 'Token Tidak Valid',
            ]);
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);
        $token->delete();

        return redirect('/login')->with([
            'success' => 'Password Berhasil Direset',
        ]);

    }
}
