<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\Fundraiser;
use App\Models\Inbox;
use App\Models\Project;
use App\Models\Update;
use App\Models\Withdrawal;
use Auth;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index()
    {
        $datas = Withdrawal::where('status', 0)
            ->paginate(25);

        return view('admin.withdrawal.index')->with([
            'datas' => $datas,
        ]);
    }

    public function show($id)
    {
        $data = Withdrawal::findOrFail($id);
        $fundraiser = $data->fundraiser;

        return view('admin.withdrawal.show')->with([
            'data' => $data,
            'fundraiser' => $fundraiser,
        ]);
    }

    public function verify($id, Request $request)
    {
        $data = Withdrawal::findOrFail($id);
        $project = Project::findOrFail($data->project_id);
        $fundraiser = Fundraiser::findOrFail($data->user_id);

        $filename = null;
        if ($request->hasFile('proof')) {
            $filename = $request->file('proof')->store('uploads/proof');
        }

        $content = '<b>' . $fundraiser->fullame . '</b> Telah melakukan penarikan dana sebesar Rp ' . str_replace(',', '.', number_format($data->nominal)) . ' untuk projek pendanaan <b>' . $project->title . '</b> dengan rencana penggunaan <u>' . $data->use_plan . '</u>';

        $data->update([
            'status' => 1,
            'approver_id' => Auth::user()->id,
            'path_proof' => $filename,
        ]);

        $update = Update::create([
            'project_id' => $data->project_id,
            'nominal' => $data->nominal,
            'content' => $content,
            'update_type' => 1,
        ]);

        $users = Funding::where('project_id', $data->project_id)
            ->where('status', 'paid')
            ->distinct()
            ->get(['user_id'])
            ->pluck('user_id')
            ->toArray();

        if (count($users) > 0) {
            $notifInsert = [];
            foreach ($users as $key => $value) {
                $notifInsert[] = [
                    'user_id' => $value,
                    'title' => 'Penarikan Dana',
                    'content' => $content,
                    'project_id' => $id,
                    'target_id' => $update->id,
                    'status' => 0,
                    'created_at' => Date('Y-m-d H:i:s'),
                ];
            }
            $createInbox = Inbox::insert($notifInsert);
        }

        return redirect('admin/withdrawal')->with([
            'success' => 'Penarikan Dana Telah Diverifikasi',
        ]);
    }

    public function reject($id, Request $request)
    {
        $data = Withdrawal::findOrFail($id);

        $data->update([
            'status' => 2,
            'approver_id' => Auth::user()->id,
            'reject_reason' => $request->reject_reason,
        ]);

        return redirect('admin/withdrawal')->with([
            'error' => 'Penarikan Dana Telah Ditolak',
        ]);
    }
}
