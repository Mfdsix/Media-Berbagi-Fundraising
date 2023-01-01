<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\User;

class ActivityController extends Controller
{
    public function index()
    {
        $popular = Activity::orderBy('id', 'DESC')
            ->get();

        return view('front.activity.index')->with([
            'popular' => $popular,
        ]);
    }

    public function detail($id)
    {
        $activity = Activity::findOrFail($id);
        $phone = User::where('level','admin')->first()->phone;

        return view('front.activity.detail')->with([
            'activity' => $activity,
            'phone' => $phone,
        ]);
    }
}
