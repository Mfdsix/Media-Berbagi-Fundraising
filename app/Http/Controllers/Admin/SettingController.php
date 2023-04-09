<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentCredential;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1);

        //dd($setting);

        return view('admin.setting.index')->with([
            'data' => $setting,
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'gold_price' => 'required',
            'silver_price' => 'required',
        ]);
        $request->merge([
            'gold_price' => str_replace('.', '', $request->gold_price),
            'silver_price' => str_replace('.', '', $request->silver_price),
        ]);

        Setting::set($request->all());
        return redirect('admin/setting')->with([
            'success' => 'Berhadil Disimpan',
        ]);
    }

    public function googleAnalytics()
    {
        $setting = Setting::find(1);

        return view('admin.setting.google-analytics')->with([
            'data' => $setting,
        ]);
    }

    public function saveGoogleAnalytics(Request $request)
    {
        $request->validate([
            'value' => 'required',
        ]);

        $setting = Setting::find(1);
        $setting->update([
            'google_analytics' => $request->value,
        ]);

        return redirect("/admin/google-analytics");
    }

    //create public function facebookPixel
    public function facebookPixel()
    {
        $setting = Setting::find(1);

        return view('admin.setting.facebook-pixel')->with([
            'data' => $setting,
        ]);
    }

    // create public function saveFacebookPixel
    public function saveFacebookPixel(Request $request)
    {
        $request->validate([
            'value' => 'required',
        ]);

        $setting = Setting::find(1);
        $setting->update([
            'facebook_pixel' => $request->value,
        ]);

        return redirect("/admin/facebook-pixel");
    }

    public function googleFont()
    {
        $setting = Setting::find(1);

        return view('admin.setting.google-font')->with([
            'data' => $setting,
        ]);
    }

    public function saveGoogleFont(Request $request)
    {
        $request->validate([
            'value' => 'required',
        ]);

        $setting = Setting::find(1);
        $setting->update([
            'font' => $request->value,
        ]);

        return redirect("/admin/google-font");
    }

    public function paymentGateway()
    {
        $setting = Setting::find(1);
        $data = PaymentCredential::pluck('value', 'key');

        return view('admin.setting.payment-gateway')->with([
            'setting' => $setting,
            'datas' => $data,
        ]);
    }

    public function savePaymentGateway(Request $request)
    {
        $prefix = str_replace('base64:', '', env('APP_KEY'));
        // Redis::del($prefix.'payment_channel');

        $request->validate([
            'vendor' => 'required',
        ]);

        $setting = Setting::find(1);
        $setting->update([
            'payment_gateway_vendor' => $request->vendor,
        ]);

        $credentials = $request->except(["vendor", "_token"]);
        foreach ($credentials as $k => $v) {
            if ($k != null && $v != null) {
                $check = PaymentCredential::where('key', $k)
                    ->first();

                if ($check) {
                    $check->update([
                        'value' => $v,
                    ]);
                } else {
                    PaymentCredential::create([
                        'type' => $request->vendor,
                        'key' => $k,
                        'value' => $v,
                    ]);
                }
            }
        }

        return redirect("/admin/payment-gateway");
    }
}
