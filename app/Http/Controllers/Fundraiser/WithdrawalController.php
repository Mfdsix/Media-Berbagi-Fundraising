<?php

namespace App\Http\Controllers\Fundraiser;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\FundraiserTransaction;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    public function index()
    {
        $fundraiser = Auth::user()->fundraiser;
        $withdraw = FundraiserTransaction::where('user_id', Auth::user()->id)
            ->where('type', 'withdraw')
            ->orderBy('id', 'DESC')
            ->paginate(25);

        return view('fundraiser.withdrawal.index')->with([
            'fundraiser' => $fundraiser,
            'histories' => $withdraw,
        ]);
    }

    public function store(Request $request)
    {
        $fundraiser = Auth::user()->fundraiser;
        $limit = $fundraiser->commissions;

        $request->validate([
            'nominal' => 'required|integer|max:' . $limit,
            // 'type' => 'required|in:withdraw,donate',
        ]);

        if($fundraiser->bank_account_name == null || $fundraiser->bank_account_number == null || $fundraiser->bank_account_code == null) {
            return redirect()->back()->with('error', 'Silahkan lengkapi data rekening anda terlebih dahulu');
        }

        try {
            DB::transaction(function () use ($request) {
                $fundraiser = Auth::user()->fundraiser;

                FundraiserTransaction::create([
                    'type' => 'withdraw',
                    'amount' => $request->nominal,
                    'status' => 'pending',
                    'fundraiser_id' => Auth::user()->fundraiser->id,
                    'user_id' => Auth::user()->id,
                ]);

                $fundraiser->update([
                    'commissions' => $fundraiser->commissions - $request->nominal,
                ]);

                DB::commit();
            });
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()->back()->with('success', 'Berhasil melakukan pencairan');
    }
    public function store_old(Request $request)
    {
        $limit = Auth::user()->fundraiser->commissions;

        $request->validate([
            'nominal' => 'required|integer|max:' . $limit,
            // 'type' => 'required|in:withdraw,donate',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $fundraiser = Auth::user()->fundraiser;
                if ($request->type == 'withdraw') {
                    FundraiserTransaction::create([
                        'type' => 'withdraw',
                        'amount' => $request->nominal,
                        'status' => 'pending',
                        'fundraiser_id' => Auth::user()->fundraiser->id,
                        'user_id' => Auth::user()->id,
                    ]);
                } else {

                    $funding = Funding::create([
                        'project_id' => 0,
                        'user_id' => Auth::user()->id,
                        'nominal' => $request->nominal,
                        'total' => $request->nominal,
                        'payment_type' => 'platform',
                        'payment_method' => 'Komisi Fundraiser',
                        'status' => 'paid',
                        'donature_name' => $fundraiser->fullname,
                        'donature_email' => $fundraiser->email,
                        'donature_phone' => $fundraiser->phone,
                        'fund_type' => 'sedekah',
                        'time_limit' => now(),
                    ]);
                    $transaction = FundraiserTransaction::create([
                        'type' => 'donation',
                        'amount' => $request->nominal,
                        'status' => 'success',
                        'fundraiser_id' => Auth::user()->fundraiser->id,
                        'user_id' => Auth::user()->id,
                        'reference_id' => $funding->id,
                    ]);
                }

                $fundraiser->update([
                    'commissions' => $fundraiser->commissions - $request->nominal,
                ]);

                DB::commit();
            });
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect("/fundraiser/withdrawal");
    }
    // bank
    public function bank()
    {
        $fundraiser = Auth::user()->fundraiser;

        return view('fundraiser.withdrawal.bank')->with([
            'data' => $fundraiser,
        ]);
    }
    // bank save
    public function bank_save(Request $request)
    {
        $request->validate([
            'bank_account_name' => 'required',
            'bank_account_number' => 'required',
            'bank_account_code' => 'required',
        ]);

        $fundraiser = Auth::user()->fundraiser;
        $fundraiser->update([
            'bank_account_name' => $request->bank_account_name,
            'bank_account_number' => $request->bank_account_number,
            'bank_account_code' => $request->bank_account_code,
        ]);

        return redirect()->back();
    }
}
