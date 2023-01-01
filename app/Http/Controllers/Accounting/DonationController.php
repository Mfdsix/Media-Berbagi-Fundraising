<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Funding;
use App\Models\Project;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $params = [
            ['Sedekah', 'sedekah'],
            ['Wakaf', 'wakaf'],
            ['Zakat', 'zakat'],
        ];
        $instant = [];

        foreach ($params as $k => $v) {
            array_push($instant, [
                'title' => $v[0],
                'donations' => Funding::where('project_id', 0)
                    ->where('fund_type', $v[1])
                    ->where('status', 'paid')
                    ->sum('nominal'),
            ]);
        }

        $datas = Project::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        foreach ($datas as $key => $value) {
            $value->date_target = 'Tidak Terbatas';
            $value->donations = $value->countDonation();
            $value->percentage = 100;
        }

        return view('accounting.donation.index')->with([
            'instant' => $instant,
            'datas' => $datas,
        ]);
    }

    public function detail($id)
    {
        $project = Project::where('id', $id)
            ->firstOrFail();
        $fundings = Funding::where('project_id', $id)
            ->where('status', 'paid')
            ->get();
        $fundraiser = count($project->getFundraisers());

        $donatur = 0;
        $collected = 0;
        $manual = 0;
        $automated = 0;
        $fee = 0;

        foreach ($fundings as $k => $v) {
            if ($v->status == "paid") {
                $collected += $v->nominal;
                if ($v->is_admin == 1) {
                    $manual += $v->nominal;
                } else {
                    $automated += $v->nominal;
                }
                $donatur++;
                $fee += $v->additional_fee;
            }
        }

        $operational_percentage = 0;
        $operational_nominal = 0;
        $distribution_percentage = 100;
        $distribution_nominal = $collected;

        if ($project->operational_percentage > 0) {
            $operational_percentage = $project->operational_percentage;
            $operational_nominal = ($project->operational_percentage / 100) * $collected;
            $distribution_percentage = 100 - $operational_percentage;
            $distribution_nominal = $collected - $operational_nominal;
        }

        return view('accounting.donation.detail')->with([
            'project' => $project,
            'donations' => [
                'donatur' => $donatur,
                'fundraiser' => $fundraiser,
                'collected' => $collected,
                'manual' => $manual,
                'automated' => $automated,
                'fee' => $fee,
            ],
            'divided' => [
                'operational_percentage' => $operational_percentage,
                'operational_nominal' => $operational_nominal,
                'distribution_percentage' => $distribution_percentage,
                'distribution_nominal' => $distribution_nominal,
            ],
        ]);
    }

    public function all()
    {
        $date = date("Y-m");
        $donation = Funding::where('created_at', 'LIKE', $date . "%")
            ->orderBy('id', 'DESC')
            ->paginate(25);
        return view('accounting.donation.all')->with([
            'datas' => $donation,
        ]);
    }

    public function show($id)
    {
        $data = Funding::leftJoin('projects as p', 'p.id', 'fundings.project_id')
            ->select('fundings.*', 'p.title', 'p.status as project_status')
            ->where('fundings.id', $id)
            ->firstOrFail();
        $bank = Bank::where('id', $data->payment_method)
            ->first();

        return view('accounting.donation.show')->with([
            'data' => $data,
            'bank' => $bank,
        ]);
    }

    public function update($id, Request $request)
    {
        $data = Funding::findOrFail($id);
        $project = Project::findOrFail($data->project_id);

        $data->update([
            'nominal' => str_replace('.', '', $request->nominal),
            'donature_name' => $request->donature_name,
        ]);

        return redirect('accounting/all_donation/' . $id)->with([
            'success' => 'Pembayaran Telah Diupdate',
        ]);
    }

    public function destroy($id)
    {
        $data = Funding::findOrFail($id);
        $data->delete();

        return redirect('accounting/all_donation')->with([
            'success' => 'Pembayaran Telah Dihapus',
        ]);
    }
}
