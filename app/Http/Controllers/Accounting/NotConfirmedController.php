<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Funding;
use App\Models\Project;
use Illuminate\Http\Request;

class NotConfirmedController extends Controller
{
    public function payment_gateway()
    {
        $datas = Funding::where('status', 'waiting')
            ->whereIn('payment_type', ['instant', 'ewallet'])
            ->orderBy('created_at', 'DESC')
            ->paginate(25);

        return view('accounting.not_confirmed.payment_gateway')->with([
            'datas' => $datas,
        ]);
    }

    public function manual()
    {
        $datas = Funding::where('status', 'waiting')
            ->orWhere('status', 'pending')
            ->where('payment_type', 'bank')
            ->orderBy('created_at', 'DESC')
            ->paginate(25);

        return view('accounting.not_confirmed.manual')->with([
            'datas' => $datas,
        ]);
    }

    public function show($id)
    {
        $data = Funding::findOrFail($id);
        if ($data->payment_type == 'bank') {
            $bankAccount = Bank::where('id', $data->payment_code)
                ->firstOrFail();

            $bank = [
                'name' => $bankAccount->bank_name,
                'icon' => asset('storage/' . $bankAccount->path_icon),
            ];
        } else {
            $bank = [
                'name' => $data->payment_method,
                'icon' => asset($this->paymentDetail[$data->payment_code]),
            ];
        }

        return view('accounting.not_confirmed.show')->with([
            'data' => $data,
            'bank' => $bank,
        ]);
    }

    public function verify($id, Request $request)
    {
        $data = Funding::findOrFail($id);
        $project = Project::findOrFail($data->project_id);

        $data->update([
            'status' => 'paid',
        ]);

        // if($data->donature_email != null){
        //     Mail::to($data->donature_email)->send(new PaySucceed($data, $project));
        // }
        // if($data->donature_phone != null){
        //     $this->sendWa($data->donature_phone, 'Selamat, donasi anda sudah kami verifikasi.\n\n Silahkan klik link berikut untuk melihat donasi anda \n'.url('donation'));
        // }

        return redirect('accounting/not_confirmed/payment_gateway')->with([
            'success' => 'Pembayaran Telah Diverifikasi',
        ]);
    }

    public function update($id, Request $request)
    {
        $data = Funding::findOrFail($id);
        $project = Project::findOrFail($data->project_id);

        $data->update([
            'nominal' => str_replace('.', '', $request->nominal),
            'total' => str_replace('.', '', $request->nominal),
            'unique_code' => 0,
            'additional_fee' => 0,
            'donature_name' => $request->donature_name,
        ]);

        return redirect('accounting/not_confirmed/' . $id)->with([
            'success' => 'Pembayaran Telah Diupdate',
        ]);
    }

    public function destroy($id)
    {
        $data = Funding::findOrFail($id);
        $data->delete();

        return redirect('accounting/not_confirmed/payment_gateway')->with([
            'success' => 'Pembayaran Telah Dihapus',
        ]);
    }
}
