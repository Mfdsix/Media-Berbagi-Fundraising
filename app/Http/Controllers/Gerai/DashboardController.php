<?php

namespace App\Http\Controllers\Gerai;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $donatur = Funding::where('inputer_id', Auth::user()->id)
            ->count();
        $transaction = Funding::where('inputer_id', Auth::user()->id)
            ->sum('nominal');
        return view('gerai.dashboard')->with([
            'transaction' => $transaction,
            'donatur' => $donatur,
        ]);
    }
}
