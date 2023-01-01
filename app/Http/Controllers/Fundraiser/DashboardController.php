<?php

namespace App\Http\Controllers\Fundraiser;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\FundraiserTransaction;
use App\Models\Funding;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $fundraiser = $user->fundraiser;
        $funding = FundraiserTransaction::where('user_id', $user->id)
        ->where('status', 'success')
        ->get();
        $offline=0;
        $online=0;
        
        foreach($funding as $fund) {
            if($fund->donation != null) {
                if($fund->donation->payment_method == "Admin" || $fund->donation->payment_method == "Gerai") {
                    $offline += $fund->donation->nominal;
                }else{
                    $online += $fund->donation->nominal;
                }
            }
        }

        return view('fundraiser.dashboard')->with([
            'fundraiser' => $fundraiser,
            'online' => $online,
            'offline' => $offline,
        ]);
    }
}
