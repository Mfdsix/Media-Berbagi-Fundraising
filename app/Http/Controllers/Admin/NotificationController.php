<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $setting = Setting::whereIn('key', ['donation_reminder', 'donation_thanks'])
            ->pluck('value', 'key');

        return view('admin.notification.index')->with([
            'data' => $setting,
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'donation_reminder' => 'required',
            'donation_thanks' => 'required',
        ]);
        
        $request->merge([
            'donation_reminder' => str_replace('.', '', $request->donation_reminder),
            'donation_thanks' => str_replace('.', '', $request->donation_thanks),
        ]);

        Setting::set($request->all());
        return redirect('admin/notification')->with([
            'success' => 'Berhadil Disimpan',
        ]);
    }
}
