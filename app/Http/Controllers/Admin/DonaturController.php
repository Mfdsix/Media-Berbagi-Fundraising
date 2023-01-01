<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funding;

class DonaturController extends Controller
{
    public function byStatus($status = null)
    {

        $title = "Semua Donatur";
        if ($status == "success") {
            $title = "Donatur Sukses";
        } elseif ($status == "fail") {
            $title = "Donatur Gagal";
        }

        $donature = Funding::when($status, function ($q) use ($status) {
            if ($status == "success") {
                return $q->where('status', "paid");
            } elseif ($status == "fail") {
                return $q->where('status', "canceled")
                    ->orWhere(function ($q) {
                        return $q->where('status', '!=', 'paid')
                            ->where('time_limit', '>=', date('Y-m-d H:i:s'));
                    });
            }
            return $q;
        })
        // ->where('created_at', 'LIKE', date('Y-m') . '%')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.donatur.by-status')->with([
            'title' => $title,
            'donaturs' => $donature,
        ]);
    }

    public function export($status)
    {
        $funding = Funding::when($status, function ($q) use ($status) {
            if ($status == "success") {
                return $q->where('status', "paid");
            } elseif ($status == "fail") {
                return $q->where('status', "canceled")
                    ->orWhere(function ($q) {
                        return $q->where('status', '!=', 'paid')
                            ->where('time_limit', '>=', date('Y-m-d H:i:s'));
                    });
            }
            return $q;
        })
            ->orderBy('status', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->get();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="kontak_per_' . Date('dmYHis') . '.csv"');

        $data = [];
        $data[] = 'First Name,Last Name,Email Address,Mobile Phone,Nominal,Status';

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
            if ($value->status == "paid") {
                $value->status = "sukses";
            } elseif (($value->status == "pending" && $value->time_limit > now()) || $value->status == "canceled") {
                $value->status = "gagal";
            }

            $data[] = "$first_name,$last_name,$value->donature_email,$value->donature_phone,$value->nominal,$value->status";
        }

        $fp = fopen('php://output', 'wb');
        foreach ($data as $key => $line) {
            $val = explode(",", $line);
            fputcsv($fp, $val);
        }
        fclose($fp);
    }
}
