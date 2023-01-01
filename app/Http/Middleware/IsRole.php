<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if ($role == 'fundraiser') {
            if (Auth::user()->is_fundraiser) {
                return $next($request);
            }
        }
        if (Auth::user()->level == $role) {
            return $next($request);
        } else {
            abort(404);
        }
    }
}
