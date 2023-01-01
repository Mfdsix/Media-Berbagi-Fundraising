<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\Project;
use Auth;
use Illuminate\Http\Request;
use PDF;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "type" => "alpha"
        ]);

        $history = Funding::where('user_id', Auth::user()->id);

        if($request->type != "all" && $request->type != null) {
            if($request->type == "sedekah") {
                $history = $history->where(function ($q) {
                    $q->where('fund_type', 'sedekah')
                        ->orWhere('fund_type', 'donation');
                });
            }else{
                $history = $history->where("fund_type", $request->type);
            }
        }
        $history = $history->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('front.donation.index')->with([
            'history' => $history,
        ]);
    }

    public function faspay(Request $request)
    {
        $bill_no = $request->get('bill_no');
        $data = Funding::where('bill_no', $bill_no)
            ->firstOrFail();

        return view('front.thanks')->with([
            'data' => $data,
        ]);
    }

    public function show($id)
    {
        if(strpos($id,"INV-") > -1) {
            $id = (int)substr($id, 10,5);
        }

        $data = Funding::where('id', $id)
            ->firstOrFail();

        // if ($data->user_id != null && ($data->user_id != Auth::user()->id)) {
        //     abort(404);
        // }

        $project = Project::where('id', $data->project_id)->first();

        $date = explode(' ', $data->created_at)[0];
        $data->date = $this->date_to_idn($date) . ' ' . Date('H:i', strtotime($date[1]));
        $data->nominal = str_replace(',', '.', number_format($data->nominal));
        $data->transaction_id = (int) Date('Ymd') + $data->id;

        return view('front.donation.detail')->with([
            'data' => $data,
            'project' => $project,
        ]);
    }

    public function history()
    {
        $datas = Funding::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
        // ->paginate(10);
            ->get();

        foreach ($datas as $key => $value) {
            $value->nominal = str_replace(',', '.', number_format($value->nominal));
            $value->date = $value->created_at->format('d M Y');
        }
        return view('front.donation.history')->with([
            'datas' => $datas,
        ]);
    }

    public function detail()
    {
        return view('front.donation.detail');
    }

    public function all($id)
    {
        $datas = Funding::where('project_id', $id)
            ->where('status', 'paid')
            ->get();

        foreach ($datas as $key => $value) {
            $value->photo = $this->usernamify($value->donature_name);
            $value->nominal = str_replace(',', '.', number_format($value->nominal));
            if ($value->is_anonymous == 1) {
                $value->photo = "HA";
                $value->donature_name = 'Hamba Allah';
            }
        }

        return view('front.donation.all')->with([
            'datas' => $datas,
        ]);
    }

    public function certificate($id)
    {
        $data = Funding::where('id', $id)
            ->where('status', 'paid')
            ->firstOrFail();
        $project = Project::where('id', $data->project_id)
            ->first();

        $pdf = PDF::loadView('export.certificate', compact('data', 'project'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('sertifikat.pdf');
    }

    public function export()
    {
        $sedekah = Funding::where('user_id', Auth::user()->id)
            ->where('status', 'paid')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('export.donation')->with([
            'user' => Auth::user(),
            'datas' => $sedekah,
        ]);
    }
}
