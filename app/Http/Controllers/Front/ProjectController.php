<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\PaymentController;
use App\Models\Bank;
use App\Models\Funding;
use App\Models\InstantProgram;
use App\Models\Fundraiser;
use App\Models\FundraiserTransaction;
use App\Models\Project;
use App\Models\ProjectFavourite;
use App\Models\Referral;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Session;
use Setting;

class ProjectController extends PaymentController
{
    public function index($slug)
    {

        if($slug == "program-instant-sedekah") {
            return $this->instant('sedekah');
        }else if($slug == "program-instant-zakat") {
            return $this->instant('zakat');
        }else if($slug == "program-instant-wakaf") {
            return $this->instant('wakaf');
        }

        $referral = Referral::where('slug', $slug)->first();

        if ($referral) {
            $project = Project::where('id', $referral->project_id)
                ->where('status', 1)
                ->firstOrFail();
            $project->title = $referral->title;
            $project->nominal_target = $referral->target;
        } else {
            $project = Project::where('slug', $slug)
                ->where('status', 1)
                ->firstOrFail();
        }
        
        $project->update([
            'views' => $project->views + 1,
        ]);

        $today = Date('Y-m-d');
        $donations = $project->countDonation($referral ? $referral->id : null);
        // $fundraisers = $project->getFundraisers($referral ? $referral->id : null);
        $fundraisers = $project->getFundraisersProject();
        // dd($fundraisers);
        
        $fundraiser_all = [];

        foreach ($fundraisers as $k => $v) {

            if(empty($fundraiser_all[$v->fundraiser_id])) {
                $fundraiser_all[$v->fundraiser_id] = $v;
            }

            if ($v->fullname != null) {
                $v->photo = $this->usernamify($v->fullname);
            } else {
                $v->photo = null;
            }
            if(isset($fundraiser_all[$v->fundraiser_id]->total_donature)) {
                $fundraiser_all[$v->fundraiser_id]->total_donature += 1;
            }else{
                $fundraiser_all[$v->fundraiser_id]->total_donature = 1;
            }
            if(isset($fundraiser_all[$v->fundraiser_id]->total_funding)) {
                $fundraiser_all[$v->fundraiser_id]->total_funding += $v->nominal;
            }else{
                $fundraiser_all[$v->fundraiser_id]->total_funding = $v->nominal;
            }
        }

        $isReferral = false;
        if (Auth::check() && count($fundraisers) > 0) {
            foreach ($fundraisers as $k => $v) {
                if ($v->user_id == Auth::user()->id) {
                    $isReferral = true;
                }
            }
        }

        if ($project->date_target != null && $project->nominal_target != null) {
            $project->date_count = date_diff(date_create($project->date_target), date_create($today))->days;
            $project->percentage = $donations / $project->nominal_target * 100;
            $project->nominal_target = "Rp " . str_replace(',', '.', number_format($project->nominal_target));
        } else {
            $project->percentage = 100;
            $project->nominal_target = ($referral) ? $referral->target : '∞';
            $project->date_count = '∞';
        }
        $project->donations = "Rp " . str_replace(',', '.', number_format($donations));

        $update = $project->news()->orderBy('created_at', 'DESC')->first();
        if (!empty($update)) {
            // $date = explode(' ', $update->created_at);
            // $update->date = $this->date_to_idn($date[0]) . ' ' . $date[1];
            $update->date = $update->created_at->diffForHumans();
        }

        $update_all = $project->news()->orderBy('created_at', 'DESC')->get();
        if (!empty($update)) {
            // $date = explode(' ', $update->created_at);
            // $update->date = $this->date_to_idn($date[0]) . ' ' . $date[1];
            $update->date = $update->created_at->diffForHumans();
        }

        $donaturs = Funding::where('project_id', $project->id)
            ->where('status', 'paid')
            ->when($referral, function ($q) use ($referral) {
                return $q->where('referral_id', $referral->id);
            })
            ->orderBy('created_at', 'DESC')
            ->get();

        foreach ($donaturs as $key => $value) {
            $value->photo = $this->usernamify($value->donature_name);
            $value->nominal = str_replace(',', '.', number_format($value->nominal));
            if ($value->is_anonymous == 1) {
                $value->photo = "HA";
                $value->donature_name = 'Hamba Allah';
            }
        }

        foreach ($fundraisers as $key => $value) {
            $value->photo = $this->usernamify($value->fullname);
            $value->nominal = "Rp " . str_replace(',', '.', number_format($value->collected));
        }

        $favorite = false;
        if (Auth::check()) {
            $favorite = ProjectFavourite::where('user_id', Auth::user()->id)
                ->where('project_id', $project->id)
                ->exists();
        }

        $web_set = Setting::find(1);
        $meta = new \stdClass();
        $meta->title = $project->title;
        $desc = explode(" ",strip_tags($project->content));
        $desc = array_splice($desc, 0, 24);
        $desc = implode(" ",$desc);
        $meta->description = preg_replace("/&#?[a-z0-9]+;/i","",$desc);
        $meta->type = "website";
        $meta->url = url($slug);
        $meta->icon = asset('storage/'.$web_set->path_icon);

        $meta->image = getThumb(asset('storage/'.$project->path_featured), 320,480);

        if($this->theme) {
            $theme = $this->theme->theme;
            if(property_exists($this->theme->script, 'detail')) {
                $script = $this->theme->script->detail;
                $theme = "themes/".$theme.'/'.$script;
                $theme = str_replace(".blade.php", "", $theme);
            }else{
                $theme = 'front.projects.detail';
            }
        }else{
            $theme = 'front.projects.detail';
        }

        return view($theme)->with([
            'project' => $project,
            'update' => $update,
            'update_all' => $update_all,
            'donaturs' => $donaturs,
            'fundraisers' => $fundraiser_all,
            'type' => $project->type,
            'is_referral' => $isReferral,
            'referral' => $referral,
            'favorite' => $favorite,
            'meta' => $meta,
        ]);
        abort(404);

    }

