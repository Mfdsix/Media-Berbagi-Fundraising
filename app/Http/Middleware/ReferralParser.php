<?php

namespace App\Http\Middleware;

use App\Models\Fundraiser;
use Closure;

class ReferralParser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->r) {
            $fundraiser = Fundraiser::where('referral_code', $request->r)
                ->first();
            if ($fundraiser) {
                $fundraiser->increment('clicks');
            }
        }
        return $next($request);
    }
}
