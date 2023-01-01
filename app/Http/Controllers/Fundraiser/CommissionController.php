<?php

namespace App\Http\Controllers\Fundraiser;

use App\Http\Controllers\Controller;
use App\Models\FundraiserTransaction;
use Auth;
use App\Models\InstantProgram;

class CommissionController extends Controller
{
    public function index()
    {
        $fundraiser = Auth::user()->fundraiser;
        $transactions = FundraiserTransaction::where('user_id', Auth::user()->id)
            ->where('type', 'commission')
            ->where('status', 'success')
            ->orderBy('id', 'DESC')
            ->get();

        $total = 0;

        foreach ($transactions as $k => $v) {
            $v->donature_name = $v->donation ? $v->donation->donature_name : '-';
            $v->nominal = $v->donation ? $v->donation->nominal : '-';
            if($v->donation->project == null) {
                $instant = InstantProgram::where('program', $v->donation->fund_type)->first();
                $v->fee = $instant->commision;
            }else{
                $v->fee = $v->donation ? ($v->donation->project->fundraiser_reward ?? '1') : '-';
            }
            $total += $v->amount;
        }

        return view('fundraiser.commission.index')->with([
            'total' => $total,
            'datas' => $transactions,
            'fundraiser' => $fundraiser,
        ]);
    }
}
