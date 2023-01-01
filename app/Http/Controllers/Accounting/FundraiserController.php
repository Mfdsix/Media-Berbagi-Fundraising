<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\FundraiserTransaction;

class FundraiserController extends Controller
{
    public function withdrawal()
    {
        $withdrawals = FundraiserTransaction::where('type', 'withdraw')
            ->where('status', 'pending')
            ->orderBy('id', 'DESC')
            ->paginate(25);

        return view('accounting.fundraiser.withdrawal')->with([
            'datas' => $withdrawals,
        ]);
    }
}
