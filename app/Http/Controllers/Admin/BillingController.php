<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use funding
use App\Models\Funding;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class BillingController extends Controller
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

    // index
    public function index()
    {
        $datas = Funding::where('status','paid')
        ->where("payment_method", "<>", "Admin")
        ->where("payment_method", "<>", "Gerai")
        // wheremonth less than 5
        // ->whereMonth('created_at', '<', 6)
        ->get();
        $total = 0;

        // foreach funding per month
        $funding_report = [];
        foreach ($datas as $key => $value) {
            $report = new \stdClass();
            $report->month = date('M', strtotime($value->created_at));
            $report->year = date('Y', strtotime($value->created_at));
            $report->total = $value->total;
            $report->type = $value->fund_type;
            $report->project = $value->project;

            //if funding report exist
            if(isset($funding_report[$report->month])){
                $funding_report[$report->month]->total += $report->total;
            }else{
                $funding_report[$report->month] = $report;
            }
            $total += $value->total;
        }

        $datas = $funding_report;
        $total = $total * 1/100;
        $bank_number = 7885555448;

        // replace last 3 digit total to random
        $rand = rand(100, 999);
        $total = round($total);
        $totalPay = substr_replace($total, $rand, -3);

        $billing = $this->billing();

        return view('admin.billing.index')->with([
            'datas' => $datas,
            'total' => $total,
            'bank_number' => $bank_number,
            'totalPay' => $totalPay,
            'rand' => $rand,
            'billing' => $billing,
        ]);
    }
    // payment
    public function payment(Request $request)
    {
        // validate nominal, proof_image
        $this->validate($request, [
            'nominal' => 'required|numeric',
            'proof_image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // post to localhost:8000/api/billing/payment

       try{
            // guzzle post
            $client = new Client();
            $response = $client->post($this->host.'/api/billing/payment', [
                'headers' => [
                    'Accept' => 'application/json',
                    // content type multipart/form-data
                    // 'Content-Type' => 'multipart/form-data',
                    'X-MediaBerbagi-Identifier' => envdb('MB_ACCESS_KEY'),
                    'X-MediaBerbagi-Mode' => 'production',
                ],
                // post multipart nominal and proof_name
                RequestOptions::MULTIPART => [
                    [
                        'name' => 'nominal',
                        'contents' => $request->nominal,
                    ],
                    [
                        'name' => 'proof_image',
                        'contents' => fopen($request->proof_image->getRealPath(), 'r'),
                        'filename' => $request->proof_image->getClientOriginalName(),
                    ],
                ],
                'http_errors' => false,
            ]);
            
            // if status error
            if($response->getStatusCode() == 200) {
                return redirect()->back()->with('success', 'Payment Success');
            }else{
                return redirect()->back()->with('error', 'Payment Failed');
            }
       }catch (Exception $e) {
            return redirect()->back()->with('error', 'Payment Failed');
       }
    }
}
