<?php

namespace App\Http\Controllers\Fundraiser;

use App\Http\Controllers\Controller;
use App\Models\FundraiserTransaction;
use Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = FundraiserTransaction::where('user_id', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('fundraiser.transaction.index')->with([
            'datas' => $transactions,
        ]);
    }
}
