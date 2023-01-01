<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        if (request()->has('url')) {
            return request()->url;
        }

        $user = Auth::user();
        if ($user->level == 'admin') {
            return '/admin';
        } elseif ($user->level == 'accounting') {
            return '/accounting';
        } elseif ($user->level == 'program') {
            return '/dashboard-program';
        } elseif ($user->level == 'gerai') {
            return '/gerai';
        } else {
            return '/';
        }
    }

    public function authenticated($request, $user)
    {
        if ($user->level == 'admin') {
            return redirect('/admin');
        } elseif ($user->level == 'accounting') {
            return redirect('/accounting');
        } elseif ($user->level == 'program') {
            return redirect('/dashboard-program');
        } elseif ($user->level == 'gerai') {
            return redirect('/gerai');
        } elseif ($user->level == 'fundraiser') {
            return redirect('/fundraiser');
        }
    }
}
