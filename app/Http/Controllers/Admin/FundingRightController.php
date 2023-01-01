<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Withdrawal;
use Auth;
use Illuminate\Http\Request;

class FundingRightController extends Controller
{
    public function instance()
    {
        $datas = Withdrawal::where('withdrawal_type', 'instance_right')
            ->orderBy('created_at', 'DESC')
            ->paginate(25);

        return view('admin.right.instance')->with([
            'datas' => $datas,
        ]);
    }

    public function mediaberbagi()
    {
        $datas = Withdrawal::where('withdrawal_type', 'mediaberbagi_right')
            ->orderBy('created_at', 'DESC')
            ->paginate(25);

        return view('admin.right.mediaberbagi')->with([
            'datas' => $datas,
        ]);
    }

    public function create($right)
    {
        $projects = Project::where('status', 1)
            ->get();

        foreach ($projects as $k => $v) {
            if ($right == 'instance_right') {
                $nominal = floor(($v->operational_percentage ?? 0) * $v->countDonation() / 100);
                $withdrawed = $v->withdrawal('instance_right');
            } else {
                $nominal = floor(1 * $v->countPGDonation() / 100);
                $withdrawed = $v->withdrawal('mediaberbagi_right');
            }
            $v->limit = $nominal - $withdrawed;
        }

        return view('admin.right.form')->with([
            'projects' => $projects,
            'title' => $right == 'instance_right' ? 'Hak Lembaga' : 'Hak MediaBerbagi',
        ]);
    }

    public function store($type, Request $request)
    {
        $rules = [
            'project_id' => 'required',
            'nominal' => 'required|integer|min:1',
            'use_plan' => 'nullable|min:10',
        ];

        $request->validate($rules);

        $project = Project::findOrFail($request->project_id);

        if ($type == 'instance_right') {
            $nominal = floor(($project->operational_percentage ?? 0) * $project->countDonation() / 100);
            $withdrawed = $project->withdrawal('instance_right');
        } else {
            $nominal = floor(1 * $project->countPGDonation() / 100);
            $withdrawed = $project->withdrawal('mediaberbagi_right');
        }
        $limit = $nominal - $withdrawed;
        $rules = [
            'nominal' => 'integer|max:' . $limit,
        ];
        $request->validate($rules);

        $withdraw = Withdrawal::create([
            'user_id' => Auth::user()->id,
            'project_id' => $request->project_id,
            'nominal' => $request->nominal,
            'use_plan' => $request->use_plan ?? '',
            'withdraw_date' => now(),
            'withdrawal_type' => $type,
        ]);

        return redirect('/admin/' . $type);
    }

    public function edit($type, $id)
    {
        $withdraw = Withdrawal::where('withdrawal_type', $type)
            ->findOrFail($id);
        $projects = Project::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin.right.form')->with([
            'data' => $withdraw,
            'projects' => $projects,
            'title' => $type == 'instance_right' ? 'Hak Lembaga' : 'Hak MediaBerbagi',
        ]);
    }

    public function update($type, $id, Request $request)
    {
        $withdraw = Withdrawal::where('withdrawal_type', $type)
            ->findOrFail($id);
        $rules = [
            'use_plan' => 'nullable|min:10',
        ];
        $request->validate($rules);

        $withdraw->update([
            'use_plan' => $request->use_plan,
        ]);

        return redirect('/admin/' . $type);
    }

    public function destroy($type, $id)
    {
        $withdraw = Withdrawal::where('withdrawal_type', $type)
            ->findOrFail($id);
        $withdraw->delete();

        return redirect('/admin/' . $type);
    }
}
