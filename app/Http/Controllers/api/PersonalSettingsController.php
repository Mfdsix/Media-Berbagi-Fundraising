<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PersonalSettings;

class PersonalSettingsController extends Controller
{
    public function index()
    {
        $settings = PersonalSettings::where('user_id', auth()->user()->id)->first();
        return $this->success($settings);
    }
    public function save(Request $request)
    {
        $current = PersonalSettings::where('user_id', auth()->user()->id)->first();
        if ($current == null) {
            $settings = PersonalSettings::create([
                'user_id' => auth()->user()->id,
                'contact_whatsapp' => $request->contact_whatsapp ?? 0,
                'is_anonymous' => $request->is_anonymous ?? 0,
            ]);
            return $this->success($settings);
        } else {
            $current->update([
                'contact_whatsapp' => $request->contact_whatsapp ?? 0,
                'is_anonymous' => $request->is_anonymous ?? 0,
            ]);
            return $this->success($current);
        }
    }
}
