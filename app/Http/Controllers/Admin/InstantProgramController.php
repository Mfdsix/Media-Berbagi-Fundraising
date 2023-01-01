<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\InstantProgram;
use Illuminate\Http\Request;

class InstantProgramController extends Controller
{
    public function index()
    {
        $params = [
            ['Sedekah', 'sedekah'],
            ['Wakaf', 'wakaf'],
            ['Zakat', 'zakat'],
        ];
        $instant = [];

        foreach ($params as $k => $v) {
            array_push($instant, [
                'key' => $v[1],
                'title' => $v[0],
                'donations' => Funding::where('project_id', 0)
                    ->where('fund_type', $v[1])
                    ->where('status', 'paid')
                    ->sum('nominal'),
                'is_active' => InstantProgram::where('program', $v[1])
                    ->pluck('is_active')
                    ->first(),
                'instant' => InstantProgram::where('program', $v[1])
                    ->first(),
            ]);
        }

        return view('admin.instant.index')->with([
            'datas' => $instant,
        ]);
    }

    public function switch ($id, Request $request) {
        $instant = InstantProgram::where('program', $id)
            ->firstOrFail();

        $instant->update([
            'is_active' => $instant->is_active == 1 ? 0 : 1,
        ]);

        return redirect()->back();
    }
    public function custom_nominal(Request $request) {
        $request->validate([
            'custom_nominal' => 'required|array',
            'custom_nominal.*' => 'required|integer|min:10000',
            'instant' => 'required',
        ]);

        $instant = InstantProgram::where('program', $request->instant)
                ->firstOrFail();
        $instant->update([
            'custom_nominal' => json_encode($request->custom_nominal),
        ]);

        return redirect()->back();
    }
}
