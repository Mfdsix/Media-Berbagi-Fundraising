<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\PaymentController as PController;
use App\Models\Bank;
use App\Models\Funding;
use App\Models\Project;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Storage;

class PaymentController extends PController
{
    public function how_to_pay($id)
    {
        $transaction = Funding::where('id', $id)
            ->firstOrFail();

        // if ($transaction->user_id != null && ($transaction->user_id != Auth::user()->id)) {
        //     abort(404);
        // }

        // if ($transaction->status != 'pending') {
        //     return redirect('/donation/' . $id)->with([
        //         'warning' => 'Status Donasi Telah Berubah',
        //     ]);
        // }

        $limit = explode(' ', $transaction->time_limit);
        $nominal = $transaction->nominal + $transaction->unique_code;
        $front = substr($nominal, 0, strlen($nominal) - 3);
        $last = substr($nominal, strlen($nominal) - 3, 3);

        $transaction->time_limit = $this->date_to_idn($limit[0]) . ' ' . $limit[1];
        $transaction->nominal = $nominal;
        $transaction->nominal_formatted = str_replace(',', '.', number_format($front)) . '.<span class="text-warning">' . $last . '</span>';

        $payment = null;
        if ($transaction->payment_type == 'bank') {
            $payment = Bank::where('id', $transaction->payment_code)
                ->firstOrFail();

            $view = 'front.donate.how_to_pay';
        } else {
            $payment = $this->getTransactionDetail($transaction);
            if (!$payment) {
                abort(404);
            }

            $view = 'front.donate.how_to_tripay';
        }

        $projects = Project::limit(5);
        $today = Date('Y-m-d');
        foreach ($projects as $key => $value) {
            $donations = Funding::where('project_id', $value->id)->where('status', 'paid')
                ->selectRaw('SUM(nominal) as donation')
                ->pluck('donation')
                ->first();
            if ($value->date_target == null && $value->nominal_target == null) {
                $value->date_count = '∞';
                $value->date_target = '∞';
                $value->percentage = 100;
                $value->is_unlimited = true;
            } else {
                $value->date_count = date_diff(date_create($value->date_target), date_create($today))->days;
                $value->date_target = $this->date_to_idn($value->date_target);
                $value->percentage = $donations / $value->nominal_target * 100;
            }

            $value->donations = "Rp" . str_replace(',', '.', number_format($donations));
            if ($value->path_featured == null) {
                $value->path_featured = asset('images/project.jpg');
            } else {
                $value->path_featured = asset('storage/' . $value->path_featured);
            }
        }
        $phone = User::where('level', 'admin')->first()->phone;
        return view($view)->with([
            'transaction' => $transaction,
            'payment' => $payment,
            'unique_code' => $last,
            'projects' => $projects,
            'phone' => $phone,
        ]);
    }

    public function proof($id)
    {
        $transaction = Funding::where('id', $id)
            ->where('status', 'pending')
            ->firstOrFail();

        // if ($transaction->user_id != null && ($transaction->user_id != Auth::user()->id)) {
        //     abort(404);
        // }

        if (!in_array($transaction->status, ['pending', 'rejected'])) {
            return redirect('/donation/' . $id)->with([
                'warning' => 'Mohon Maaf, Status Donasi Telah Berubah',
            ]);
        }

        $limit = explode(' ', $transaction->time_limit);
        $transaction->nominal = str_replace(',', '.', number_format($transaction->nominal));
        $transaction->time_limit = $this->date_to_idn($limit[0]) . ' ' . $limit[1];

        if ($transaction->payment_type == 'bank') {
            $bankAccount = Bank::where('id', $transaction->payment_code)
                ->first();

            $bank = [
                'name' => $bankAccount->bank_name,
                'icon' => asset('storage/' . $bankAccount->path_icon),
            ];
        } else {
            $bank = [
                'name' => $transaction->payment_method,
                'icon' => asset($this->getIcon($transaction->payment_method)),
            ];
        }

        return view('front.donate.proof')->with([
            'data' => $transaction,
            'payment' => $bank,
        ]);
    }

    public function store_proof($id, Request $request)
    {
        $transaction = Funding::where('id', $id)
            ->firstOrFail();

        // if ($transaction->user_id != null && ($transaction->user_id != Auth::user()->id)) {
        //     abort(404);
        // }

        if (!in_array($transaction->status, ['pending', 'rejected'])) {
            return redirect('/donation/' . $id)->with([
                'warning' => 'Mohon Maaf, Status Donasi Telah Berubah',
            ]);
        }

        $request->validate([
            'file' => 'required|mimes:jpg,png,pdf,jpeg|max:2400',
        ]);

        if ($request->hasFile('file')) {
            if ($transaction->path_proof != null) {
                Storage::delete($transaction->path_proof);
            }

            $filename = $request->file('file')->store('uploads/payment_proof');
            $transaction->update([
                'path_proof' => $filename,
                'status' => 'waiting',
            ]);
        }

        return redirect('/donation/' . $id)->with([
            'success' => 'Bukti Pembayaran Berhasil Diunggah',
        ]);
    }
}