    public function instant($type) {
        $instant = InstantProgram::where('program', $type)->first();
        if($instant->is_active == 0) {
            abort(404);
        }
        $project = new Project();
        $project->id = 0;
        $project->type = $type;
        $project->title = $instant->title ?? "Program instant ".$type;
        $project->path_featured = $instant->path_featured == "" ? '../assets/img/sedekah-icon.svg' : $instant->path_featured;
        $project->percentage = 100;
        $project->button_label = $instant->label_button == "" ? $type." sekarang" : $instant->label_button;
        $project->content = $instant->content;
        if($type != 'wakaf') {
            $project->wakaf_price = 0;
        }else{
            $project->wakaf_price = 50000;
        }

        $donations = Funding::where("status", "paid")
            ->where("fund_type", $type)
            ->where("project_id", 0)
            ->sum("nominal");
        $project->donations = "Rp " . str_replace(',', '.', number_format($donations));

        $donaturs = Funding::where("status", "paid")
            ->where("fund_type", $type)
            ->where("project_id", 0)
            ->get();

        foreach($donaturs as $dn) {
            $dn->nominal = str_replace(',', '.', number_format($dn->nominal));
        }

        $fundraisers = $project->getFundraisersProject();
        $fundraiser_all = [];

        foreach ($fundraisers as $k => $v) {

            if(empty($fundraiser_all[$v->fundraiser_id])) {
                $fundraiser_all[$v->fundraiser_id] = $v;
            }

            if ($v->fullname != null) {
                $v->photo = $this->usernamify($v->fullname);
            } else {
                $v->photo = null;
            }
            if(isset($fundraiser_all[$v->fundraiser_id]->total_donature)) {
                $fundraiser_all[$v->fundraiser_id]->total_donature += 1;
            }else{
                $fundraiser_all[$v->fundraiser_id]->total_donature = 1;
            }
            if(isset($fundraiser_all[$v->fundraiser_id]->total_funding)) {
                $fundraiser_all[$v->fundraiser_id]->total_funding += $v->nominal;
            }else{
                $fundraiser_all[$v->fundraiser_id]->total_funding = $v->nominal;
            }
        }

        $type = "sedekah";
        $referral = new Referral();

        $isReferral = false;
        if (Auth::check() && count($fundraisers) > 0) {
            foreach ($fundraisers as $k => $v) {
                if ($v->user_id == Auth::user()->id) {
                    $isReferral = true;
                }
            }
        }

        $update = $project->news()->orderBy('created_at', 'DESC')->first();
        if (!empty($update)) {
            // $date = explode(' ', $update->created_at);
            // $update->date = $this->date_to_idn($date[0]) . ' ' . $date[1];
            $update->date = $update->created_at->diffForHumans();
        }

        $update_all = $project->news()->orderBy('created_at', 'DESC')->get();
        if (!empty($update)) {
            // $date = explode(' ', $update->created_at);
            // $update->date = $this->date_to_idn($date[0]) . ' ' . $date[1];
            $update->date = $update->created_at->diffForHumans();
        }

        $slug = "program-instant-".$type;

        $web_set = Setting::find(1);
        $meta = new \stdClass();
        $meta->title = $project->title;
        $desc = explode(" ",strip_tags($project->content));
        $desc = array_splice($desc, 0, 24);
        $desc = implode(" ",$desc);
        $meta->description = preg_replace("/&#?[a-z0-9]+;/i","",$desc);
        $meta->type = "website";
        $meta->url = url($slug);
        $meta->icon = asset('storage/'.$web_set->path_icon);

        $meta->image = getThumb(asset('storage/'.$project->path_featured), 320,480);

        return view('front.projects.detail')->with([
            'project' => $project,
            'donaturs' => $donaturs,
            'fundraisers' => $fundraiser_all,
            'type' => $project->type,
            'is_referral' => $isReferral,
            'referral' => $referral,
            'meta' => $meta,
            'update' => $update,
            'update_all' => $update_all
        ]);
        abort(404);
    }

