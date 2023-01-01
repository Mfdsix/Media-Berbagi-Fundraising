<?php

namespace App\Http\Controllers\Program;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Withdrawal;

class DistributionController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::orderBy('id', 'DESC')
            ->where('withdrawal_type', 'distribution')
            ->where('created_at', 'LIKE', date('Y-m') . '%')
            ->paginate(25);

        return view('program.distribution.index')->with([
            'datas' => $withdrawals,
        ]);
    }

    public function create()
    {
        $projects = Project::where('status', 1)
            ->get();

        return view('program.distribution.form')->with([
            'projects' => $projects,
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'project_id' => 'required',
            'nominal' => 'required|integer|min:1',
            'use_plan' => 'nullable|min:10',
            'receiver' => 'required|integer|min:1',
            'receiver_unit' => 'required|string',
            'additional_link' => 'nullable|string',
        ];

        $request->validate($rules);

        $project = Project::findOrFail($request->project_id);

        $donation = $project->countDonation();
        $withdrawed = $project->withdrawal();

        $limit = $donation - $withdrawed;
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
            'receiver' => $request->receiver,
            'receiver_unit' => $request->receiver_unit,
            'additional_link' => $request->additional_link,
            'account_type' => 'program',
        ]);
        $update = Update::create([
            'project_id' => $request->project_id,
            'nominal' => $request->nominal,
            'content' => $request->use_plan ?? 'Penyaluran Dana pada ' . date('d M Y'),
            'update_type' => 1,
            'reference_id' => $withdraw->id,
        ]);

        return redirect('/dashboard-program/funding_distribution');
    }

    public function edit($id)
    {
        $withdraw = Withdrawal::findOrFail($id);
        $projects = Project::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('program.funding_distribution.form')->with([
            'data' => $withdraw,
            'projects' => $projects,
        ]);
    }

    public function update($id, Request $request)
    {
        $withdraw = Withdrawal::findOrFail($id);
        $rules = [
            'use_plan' => 'nullable|min:10',
            'receiver' => 'required|integer|min:1',
            'receiver_unit' => 'required|string',
            'additional_link' => 'nullable|string',
        ];
        $request->validate($rules);

        $withdraw->update([
            'use_plan' => $request->use_plan,
            'receiver' => $request->receiver,
            'receiver_unit' => $request->receiver_unit,
            'additional_link' => $request->additional_link,
        ]);

        return redirect('/dashboard-program/funding_distribution');
    }

    public function destroy($id)
    {
        $withdraw = Withdrawal::findOrFail($id);
        $withdraw->delete();
        Update::where('reference_id', $id)
            ->delete();

        return redirect('/dashboard-program/funding_distribution');
    }
}
