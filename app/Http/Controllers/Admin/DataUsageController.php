<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StorageUsage;

class DataUsageController extends Controller
{
    public function index()
    {
        $usages = StorageUsage::orderBy('created_at', 'DESC')
            ->limit(7)
            ->get();
        $totalUsage = 0;
        $usageHistories = [
            'date' => [],
            'database' => [],
            'disk' => [],
        ];

        for ($i = count($usages) - 1; $i >= 0; $i--) {
            $v = $usages[$i];
            array_push($usageHistories['date'], date('d M', strtotime($v->created_at)));
            array_push($usageHistories['disk'], ceil($v->disk_usage / 1000000));
            array_push($usageHistories['database'], ceil($v->database_usage / 1000000));
            $totalUsage = $v->disk_usage + $v->database_usage;
        }

        return view('admin.data_usage.index')->with([
            'usageHistories' => $usageHistories,
            'totalUsage' => ceil($totalUsage / 1000000),
            'totalUsagePrecentage' => ceil($totalUsage / 1000000000 * 100),
        ]);
    }
}