    public function donation($id, Request $request)
    {
        $start = $request->start ? $request->start : 0;
        $limit = 15;

        $fundings = Funding::leftJoin('users', 'users.id', '=', 'fundings.user_id')
            ->where('project_id', $id)
            ->where('status', 'paid')
            ->orderBy('created_at', 'DESC')
            ->select('fundings.*', 'users.path_foto')
        // ->offset($start)
        // ->limit($limit)
            ->get();

        if (count($fundings) == 0) {
            return response()->json([
                'success' => true,
                'is_end' => true,
                'message' => 'Belum Ada Donasi',
            ]);
        }

        foreach ($fundings as $key => $value) {
            if ($value->path_foto == null) {
                $value->photo = asset('images/person.png');
            } else {
                $value->photo = asset('storage/' . $value->path_foto);
            }
            $value->nominal = str_replace(',', '.', number_format($value->nominal));
            if ($value->is_anonymous == 1) {
                $value->donature_name = 'Hamba Allah';
                $value->photo = asset('images/person.png');
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Ok',
            'datas' => $fundings,
        ]);
    }

    public function news($id)
    {
        $project = Project::findOrFail($id);
        $update = $project->news()
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        foreach ($update as $key => $value) {
            // $date = explode(' ', $value->created_at);
            // $value->date = $this->date_to_idn($date[0]) . ' ' . $date[1];
            $value->date = $value->created_at->diffForHumans();
        }

        return view('front.project.news')->with([
            'project' => $project,
            'update' => $update,
        ]);
    }

    public function delete($id)
    {
        $check = ProjectFavourite::find($id);

        $check->update([
            'user_id' => '-' . Auth::user()->id,
        ]);

        if ($check) {
            return redirect()->back()->with('success', 'Berhasil menghapus dari pavorit');
        } else {
            return redirect()->back()->with('error', 'Gangguan ketika menghapus pavorit');
        }
    }

