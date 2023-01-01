<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\Fundraiser;
use App\Models\FundraiserTransaction;

class FundraiserController extends Controller
{
    public function index()
    {
        $datas = Fundraiser::where('is_confirmed', 1)
            ->orderBy('fullname', 'ASC')
            ->get();
        
        return view('admin.fundraiser.index')->with([
            'datas' => $datas,
        ]);
    }

    public function leaderboard()
    {
        $fundraisers = Fundraiser::all();

        // foreach fundraisers
        foreach ($fundraisers as $fundraiser) {
            $fundraiser->collecteds = $fundraiser->collecteds();
        }

        // sort fundraisers by collecteds
        $fundraisers = $fundraisers->sortByDesc('collecteds');

        return view('admin.fundraiser.leaderboard')->with([
            'fundraiser' => $fundraisers,
        ]);
    }

    public function export($type)
    {
        $fundraisers = Fundraiser::orderBy('collected', 'DESC')
            ->get();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header('Content-Disposition: attachment; filename="fundraiser_per_' . Date('dmYHis') . '.xls"');

        // $data = [];
        // $data[] = '#,Nama,Klik,Transaksi,Terkumpul';

        // foreach ($fundraisers as $key => $value) {
        //     $index = $key + 1;
        //     $data[] = "$index,$value->fullname,$value->clicks,$value->transaction,$value->collected";
        // }

         foreach ($fundraisers as $key => $value) {
            $value->collecteds = $value->collecteds();
        }

        $fundraisers = $fundraisers->sortByDesc('collecteds');

        // $fp = fopen('php://output', 'wb');
        // foreach ($data as $key => $line) {
        //     $val = explode(",", $line);
        //     fputcsv($fp, $val);
        // }
        // fclose($fp);

        $html = '<table border="1">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Klik</th>
                <th scope="col">Transaksi</th>
                <th scope="col">Terkumpul</th>
            </tr>
        </thead>
        <tbody>';
            $i = 1;
            foreach($fundraisers as $k => $v) {
           $html .= ' <tr>
                <td>'.$i++.'</td>
                <td>'.$v->fullname.'</td>
                <td>'.$v->clicks.'</td>
                <td>'.$v->transactions().'</td>
                <td>'.$v->collecteds().'</td>
            </tr>';
            }
        $html .= '</tbody>
    </table>';

        return $html;
    }

    public function transaction()
    {
        $transaction = FundraiserTransaction::whereIn('type', ['withdraw', 'donation'])
            ->orderBy('created_at', 'DESC')
            ->paginate(25);

        return view('admin.fundraiser.transaction')->with([
            'datas' => $transaction,
        ]);
    }

    public function showTransaction($id)
    {
        $data = FundraiserTransaction::where('id', $id)
            ->firstOrFail();

        return view('admin.fundraiser.transaction_show')->with([
            'data' => $data,
        ]);
    }
    // verify by id
    public function verify($id)
    {
        $data = FundraiserTransaction::where('id', $id)
            ->firstOrFail();

        $data->update([
            'status' => 'success',
        ]);

        return redirect()->back()->with('success', 'Berhasil verifikasi transaksi');
    }
    // reject by id
    public function reject($id)
    {
        $data = FundraiserTransaction::where('id', $id)
            ->firstOrFail();

        $data->update([
            'status' => 'canceled',
        ]);

        // get fundraiser
        $fundraiser = Fundraiser::where('id', $data->fundraiser_id)
            ->firstOrFail();

        $fundraiser->update([
            'commissions' => $fundraiser->commissions + $data->amount,
        ]);

        return redirect()->back()->with('success', 'Berhasil menolak transaksi');
    }
}
