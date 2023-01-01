<?php

namespace App\Http\Controllers\Program;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\Project;

class DashboardController extends Controller
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

        return view('program.dashboard')->with([
            'instant' => $instant,
            'datas' => $datas,
        ]);
    }
}
