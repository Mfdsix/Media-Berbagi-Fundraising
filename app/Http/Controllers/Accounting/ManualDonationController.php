<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\Project;
use Auth;
use Illuminate\Http\Request;

class ManualDonationController extends Controller
{
    public function index()
    {
        $funding = Funding::leftJoin('projects as p', 'p.id', '=', 'fundings.project_id')
            ->where('is_admin', 1)
            ->orderBy('created_at')
            ->select('fundings.*', 'p.title')
            ->paginate(30);

        return view('accounting.manual.index')->with([
            'funding' => $funding,
        ]);
    }

    public function create()
    {
        $campaign = Project::where('status', 1)
            ->orderBy('created_at', 'ASC')
            ->get();

        return view('accounting.manual.form')->with([
            'campaign' => $campaign,
        ]);
    }

    public function store(Request $request)
    {
        $request->merge([
            'nominal' => str_replace('.', '', $request->nominal),
        ]);

        $request->validate([
            'donature_name' => 'required',
            'donature_email' => 'required',
            'donature_phone' => 'required',
            'project_id' => 'required',
            'nominal' => 'required',
        ]);

        $funding = Funding::create([
            'donature_name' => $request->donature_name,
            'donature_email' => $request->donature_email,
            'donature_phone' => $request->donature_phone,
            'nominal' => $request->nominal,
            'project_id' => $request->project_id,
            'payment_method' => 'Admin',
            'time_limit' => now(),
            'total' => $request->nominal,
            'is_admin' => 1,
            'status' => 'paid',
            'inputer_id' => Auth::user()->id,
            'inputer_type' => 'accounting',
        ]);

        return redirect('accounting/manual_donation?receipt=' . $funding->id)->with([
            'success' => 'Berhasil Menambahkan Donasi',
        ]);
    }

    public function edit($id)
    {
        $funding = Funding::findOrFail($id);

        $campaign = Project::where('status', 1)
            ->orderBy('created_at', 'ASC')
            ->get();

        return view('accounting.manual.form')->with([
            'data' => $funding,
            'campaign' => $campaign,
        ]);
    }

    public function update($id, Request $request)
    {
        $funding = Funding::findOrFail($id);

        $request->merge([
            'nominal' => str_replace('.', '', $request->nominal),
        ]);

        $request->validate([
            'donature_name' => 'required',
            'donature_email' => 'required',
            'donature_phone' => 'required',
            'project_id' => 'required',
            'nominal' => 'required',
        ]);

        $funding->update([
            'donature_name' => $request->donature_name,
            'donature_email' => $request->donature_email,
            'donature_phone' => $request->donature_phone,
            'nominal' => $request->nominal,
            'project_id' => $request->project_id,
        ]);

        return redirect('accounting/manual_donation')->with([
            'success' => 'Berhasil Mengedit Donasi',
        ]);
    }

    public function destroy($id)
    {
        $funding = Funding::findOrFail($id);
        $funding->delete();

        return redirect('accounting/manual_donation')->with([
            'success' => 'Berhasil Menghapus Donasi',
        ]);
    }

    public function receipt($id)
    {
        $data = Funding::where('is_admin', 1)
            ->findOrFail($id);

        return view('export.kwitansi')->with([
            'data' => $data,
        ]);
    }
}