    public function nominal($payload)
    {
        $data = json_decode(base64_decode($payload));
        if ($data != null) {

            $project = Project::find($data->id);

            $strict = false;
            $default = 0;

            if(isset($data->strict)) {
                $strict = $data->strict;
            }

            if(isset($data->defaults)) {
                $default = str_replace('Rp', 'Rp. ', $data->defaults);
            }

            if($project == null && $data->id == 0) {
                $project = new Project();
                $project->id = 0;
                $project->type = $data->type;
                $project->title = "Program instant ".$data->type;
                $project->path_featured = '../assets/img/sedekah-icon.svg';
                $project->percentage = 100;
                $project->button_label = "sedekah sekarang";
            }else if($project == null && $data->id == null){
                abort(404);
            }

            $payments = $this->getPaymentMethods();
            $banks = Bank::all();
            foreach ($banks as $key => $value) {
                $value->request_code = 'bank-' . $value->id . '-' . $value->bank_name;
                $value->fee = 0;
            }
            $payments['bk'] = $banks;

            if(Auth::user() == null){
                $donature_email = "";
                $donature_name = "";
                $donature_phone = "";
            }else{
                $donature_email = Auth::user()->email;
                $donature_name = Auth::user()->name;
                $donature_phone = Auth::user()->phone;
            }

            return view('front.projects.nominal')->with([
                'strict' => $strict,
                'default' => $default,
                'project' => $project,
                'nominal' => $data->nominal,
                'payload' => $payload,
                'type' => $data->type,
                'referral_id' => $data->referral_id ?? null,
                'payments' => $payments,
                'donature_name' => $donature_name,
                'donature_email' => $donature_email,
                'donature_phone' => $donature_phone,
            ]);

        } else {
            abort(404);
        }
    }

    public function nominal_process($payload, Request $request)
    {
        $data = json_decode(base64_decode($payload));

        if ($data != null) {

            $fundraiser = null;
            if (isset($data->referral_code) && $data->referral_code) {
                $fundraiser = Fundraiser::where('referral_code', $data->referral_code)
                    ->first();
            }

            $nominal = str_replace('Rp ', '', str_replace('.', '', $request->nominal));

            $project = Project::find($data->id);

            if($project == null && $data->id == 0) {
                $project = new Project();
                $project->id = 0;
                $project->type = $data->type;
                $project->title = "Program instant ".$data->type;
                $project->path_featured = '../assets/img/sedekah-icon.svg';
                $project->percentage = 100;
                $project->button_label = "sedekah sekarang";
            }else if($project == null && $data->id == null){
                abort(404);
            }

            $request->merge([
                'nominal' => $nominal,
            ]);
            if($project->type != "registration") {
                $rules = [
                    'nominal' => 'required|numeric|min:1000',
                    'donature_name' => 'required',
                    'donature_email' => 'required',
                    'donature_phone' => 'numeric|nullable',
                    'special_message' => 'nullable|string|max:300',
                    'payment_method' => 'required',
                ];
            }else{
                $rules = [
                    'nominal' => 'required|numeric|min:1000',
                    'donature_name' => 'required',
                    'donature_email' => 'required',
                    'donature_phone' => 'numeric|nullable',
                    'special_message' => 'nullable|string|max:300',
                    'payment_method' => 'required',
                    'usia' => 'required',
                    'kota' => 'required',
                    'jeniskelamin' => 'required',
                    'typeprogram' => 'required',
                ];
            }

            $request->validate($rules);

            $expl = explode('-', $request->payment_method);
            $payment_type = $expl[0];
            $payment_code = $expl[1];
            $payment_method = $expl[2];

            if ($payment_type == 'wallet') {
                $saldo = Auth::user()->saldo;
                $rules['nominal'] .= '|min:1000|max:' . $saldo;
            } else {
                $rules['nominal'] .= '|min:1000';
            }

            if ($payment_type == 'bank') {
                $unique = $this->getUnique();
            } else {
                $unique = 0;
            }

            if ($payment_type == 'bank') {
                $total = (int) $request->nominal + $unique;
            } else {
                $total = (int) $request->nominal;
            }

            $post = [
                'project_id' => $data->id,
                'user_id' => Auth::check() ? Auth::user()->id : null,
                'nominal' => $request->nominal,
                'payment_method' => $payment_method,
                'donature_name' => $request->donature_name,
                'donature_email' => $request->donature_email,
                'donature_phone' => $request->donature_phone,
                'special_message' => $request->special_message,
                'is_anonymous' => $request->has('is_anonymous') ? 1 : 0,
                'unique_code' => $unique,
                'additional_fee' => 0,
                'status' => 'pending',
                'payment_type' => $payment_type,
                'payment_code' => $payment_code,
                'total' => $total,
                'time_limit' => Carbon::now()->addDay(3)->toDateTimeString(),
                'fund_type' => $data->type,
                'referral_id' => $fundraiser ? $fundraiser->user_id : null,
                'usia' => $request->usia,
                'kota' => $request->kota,
                'jeniskelamin' => $request->jeniskelamin,
                'typeprogram' => $request->typeprogram,
            ];

            $project->update([
                'donations' => $project->donations += 1,
            ]);


            if ($payment_type == 'bank' || $payment_type == 'wallet') {
                $process = $this->processNonPG($post);
                return redirect($process);
            } else {
                return $this->processInstant($project, $post);
            }

        } else {
            abort(404);
        }
    }

