<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\Project;
use App\Models\Setting;
use App\Config;
use App\Models\StorageUsage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class DashboardController extends Controller
{
    public $host = "https://mediaberbagi.id";

    public function billing() {
        try{

            $client = new Client();
            $response = $client->get($this->host.'/api/billing/payment', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'X-MediaBerbagi-Identifier' => envdb('MB_ACCESS_KEY'),
                    'X-MediaBerbagi-Mode' => 'production',
                ],
                // RequestOptions::JSON => $data,
                'http_errors' => false,
            ]);
            $json = $response->getBody()->getContents();

            if($json == '["unauthorized"]') { 
                return 0;
            }

            $json = json_decode($json);

            if($json->data == null) {
                return 0;
            }else{
               return $json->data->status;
            }

        } catch (Exception $e) {
            echo "failed - pre-execution\n";
        }
    }
    public function getBilling() {
        $datas = Funding::all();
        $total = 0;
        foreach ($datas as $key => $value) {
            $total += $value->total;
        }

        $total = $total * 1/100;
        return $total;
    }
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $billing = $this->billing();
        $totalBilling = $this->getBilling();

        $projects = Project::get()->count();
        $donatur_today = Funding::whereDate('created_at', Carbon::today())
            ->where('status', 'paid')
            ->get()
            ->count();
        $donatur_monthly = Funding::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->where('status', 'paid')
            ->get()
            ->count();
        $transaction_today = Funding::whereDate('created_at', Carbon::today())
            ->where('status', 'paid')
            ->get()
            ->pluck('total')
            ->sum();
        $transaction_today = $this->number($transaction_today, true);
        $transaction_monthly = Funding::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->where('status', 'paid')
            ->get()
            ->pluck('total')
            ->sum();
        $transaction_monthly = $this->number($transaction_monthly, true);
        $donation_today = Funding::whereDate('created_at', Carbon::today())
            ->where('status', 'paid')
            ->get()
            ->pluck('nominal')
            ->sum();
        $donation_today = $this->number($donation_today, true);
        $donation_monthly = Funding::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->where('status', 'paid')
            ->get()
            ->pluck('nominal')
            ->sum();
        $donation_monthly = $this->number($donation_monthly, true);

        $total_waiting = Funding::where('status', 'pending')
            ->get()
            ->count();

        $sum_waiting = Funding::where('status', 'pending')
            ->get()
            ->pluck('nominal')
            ->sum();
        $sum_waiting = $this->number($sum_waiting, true);

        // splitted payment
        $manual_donation = Funding::where('status', 'paid')
            ->where('is_admin', 1)
            ->pluck('nominal')
            ->sum();
        $manual_donation = $this->number($manual_donation, true);

        $automated_donation = Funding::where('status', 'paid')
            ->where('is_admin', "!=", 1)
            ->pluck('nominal')
            ->sum();
        $automated_donation = $this->number($automated_donation, true);

        $datas = Funding::latest()->paginate(25);

        $last7Days = [
            'dates' => [],
            'donation' => [],
        ];
        for ($i = 7; $i > 0; $i--) {
            $day = Carbon::now()->subDays($i);

            array_push($last7Days['dates'], $day->format('d-m'));
            array_push($last7Days['donation'], Funding::whereDate('created_at', $day->toDateString())
                    ->selectRaw('DATE(created_at) as date ,SUM(nominal) as nominal_donated')
                    ->groupBy('date')
                    ->where('status', 'paid')
                    ->pluck('nominal_donated')
                    ->first() ?? 0);
        }

        $month = date('Y-m');
        $last1Month = Funding::where('created_at', 'LIKE', $month . '%')
            ->selectRaw('DATE(created_at) as date ,SUM(nominal) as nominal_donated')
            ->groupBy('date')
            ->where('status', 'paid')
            ->pluck('nominal_donated', 'date');

        $usages = StorageUsage::orderBy('created_at', 'DESC')
            ->limit(7)
            ->get();
        $totalUsage = 0;

        for ($i = count($usages) - 1; $i >= 0; $i--) {
            $v = $usages[$i];
            $totalUsage = $v->disk_usage + $v->database_usage;
        }

        $current = new Process('git ls-remote --tags --heads --sort="v:refname" https://yudono:githubdono25@gitlab.com/mediaberbagi/mediaberbagi-si | tail -n1 | sed \'s/.*\///; s/\^{}//\'');
        $current->run();
        if (!$current->isSuccessful()) {
            // throw new ProcessFailedException($current);
        }
        $current = $current->getOutput();

        // if this month is may
        $month = Carbon::now()->format('m');
        if($month == 5) {
            $lastMonth = true;
        }else{
            $lastMonth = false;
        }

        return view('admin.dashboard', compact('lastMonth','totalBilling','billing','projects', 'donatur_today', 'donatur_monthly', 'transaction_today', 'transaction_monthly', 'donation_today', 'donation_monthly', 'total_waiting', 'sum_waiting', 'manual_donation', 'automated_donation', 'datas', 'current'))
            ->with([
                'last7Days' => $last7Days,
                'last1Month' => $last1Month,
                'totalUsage' => ceil($totalUsage / 1000000),
                'totalUsagePrecentage' => ceil($totalUsage / 1000000000 * 100),
            ]);
    }

    public function getTransaction()
    {
        $transactions = Funding::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('status', 'pending')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('d'); // grouping by day
            });

        $total = [];
        foreach ($transactions as $k => $v) {
            $total[$k . ' ' . date("M")] = $v->pluck('total')->sum();
        }
        return $this->success($total);
    }

    public function getWaiting()
    {
        $transactions = Funding::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('status', 'pending')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('d'); // grouping by day
            });

        $total = [];
        foreach ($transactions as $k => $v) {
            $total[$k . ' ' . date("M")] = $v->count();
        }
        return $this->success($total);
    }

    public function changeColor(Request $request)
    {

        $setting = Setting::find(1);
        // $filename = public_path() . "/assets/css/variable.css";
        // $contents = file_get_contents($filename);
        // dd($setting);

        // $new_contents = ":root{
        //     --primary:" . $request->primary . ";
        // \t--secondary:" . $request->secondary . ";
        // \t--text-primary:" . $request->primary . ";
        //     --danger: " . $request->danger . ";
        //     --trans-secondary: " . $request->trans_primary . ";
        // \t--trans-primary: " . $request->trans_secondary . ";
        // }";
        // file_put_contents($filename, $new_contents);

        $setting->update([
            'primary' => $request->primary,
            'secondary' => $request->secondary,
            'danger' => $request->danger,
            'trans_primary' => $request->trans_primary,
            'trans_secondary' => $request->trans_secondary,
        ]);

        return back();
    }

    public function changeLogos(Request $request)
    {
        $setting = Setting::find(1);
        $config = Config::first();

        $request->validate([
            'name' => 'required|string',
            'logo' => 'max:500|mimes:png,jpg,jpeg',
            'icon' => 'max:500|mimes:png,jpg,jpeg',
        ]);

        if ($request->hasFile('logo')) {
            $filename = $request->file('logo')->store('uploads/company_profile');
        }else{
            $filename = $setting->path_logo;
        }

        if ($request->hasFile('icon')) {
            $fileicon = $request->file('icon')->store('uploads/company_profile');
        }else{
            $fileicon = $setting->path_icon;
        }

        $setting->update([
            'path_icon' => $fileicon,
            'path_logo' => $filename,
            'title' => $request->name,
        ]);

        $config->update(["APP_NAME" => $request->name]);

        return back();
    }
}
