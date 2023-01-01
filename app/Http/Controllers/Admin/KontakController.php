<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funding;

class KontakController extends Controller
{
    public function index()
    {
        $funding = Funding::where('donature_phone', '!=', null)
            ->groupBy('donature_phone', 'donature_email', 'donature_name')
            ->selectRaw('donature_phone, donature_email, donature_name, count(id) as donated, sum(nominal) as nominal_donated')
            ->where('status', 'paid')
            ->paginate(25);

        return view('admin.kontak.index')->with([
            'title' => 'Export Kontak',
            'datas' => $funding,
        ]);
    }

    public function export()
    {
        $funding = Funding::where('donature_phone', '!=', null)
            ->groupBy('donature_phone', 'donature_email', 'donature_name')
            ->selectRaw('donature_phone, donature_email, donature_name, count(id) as donated')
            ->get();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="kontak_per_' . Date('dmYHis') . '.csv"');

        $data = [];
        $data[] = 'First Name,Last Name,Email Address,Mobile Phone,Company';

        foreach ($funding as $key => $value) {
            $explode = explode(' ', $value->donature_name);
            if (count($explode) == 1) {
                $first_name = $explode[0];
                $last_name = "";
            } else {
                $first_name = $explode[0];
                unset($explode[0]);
                $last_name = implode(' ', $explode);
            }
            $data[] = "$first_name, $last_name, $value->donature_email, $value->donature_phone, Donatur";
        }

        $fp = fopen('php://output', 'wb');
        foreach ($data as $key => $line) {
            $val = explode(",", $line);
            fputcsv($fp, $val);
        }
        fclose($fp);
    }
}