    public function payment($payload)
    {
        $data = json_decode(base64_decode($payload));
        if ($data != null) {

            $project = Project::findOrFail($data->id);
            $payment = $this->paymentAll();
            $wallet_available = 0;

            $banks = Bank::all();

            foreach ($banks as $key => $value) {
                $value->request_code = 'bank-' . $value->id . '-' . $value->bank_name;
                $value->fee = 0;
            }

            return view('front.projects.payment')->with([
                'project' => $project,
                'banks' => $banks,
                'payment' => $payment,
                'wallet_available' => $wallet_available,
                'payload' => $payload,
            ]);

        } else {
            abort(404);
        }
    }

    public function payment_process(Request $request)
    {
        Session::put('payment', $request->payment);
        Session::put('payment_type', $request->payment_type);
        Session::put('payment_code', $request->payment_code);

        return redirect('/nominal/' . $request->payload);
    }

    public function processNonPG($post)
    {
        if ($post['payment_type'] == 'wallet') {
            $user = Auth::user();
            $user->update([
                'saldo' => $user->saldo - $post['total'],
            ]);
            $post['status'] = 'paid';
        }
        $funding = Funding::create($post);

        // reminder when using manual transaction

        if ($funding->referral_id) {
            $referral = Fundraiser::where('user_id', $funding->referral_id)
                ->first();
            if ($referral) {

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
                
                // add commission
                FundraiserTransaction::create([
                    'type' => 'commission',
                    'amount' => $commission,
                    'status' => 'waiting',
                    'fundraiser_id' => $referral->id,
                    'reference_id' => $funding->id,
                    'user_id' => $referral->user_id,
                ]);

                // $referral->update([
                //     'commissions' => $referral->commissions + $commission,
                //     'collected' => $referral->collected + ($funding->nominal),
                //     'success_transaction' => $referral->success_transaction + 1,
                // ]);
            }
        }

        $this->templateMessage([
            "type" => "reminder",
            "funding" => $funding,
        ]);

        return "/payment/" . $funding->id . "/how_to_pay";
    }

    public function processInstant($project, $post)
    {
        $requestPayment = $this->postTransaction($post, $project);
        if ($requestPayment) {

            // reminder when using payment gateway
            if ($requestPayment['type'] == 'view') {
                $funding = $requestPayment['funding'];
                $this->templateMessage([
                    "type" => "reminder",
                    "funding" => $funding,
                ]);
                return $requestPayment['data'];
            }

            if($requestPayment['type'] == 'data') {
                $funding = $requestPayment['data'];
                $this->templateMessage([
                    "type" => "reminder",
                    "funding" => $funding,
                ]);
            }

            return redirect('/payment/' . $requestPayment['data']->id . '/how_to_pay')->with([
                'success' => 'Transaksi anda telah disimpan, silahkan melakukan pembayaran',
            ]);
        } else {
            abort(500);
        }
    }

