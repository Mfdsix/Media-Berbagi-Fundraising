<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\PaymentController;
use App\Models\Activity;
use App\Models\Bank;
use App\Models\Blog;
use App\Models\Funding;
use App\Models\InstantProgram;
use App\Models\Partner;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Slider;
use Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redis;
use DB;
use Carbon\Carbon;

class HomeController extends PaymentController
{
    public function index(Request $request)
    {
        // $start = microtime(true);

        // get all payment data
        $payments = CacheRedis('payment_channel', function() {
            $payments = $this->getPaymentMethods();
            return $payments;
        }, true, true);

        // get all bank data
        $banks = CacheRedis('banks', function() {
            return Bank::all();
        });

        foreach ($banks as $key => $value) {
            $value->request_code = 'bank-' . $value->id . '-' . $value->bank_name;
            $value->fee = 0;
        }
        $payments['bk'] = $banks;

        // get all  blogs
        $blogs = CacheRedis('blogs', function() {
            return Blog::orderBy('id', 'DESC')
            ->limit(5)
            ->get();
        });

        // get all categories
        $categories = CacheRedis('project_categories', function() {
            return ProjectCategory::orderBy('order_number')
            ->get();
        });

        // get all partner
        $partners = CacheRedis('partners', function() {
            return Partner::get();
        });

        // get all slider
        $sliders = CacheRedis('sliders', function() {
            return Slider::get();
        });

        // get all activities
        $activities = CacheRedis('activities', function() {
            return Activity::orderBy('id', 'DESC')
            ->limit(5)
            ->get();
        });

        // get project
        // $projects = CacheRedis('projects', function(){
            $projects = Project::where(function ($q) {
                $q->where('date_target', null)
                    ->orWhere('date_target', '>=', now());
            })
            ->with(['category'])
            ->where('status', 1)
            ->where('is_hidden', 0)
            ->orderBy('order_number', 'ASC')
            ->limit(5)
            ->get();
        // });

        // get project new release
        // $newReleases = CacheRedis('projects', function() {
            $newReleases = Project::where(function ($q) {
                $q->where('date_target', null)
                    ->orWhere('date_target', '>=', now());
            })
            ->with(['category'])
            ->where('status', 1)
            ->where('is_hidden', 0)
            ->orderBy('ID', 'DESC')
            ->limit(5)
            ->get();
        // });

        // $time = microtime(true) - $start;
        // dd($time);

        $today = Date('Y-m-d'); // get today

        foreach ($projects as $key => $value) {
            $donations = 0;
            $funding = Funding::where('status', 'paid')->where('project_id', $value->id)->get();
            foreach ($funding as $k => $v) {
                $donations = $donations + $v->nominal;
            }
            $value->slug = ($value->slug == "") ? "/" : $value->slug;
            $value->is_unlimited = false;
            if ($value->date_target == null && $value->nominal_target == null) {
                $value->date_count = '∞';
                $value->date_target = '∞';
                $value->percentage = 100;
                $value->is_unlimited = true;
            } else {
                $value->date_count = date_diff(date_create($value->date_target), date_create($today))->days;
                // $value->date_target = $this->date_to_idn($value->date_target);
                // parse carbon date_target to diffforhumans
                $value->date_target = Carbon::parse($value->date_target)->diffForHumans();
                $value->percentage = $donations / $value->nominal_target * 100;
            }

            // $donations = $this->countDonation($value->id);
            $value->donations = $donations;
            // $value->donaturs = $this->countPeopleDonation($value->id);
        }

        foreach ($newReleases as $key => $value) {
            $donations = 0;
            $funding = Funding::where('status', 'paid')->where('project_id', $value->id)->get();
            foreach ($funding as $k => $v) {
                $donations = $donations + $v->nominal;
            }
            $value->slug = ($value->slug == "") ? "/" : $value->slug;
            $value->is_unlimited = false;
            if ($value->date_target == null && $value->nominal_target == null) {
                $value->date_count = '∞';
                $value->date_target = '∞';
                $value->percentage = 100;
                $value->is_unlimited = true;
            } else {
                $value->date_count = date_diff(date_create($value->date_target), date_create($today))->days;
                $value->date_target = $this->date_to_idn($value->date_target);
                $value->percentage = $donations / $value->nominal_target * 100;
            }

            // $donations = $this->countDonation($value->id);
            $value->donations = $donations;
            // $value->donaturs = $this->countPeopleDonation($value->id);
        }
        $user = Auth::user();

        $params = ['sedekah', 'wakaf', 'zakat'];
        $instant = [];

        foreach ($params as $k => $v) {
            $instant[$v] = InstantProgram::where('program', $v)
                ->first();
        }

        if($this->theme) {
            $theme = $this->theme->theme;
            if(property_exists($this->theme->script, 'index')) {
                $script = $this->theme->script->index;
                $theme = "themes/".$theme.'/'.$script;
                $theme = str_replace(".blade.php", "", $theme);
            }else{
                $theme = "index";
            }
        }else{
            $theme = "index";
        }

        return view($theme)->with([
            'payments' => $payments,
            'sliders' => $sliders,
            'partners' => $partners,
            'activities' => $activities,
            'blogs' => $blogs,
            'projects' => $projects,
            'newReleases' => $newReleases,
            'categories' => $categories,
            'datas' => $blogs,
            'user' => $user,
            'instant' => $instant,
        ]);
    }

