<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Update;
use App\Models\Withdrawal;
use Auth;
use Illuminate\Http\Request;

class FundingDistributionController extends Controller
{
    public function index()
    {
        $datas = Withdrawal::where('withdrawal_type', 'distribution')
            ->orderBy('id', 'DESC')
            // ->where('created_at', 'LIKE', date('Y-m') . '%')
            ->paginate(25);

        return view('admin.funding_distribution.index')->with([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $projects = Project::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->get();
            
        $type = ['sedekah', 'wakaf', 'zakat'];
        
        foreach($type as $t) {
            $instant = new Project();
            $instant->id = 0;
            $instant->type = $t;
            $instant->title = "Program instant ".$t;
            $instant->percentage = 100;
            $instant->button_label = $t." sekarang";
            $instant->operational_percentage = 0;
            
            // add instant to project
            $projects->push($instant);
        }

        foreach ($projects as $k => $v) {
            $v->nominal = $v->getDonation()['neto'];
        }

        return view('admin.funding_distribution.form')->with([
            'projects' => $projects,
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'project_id' => 'required',
            'nominal' => 'required|integer|min:1',
            'use_plan' => 'required|min:50',
            'receiver' => 'required|integer|min:1',
            'receiver_unit' => 'required|string',
            // 'additional_link' => 'nullable|string',
        ];

        $request->validate($rules);

        $x = json_decode(base64_decode($request->project_id));
        $type = $x[1];
        $request->merge(['project_id' => $x[0]]);

        $project = Project::find($request->project_id);

        if($project == null) {
            $project = new Project();
            $project->id = 0;
            $project->type = $type;
            $project->title = "Program instant ".$type;
            $project->percentage = 100;
            $project->button_label = $type." sekarang";
        }

        $instance_percentage = $v->operational_percentage ?? 0;
        $media_berbagi_percentage = 1;
        $donation = $project->getDonation()['neto'];
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
            // 'additional_link' => $request->additional_link,
            'additional_link' => $request->null,
            'project_type' => $project->type,
        ]);
        $update = Update::create([
            'title' => 'Pencairan Dana Rp '.number_format($request->nominal),
            'project_id' => $request->project_id,
            'nominal' => $request->nominal,
            'content' => $request->use_plan ?? 'Penyaluran Dana pada ' . date('d M Y'),
            'update_type' => 1,
            'reference_id' => $withdraw->id,
        ]);

        return redirect('/admin/funding_distribution');
    }

    public function edit($id)
    {
        $withdraw = Withdrawal::findOrFail($id);
        $projects = Project::where('status', 1)
            ->where('id', $withdraw->project_id)
            ->orderBy('created_at', 'DESC')
            ->first();
        
        if($projects == null) {
            $project = new Project();
            $project->id = 0;
            $project->title = "Program instant ".$withdraw->project_type;
            $project->type = $withdraw->project_type;
            $projects = $project;
        }

        // foreach ($projects as $k => $v) {
            $instance_percentage = $projects->operational_percentage ?? 0;
            $media_berbagi_percentage = 1;

            $projects->nominal = ((100 - $instance_percentage - $media_berbagi_percentage) / 100 * $projects->countDonation()) - $projects->withdrawal();
        // }

        return view('admin.funding_distribution.form')->with([
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

        $update = Update::where('reference_id', $withdraw->id)
        ->update([
            'content' => $request->use_plan ?? 'Penyaluran Dana pada ' . date('d M Y')
        ]);

        return redirect('/admin/funding_distribution');
    }

    public function destroy($id)
    {
        $withdraw = Withdrawal::findOrFail($id);
        $withdraw->delete();
        Update::where('reference_id', $id)
            ->delete();

        return redirect('/admin/funding_distribution');
    }
}
