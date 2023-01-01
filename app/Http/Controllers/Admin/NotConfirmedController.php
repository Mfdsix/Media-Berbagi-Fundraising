<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Funding;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\FundraiserTransaction;
use App\Models\Fundraiser;
use App\Models\InstantProgram;


class NotConfirmedController extends Controller
{
    const INSTANTS = [
        'sedekah' => 'Sedekah',
        'zakat' => 'Zakat',
        'wakaf' => 'Wakaf',
    ];

    public function payment_gateway()
    {
        $datas = Funding::where('status', 'pending')
        // where('created_at', 'LIKE', date('Y-m') . '%')
            ->where('payment_type', '!=', 'bank')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($datas as $key => $value) {
            if($value->project != null) {
                $value->project->title = $value->project->title;
            }else{
                $project = new Project();
                $project->id = 0;
                $project->type = $value->fund_type;
                $project->slug = "program-instant-".$value->fund_type;
                $project->title = "Program instant ".$value->fund_type;
                $project->percentage = 100;
                $project->button_label = $value->fund_type." sekarang";

                $value->project = $project;
            }
        }

        return view('admin.not_confirmed.payment_gateway')->with([
            'datas' => $datas,
        ]);
    }

    public function manual()
    {
        $datas = Funding::where(function ($q) {
            return $q->where('status', 'pending')
                ->orWhere('status', 'waiting');

        })
        // where('created_at', 'LIKE', date('Y-m') . '%')
            ->where('payment_type', 'bank')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($datas as $key => $value) {
            if($value->project != null) {
                $value->project->title = $value->project->title;
            }else{
                $project = new Project();
                $project->id = 0;
                $project->type = $value->fund_type;
                $project->slug = "program-instant-".$value->fund_type;
                $project->title = "Program instant ".$value->fund_type;
                $project->percentage = 100;
                $project->button_label = $value->fund_type." sekarang";

                $value->project = $project;
            }
        }

        return view('admin.not_confirmed.manual')->with([
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
            if(isset($this->paymentDetail[$data->payment_code])) {
                $bank = [
                    'name' => $data->payment_method,
                    'icon' => asset($this->paymentDetail[$data->payment_code][0]),
                ];
            }else{
                $bank = [
                    'name' => $data->payment_method,
                    'icon' => '',
                ];
            }
        }

        if ($data->project_id == 0) {
            $project_name = self::INSTANTS[$data->fund_type];
        } else {
            if ($data->project) {
                $project_name = $data->project->title;
            } else {
                $project_name = "-";
            }
        }
        $data->project_name = $project_name;

        return view('admin.not_confirmed.show')->with([
            'data' => $data,
            'bank' => $bank,
        ]);
    }

    public function verify($id, Request $request)
    {
        $data = Funding::findOrFail($id);
        //$project = Project::findOrFail($data->project_id);

        $data->update([
            'status' => 'paid',
        ]);

        $this->templateMessage([
            "type" => "thanks",
            "funding" => $data,
        ]);

        $ft = FundraiserTransaction::where("reference_id", $data->id)
        ->update(['status' => 'success']);

        if ($data->referral_id) {
            $referral = Fundraiser::where('user_id', $data->referral_id)
                ->first();
            if ($referral) {
                if($data->project != null){
                    $fee_reward = $data->project->fundraiser_reward != null ? ($data->project->fundraiser_reward / 100) : 0.01;
                }else{
                    $fee_reward = 0.01;
                    if($data->project_id == 0){
                        $fee_reward = 0.01;
                        $instant = InstantProgram::where('program', $data->fund_type)->first();
                        $fee_reward = $instant->commision / 100;
                    }
                }

                $commission = ($data->nominal * $fee_reward);
                
                // add commission
                // FundraiserTransaction::create([
                //     'type' => 'commission',
                //     'amount' => $commission,
                //     'status' => 'success',
                //     'fundraiser_id' => $referral->id,
                //     'reference_id' => $data->id,
                //     'user_id' => $referral->user_id,
                // ]);

                $referral->update([
                    'commissions' => $referral->commissions + $commission,
                    'collected' => $referral->collected + ($data->nominal),
                    'success_transaction' => $referral->success_transaction + 1,
                ]);
            }
        }

        // if($data->donature_email != null){
        //     Mail::to($data->donature_email)->send(new PaySucceed($data, $project));
        // }
        // if($data->donature_phone != null){
        //     $this->sendWa($data->donature_phone, 'Selamat, donasi anda sudah kami verifikasi.\n\n Silahkan klik link berikut untuk melihat donasi anda \n'.url('donation'));
        // }

        return redirect('admin/not_confirmed/payment_gateway')->with([
            'success' => 'Pembayaran Telah Diverifikasi',
        ]);
    }

    public function update($id, Request $request)
    {
        $data = Funding::findOrFail($id);

        $data->update([
            'nominal' => str_replace('.', '', $request->nominal),
            'total' => str_replace('.', '', $request->nominal),
            'unique_code' => 0,
            'additional_fee' => 0,
            'donature_name' => $request->donature_name,
        ]);

        return redirect('admin/not_confirmed/' . $id)->with([
            'success' => 'Pembayaran Telah Diupdate',
        ]);
    }

    public function destroy($id)
    {
        $data = Funding::findOrFail($id);
        $data->delete();

        return redirect('admin/not_confirmed/payment_gateway')->with([
            'success' => 'Pembayaran Telah Dihapus',
        ]);
    }

    public function export($type)
    {
        $funding = Funding::orderBy('status', 'ASC')
            ->when($type, function ($q) use ($type) {
                if ($type == 'manual') {
                    return $q->where('payment_type', 'bank');
                }
                return $q->where('payment_type', '!=', 'bank');
            })
            ->orderBy('created_at', 'DESC')
            ->get();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="transaksi_online_per_' . Date('dmYHis') . '.csv"');

        $data = [];
        $data[] = '#,Nama,Tgl Transaksi,Metode Pembayaran,Nominal,Status';

        foreach ($funding as $key => $value) {
            if ($value->status == "paid") {
                $value->status = "sukses";
            } elseif (($value->status == "pending" && $value->time_limit > now()) || $value->status == "canceled") {
                $value->status = "gagal";
            }
            $date = date('d M Y', strtotime($value->created_at));
            $index = $key + 1;
            $data[] = "$index,$value->donature_name,$date,$value->payment_method,$value->nominal,$value->status";
        }

        $fp = fopen('php://output', 'wb');
        foreach ($data as $key => $line) {
            $val = explode(",", $line);
            fputcsv($fp, $val);
        }
        fclose($fp);
    }
}
