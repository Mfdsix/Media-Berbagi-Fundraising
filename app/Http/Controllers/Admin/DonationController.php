<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Funding;
use App\Models\Fundraiser;
use App\Models\Project;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    const INSTANTS = [
        'sedekah' => 'Sedekah',
        'zakat' => 'Zakat',
        'wakaf' => 'Wakaf',
    ];

    public function index(Request $request)
    {
        $params = [
            ['Sedekah', 'sedekah'],
            ['Wakaf', 'wakaf'],
            ['Zakat', 'zakat'],
        ];
        $instant = [];

        foreach ($params as $k => $v) {
            array_push($instant, [
                'key' => $v[1],
                'title' => $v[0],
                'donations' => Funding::where('project_id', 0)
                    ->where('fund_type', $v[1])
                    ->where('status', 'paid')
                    ->sum('nominal'),
                'donatur' => Funding::where('project_id', 0)
                    ->where('fund_type', $v[1])
                    ->where('status', 'paid')
                    ->count(),
            ]);
        }

        $datas = Project::where('status', 1)
            ->when($request->q, function ($q) use ($request) {
                return $q->where('title', 'LIKE', '%' . $request->q . '%');
            })
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        foreach ($datas as $key => $value) {
            $value->date_target = '∞';
            $value->donations = $value->countDonation();
            $value->percentage = 100;
            $value->donatur = $value->countPeopleDonation();
        }

        return view('admin.donation.index')->with([
            'datas' => $datas,
            'instant' => $instant,
        ]);
    }

    public function detail($id, $option = null)
    {
        $project = Project::where('id', $id)
            ->firstOrFail();
        $fundings = Funding::where('project_id', $id)
            ->where('status', 'paid')
            ->paginate(25);

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
        $media_berbagi_percentage = 1;
        $media_berbagi_nominal = 0;

        $withdrawed = $project->withdrawal();
        $withdrawed_instance = $project->withdrawal('instance_right');
        $withdrawed_mediaberbagi = $project->withdrawal('mediaberbagi_right');
        $remain = $collected - ($withdrawed + $withdrawed_instance + $withdrawed_mediaberbagi);

        $operational_percentage = $project->operational_percentage ?? 0;
        $operational_nominal = ($project->operational_percentage / 100) * $collected;
        $distribution_percentage -= ($operational_percentage + $media_berbagi_percentage);
        $media_berbagi_nominal = $media_berbagi_percentage / 100 * $collected;
        $distribution_nominal = $collected - $operational_nominal - $media_berbagi_nominal;

        return view($option == 'export' ? 'export.project' : 'admin.donation.detail')->with([
            'fundings' => $fundings,
            'project' => $project,
            'donations' => [
                'donatur' => $donatur,
                'fundraiser' => $fundraiser,
                'collected' => $collected,
                'manual' => $manual,
                'automated' => $automated,
                'fee' => $fee,
                'withdrawed' => $withdrawed,
                'withdrawed_instance' => $withdrawed_instance,
                'withdrawed_mediaberbagi' => $withdrawed_mediaberbagi,
                'remain' => $remain,
            ],
            'divided' => [
                'operational_percentage' => $operational_percentage,
                'operational_nominal' => $operational_nominal,
                'distribution_percentage' => $distribution_percentage,
                'distribution_nominal' => $distribution_nominal,
                'media_berbagi_percentage' => $media_berbagi_percentage,
                'media_berbagi_nominal' => $media_berbagi_nominal,
            ],
        ]);
    }

    public function instant($type, $option = null)
    {
        $titles = [
            'sedekah' => 'Sedekah',
            'zakat' => 'Zakat',
            'wakaf' => 'Wakaf',
        ];
        $project = new Project();
        $project->id = 0;
        $project->type = $type;
        $project->title = "Program instant ".$type;
        $project->percentage = 100;
        $project->slug = url('program-instant-'.$type);
        $project->category = (object) [
            'category' => 'Program Tidak Terikat'
        ];
        $project->button_label = $type." sekarang";

        // $project = (object) [
        //     'title' => $titles[$type],
        //     'path_featured' => null,
        //     'slug' => null,
        //     'category' => (object) [
        //         'category' => 'Program Tidak Terikat',
        //     ],
        // ];
        $fundings = Funding::where('project_id', 0)
            ->where('status', 'paid')
            ->where('fund_type', $type)
            ->get();
        $fundraisersId = Funding::where('project_id', 0)
            ->where('status', 'paid')
            ->where('fund_type', $type)
            ->pluck('referral_id');

        $fundraiser = Fundraiser::whereIn('user_id', $fundraisersId)
            ->count();

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
        $media_berbagi_percentage = 1;
        $media_berbagi_nominal = 0;

        $withdrawed = Withdrawal::where('project_id', 0)
            ->where('project_type', $type)
            ->where('withdrawal_type', 'distribution')
            ->sum('nominal');
        $withdrawed_instance = Withdrawal::where('project_id', 0)
            ->where('project_type', $type)
            ->where('withdrawal_type', 'instance_right')
            ->sum('nominal');
        $withdrawed_mediaberbagi = Withdrawal::where('project_id', 0)
            ->where('project_type', $type)
            ->where('withdrawal_type', 'mediaberbagi_right')
            ->sum('nominal');
        $remain = $collected - ($withdrawed + $withdrawed_instance + $withdrawed_mediaberbagi);

        $operational_nominal = ($operational_percentage / 100) * $collected;
        $distribution_percentage -= ($operational_percentage + $media_berbagi_percentage);
        $media_berbagi_nominal = $media_berbagi_percentage / 100 * $collected;
        $distribution_nominal = $collected - $operational_nominal - $media_berbagi_nominal;

        return view($option == 'export' ? 'export.project' : 'admin.donation.detail')->with([
            'fundings' => $fundings,
            'project' => $project,
            'donations' => [
                'donatur' => $donatur,
                'fundraiser' => $fundraiser,
                'collected' => $collected,
                'manual' => $manual,
                'automated' => $automated,
                'fee' => $fee,
                'withdrawed' => $withdrawed,
                'withdrawed_instance' => $withdrawed_instance,
                'withdrawed_mediaberbagi' => $withdrawed_mediaberbagi,
                'remain' => $remain,
            ],
            'divided' => [
                'operational_percentage' => $operational_percentage,
                'operational_nominal' => $operational_nominal,
                'distribution_percentage' => $distribution_percentage,
                'distribution_nominal' => $distribution_nominal,
                'media_berbagi_percentage' => $media_berbagi_percentage,
                'media_berbagi_nominal' => $media_berbagi_nominal,
            ],
        ]);
    }

    public function all(Request $request)
    {
        $donation = Funding::when($request->q, function ($q) use ($request) {
            return $q->where('donature_name', 'LIKE', '%' . $request->q . '%');
        })
        // where('created_at', 'LIKE', date('Y-m') . '%')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($donation as $key => $value) {
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

        return view('admin.donation.all')->with([
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

        if($data->project != null) {
            $project_name = $data->project->title;
        }else{
            $project_name ="Program instant ".$data->fund_type;
        }


        $data->title = $project_name;

        return view('admin.donation.show')->with([
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

        return redirect('admin/all_donation/' . $id)->with([
            'success' => 'Pembayaran Telah Diupdate',
        ]);
    }

    public function destroy($id)
    {
        $data = Funding::findOrFail($id);
        $data->delete();

        return redirect('admin/all_donation')->with([
            'success' => 'Pembayaran Telah Dihapus',
        ]);
    }

    public function export()
    {
        $funding = Funding::orderBy('status', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->get();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="data_donasi_per_' . Date('dmYHis') . '.xls"');

        $data = [];
        $data[] = '#,Nama,Tgl Transaksi,Metode Pembayaran,Nominal,Status';

        echo "<table border=1>";

        echo "<thead>";
        echo "<tr>";
            echo "<th>No</th>";
            echo "<th>Campaign</th>";
            echo "<th>Nama</th>";
            echo "<th>Email</th>";
            echo "<th>No Telp</th>";
            echo "<th>Tanggal</th>";
            echo "<th>Metode Pembayaran</th>";
            echo "<th>Nominal</th>";
            echo "<th>Status</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        foreach ($funding as $key => $value) {
            if ($value->status == "paid") {
                $value->status = "sukses";
            } elseif (($value->status == "pending" && $value->time_limit > now()) || $value->status == "canceled") {
                $value->status = "gagal";
            }
            $date = date('d M Y', strtotime($value->created_at));
            $index = $key + 1;
            if($value->project != null) {
                $project_name = $value->project->title;
            }else{
                $project_name ="Program instant ".$value->fund_type;
            }

            echo "<tr>";
                echo "<td>".$index."</td>";
                echo "<td>".$project_name."</td>";
                echo "<td>".$value->donature_name."</td>";
                echo "<td>".$value->donature_email."</td>";
                echo "<td>".$value->donature_phone."</td>";
                echo "<td>".$date."</td>";
                echo "<td>".$value->payment_method."</td>";
                echo "<td>".$value->nominal."</td>";
                echo "<td>".$value->status."</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

        // $fp = fopen('php://output', 'wb');
        // foreach ($data as $key => $line) {
        //     $val = explode(",", $line);
        //     fputcsv($fp, $val);
        // }
        // fclose($fp);
    }

}
