<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\Update;

class DistributionController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::orderBy('id', 'DESC')
            ->paginate(25);

        return view('accounting.distribution.index')->with([
            'datas' => $withdrawals,
        ]);
    }

    public function create()
    {
        $projects = Project::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('accounting.distribution.form')->with([
            'projects' => $projects,
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'project_id' => 'required',
            'nominal' => 'required|integer|min:1',
            'use_plan' => 'nullable|min:10',
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
        ]);
        $update = Update::create([
            'project_id' => $request->project_id,
            'nominal' => $request->nominal,
            'content' => $request->use_plan ?? 'Penyaluran Dana pada ' . date('d M Y'),
            'update_type' => 1,
            'reference_id' => $withdraw->id,
        ]);

        return redirect('/accounting/funding_distribution');
    }

    public function edit($id)
    {
        $withdraw = Withdrawal::findOrFail($id);
        $projects = Project::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('accounting.distribution.form')->with([
            'data' => $withdraw,
            'projects' => $projects,
        ]);
    }

    public function update($id, Request $request)
    {
        $withdraw = Withdrawal::findOrFail($id);
        $rules = [
            'use_plan' => 'nullable|min:10',
        ];
        $request->validate($rules);

        $withdraw->update([
            'use_plan' => $request->use_plan,
        ]);

        return redirect('/accounting/funding_distribution');
    }

    public function destroy($id)
    {
        $withdraw = Withdrawal::findOrFail($id);
        $withdraw->delete();
        Update::where('reference_id', $id)
            ->delete();

        return redirect('/accounting/funding_distribution');
    }
}
