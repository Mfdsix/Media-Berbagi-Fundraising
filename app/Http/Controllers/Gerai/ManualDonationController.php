<?php

namespace App\Http\Controllers\Gerai;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\Fundraiser;
use App\Models\FundraiserTransaction;
use App\Models\Project;
use Auth;
use Illuminate\Http\Request;
// use instant program
use App\Models\InstantProgram;

class ManualDonationController extends Controller
{
    public function index()
    {
        $funding = Funding::leftJoin('projects as p', 'p.id', '=', 'fundings.project_id')
            ->where('is_admin', 1)
            ->where('inputer_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->select('fundings.*', 'p.title')
            ->paginate(25);

        return view('gerai.manual.index')->with([
            'funding' => $funding,
        ]);
    }

    public function create()
    {
        $projects = Project::where('status', 1)
            ->orderBy('created_at', 'ASC')
            ->get();

        $type = ['sedekah', 'wakaf', 'zakat'];
    
        foreach($type as $t) {
            $instant = new Project();
            $instant->id = 0;
            $instant->type = $t;
            $instant->title = "Program instant ".$t;
            $instant->percentage = 100;
            $instant->button_label = "sedekah sekarang";
            $instant->operational_percentage = 0;
            
            // add instant to project
            $projects->push($instant);
        }

        $fundraisers = Fundraiser::where('is_active', 1)
            ->orderBy('created_at', 'ASC')
            ->get();

        return view('gerai.manual.form')->with([
            'projects' => $projects,
            'fundraisers' => $fundraisers,
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

        $x = json_decode(base64_decode($request->project_id));
        $type = $x[1];
        $request->merge(['project_id' => $x[0]]);

        $referral = null;
        if($request->fundraiser_id != null) {
            $referral =  Fundraiser::find($request->fundraiser_id);
        }

        $funding = Funding::create([
            'donature_name' => $request->donature_name,
            'donature_email' => $request->donature_email,
            'donature_phone' => $request->donature_phone,
            'nominal' => $request->nominal,
            'project_id' => $request->project_id,
            'payment_method' => 'Gerai',
            'time_limit' => now(),
            'total' => $request->nominal,
            'is_admin' => 1,
            'status' => 'paid',
            'referral_id' => $referral ? $referral->user_id : null,
            'inputer_id' => Auth::user()->id,
            'inputer_type' => 'gerai',
            'fund_type' => $type,
        ]);

        if($funding->project != null){
            $fee_reward = $funding->project->fundraiser_reward != null ? ($funding->project->fundraiser_reward / 100) : 0.01;
        }else{
            $fee_reward = 0.01;
            if($funding->project_id == 0){
                $fee_reward = 0.01;
                $instant = InstantProgram::where('program', $funding->fund_type)->first();
                $fee_reward = $instant->commision / 100;
            }
        }

        $commission = ($funding->nominal * $fee_reward);

        if($referral != null) {
            // no commision for fundraiser internal
            FundraiserTransaction::create([
                'type' => 'commission',                
                'amount' => $commission,
                'status' => 'success',
                'fundraiser_id' => $referral->id,
                'reference_id' => $funding->id,
                'user_id' => $referral->user_id,
            ]);

            $referral->update([
                'success_transaction' => $referral->success_transaction + 1,
            ]);
        }

        $this->templateMessage([
            "type" => "thanks",
            "funding" => $funding,
        ]);

        return redirect('gerai/manual_donation?receipt=' . $funding->id)->with([
            'success' => 'Berhasil Menambahkan Donasi',
        ]);
    }

    public function edit($id)
    {
        $funding = Funding::findOrFail($id);

        $projects = Project::where('status', 1)
            ->orderBy('created_at', 'ASC')
            ->get();

        $type = ['sedekah', 'wakaf', 'zakat'];

        foreach($type as $t) {
            $instant = new Project();
            $instant->id = 0;
            $instant->type = $t;
            $instant->title = "Program instant ".$t;
            $instant->percentage = 100;
            $instant->button_label = "sedekah sekarang";
            $instant->operational_percentage = 0;
            
            // add instant to project
            $projects->push($instant);
        }

        $fundraisers = Fundraiser::where('is_active', 1)
            ->orderBy('created_at', 'ASC')
            ->get();

        return view('gerai.manual.form')->with([
            'data' => $funding,
            'projects' => $projects,
            'fundraisers' => $fundraisers,
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
            // 'project_id' => 'required',
            'nominal' => 'required',
        ]);

        $funding->update([
            'donature_name' => $request->donature_name,
            'donature_email' => $request->donature_email,
            'donature_phone' => $request->donature_phone,
            'nominal' => $request->nominal,
            // 'project_id' => $request->project_id,
        ]);

        return redirect('gerai/manual_donation')->with([
            'success' => 'Berhasil Mengedit Donasi',
        ]);
    }

    public function destroy($id)
    {
        $funding = Funding::findOrFail($id);
        $funding->delete();

        return redirect('gerai/manual_donation')->with([
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