    public function countDonation($id, $referral = null){
        $donations = DB::table('fundings')
        ->join('projects','fundings.project_id', 'projects.id')
        ->when($referral, function ($q) use ($referral) {
            return $q->where('fundings.referral_id', $referral);
        })
        ->where('fundings.status', 'paid')
        ->where('projects.id', $id)
        ->selectRaw('SUM(fundings.nominal) as donation')
        ->pluck('fundings.donation')
        ->first();

        if ($donations == null) {
            return 0;
        } else {
            return $donations;
        }
    }

    public function perType($type)
    {
        $today = Date('Y-m-d');
        $projects = Project::leftJoin('project_categories', 'project_categories.id', '=', 'projects.category_id')
            ->where('type', $type)
            ->select('projects.*', 'project_categories.category as category_name')
            ->get();

        foreach ($projects as $key => $value) {
            if ($value->date_target == null && $value->nominal_target == null) {
                $value->date_count = '∞';
                $value->percentage = 100;
            } else {
                $value->date_count = date_diff(date_create($value->date_target), date_create($today))->days;
                $value->percentage = $donations / $value->nominal_target * 100;
            }
            $donations = $value->countDonation();
            $value->donations = "Rp " . str_replace(',', '.', number_format($donations));
            if ($value->path_featured == null) {
                $value->path_featured = asset('images/project.jpg');
            } else {
                $value->path_featured = asset('storage/' . $value->path_featured);
            }
        }

        return response()->json($projects);
    }

    public function search(Request $request)
    {
        $today = Date('Y-m-d');
        $query = $request->q;

        //dd($query);
        $projects = Project::where('status', 1)
            ->where('title', 'LIKE', "%" . $query . "%")
            ->where('category_id', '!=', 0)
            ->paginate(4);

        //dd($projects);

        foreach ($projects as $key => $value) {

            if ($value->date_target == null && $value->nominal_target == null) {
                $value->is_unlimited = true;
                $value->date_count = '∞';
                $value->date_target = '∞';
                $value->percentage = 100;
                $value->is_unlimited = true;
            } else {
                $value->date_count = date_diff(date_create($value->date_target), date_create($today))->days;
                $donations = $value->countDonation();

                $value->date_target = $this->date_to_idn($value->date_target);
                $value->percentage = $donations / $value->nominal_target * 100;
                $value->donations = "Rp " . str_replace(',', '.', number_format($donations));
            }
            $donations = $value->countDonation();
            $value->donations = "Rp " . str_replace(',', '.', number_format($donations));
            $value->donaturs = $value->countPeopleDonation();

            $slug_url = $value->id . '-' . preg_replace('/[^a-zA-Z0-9_.-]/', '', str_replace(' ', '-', $value->title));
            $value->url = $slug_url;
        }
        return view('front.project.search')->with([
            'projects' => $projects,
        ]);
    }

}
