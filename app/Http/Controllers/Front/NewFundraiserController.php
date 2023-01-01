<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Referral;
use Auth;
use Illuminate\Http\Request;

class NewFundraiserController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $redirect = str_replace(request()->getSchemeAndHttpHost(), "", request()->fullUrl());
            if (!Auth::check()) {
                return redirect('/login?t=' . base64_encode($redirect))->with([
                    'warning' => 'Silahkan login terlebih dahulu',
                ]);
            } else {
                if (Auth::user()->level != 'user') {
                    return abort(404);
                }
            }

            return $next($request);
        });
    }

    public function form(Request $request)
    {
        $projectSlug = base64_decode($request->p);
        if (!$projectSlug) {
            return abort(404);
        }

        $project = Project::where('slug', $projectSlug)
            ->firstOrFail();

        return view('front.new_fundraiser.form')->with([
            'project' => $project,
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'project_slug' => 'required',
            'title' => 'required',
            'target' => 'required|integer|min:10000',
            'slug' => 'required|unique:referrals|unique:projects',
        ]);

        $project = Project::where('slug', $request->project_slug)
            ->firstOrFail();

        $user = Auth::user();
        $create = Referral::create([
            'user_id' => $user->id,
            'donature_id' => $user->donature ? $user->donature->id : null,
            'project_id' => $project->id,
            'title' => $request->title,
            'target' => $request->target,
            'slug' => $request->slug,
        ]);

        return redirect($request->slug)->with([
            'success' => 'Berhasil Menjadi Fundraiser',
        ]);
    }
}