    public function calculator()
    {

        $gold_price = $this->getHargaEmas();

            // $gold_price = Setting::where('key', 'gold_price')
            //     ->pluck('value')
            //     ->first() ?? 0;
            // $silver_price = Setting::where('key', 'silver_price')
            //     ->pluck('value')
            //     ->first() ?? 0;

            return view('front.projects.calculator')->with([
                // 'project' => $project,
                'gold' => $gold_price,
                // 'silver' => $silver_price,
                // 'data' => $data,
            ]);

        // } else {
        //     abort(404);
        // }
    }
    public function save($id)
    {
        if (Auth::user() == null) {
            return redirect('/login');
        }
        $check = ProjectFavourite::where('user_id', Auth::user()->id)
            ->where('project_id', $id)->first();

        if ($check) {
            $check->delete();

            return redirect()->back()->with('success', 'Berhasil menyimpan ke favorit');
        } else {
            $project = Project::find($id);
            $save = ProjectFavourite::create([
                'user_id' => Auth::user()->id,
                'project_id' => $project->id,
            ]);

            return redirect()->back()->with('success', 'Berhasil menyimpan ke favorit');
        }

    }
    public function favourite($payload)
    {
        $data = json_decode(base64_decode($payload));
        if ($data != null) {

            $check = ProjectFavourite::where('user_id', Auth::user()->id)
                ->where('project_id', $data->id)->first();
            if ($check == null) {
                $save = ProjectFavourite::create([
                    'user_id' => Auth::user()->id,
                    'project_id' => $data->id,
                ]);
            } else {
                $check->delete();
            }

            return redirect()->back();

        } else {
            abort(404);
        }
    }

    public function instantDonate($btoa)
    {
        $data = json_decode(base64_decode($btoa));

        if (!$data->donation_type || !$data->payment_type || !$data->payment_code || !$data->payment_name || !$data->donature_name || !$data->donature_phone || !$data->nominal ||
            $data->donation_type == null || $data->payment_type == null || $data->payment_code == null || $data->payment_name == null || $data->donature_name == null || $data->donature_phone == null || $data->nominal == null) {
            abort(404);
        }

        $referral = null;
        if ($data->referral_code) {
            $referral = Fundraiser::where('referral_code', $data->referral_code)
                ->first();
        }

        $project = (object) [
            'id' => 'INSTAN',
            'title' => "Donasi Instan",
            'slug' => null,
            'featured_path' => asset('assets/img/sedekah-icon.svg'),
        ];

        if ($data->payment_type == 'bank') {
            $unique = $this->getUnique();
        } else {
            $unique = 0;
        }

        $nominal = str_replace('Rp ', '', str_replace('.', '', $data->nominal));

        $post = [
            'project_id' => 0,
            'user_id' => Auth::check() ? Auth::user()->id : null,
            'nominal' => $nominal,
            'payment_method' => $data->payment_name,
            'donature_name' => $data->donature_name,
            'donature_email' => null,
            'donature_phone' => $data->donature_phone,
            'is_anonymous' => 0,
            'unique_code' => $unique,
            'additional_fee' => 0,
            'status' => 'pending',
            'payment_type' => $data->payment_type,
            'payment_code' => $data->payment_code,
            'total' => $nominal + $unique,
            'time_limit' => Carbon::now()->addDay(3)->toDateTimeString(),
            'fund_type' => $data->donation_type,
            'referral_id' => $referral ? $referral->user_id : null,
        ];

        if ($referral) {
            $referral->increment('transaction');
        }

        if ($data->payment_type == 'bank' || $data->payment_type == 'wallet') {
            $process = $this->processNonPG($post);
            return redirect($process);
        } else {
            return $this->processInstant($project, $post);
        }

        abort(404);
    }
}
