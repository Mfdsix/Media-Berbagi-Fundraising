<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funding;
use App\Models\Project;
use App\Models\Bank;

class InvoiceController extends Controller
{
    public function view() {
        $data = [];
        return view('invoice.index', $data);
    }
    public function show($id) {
        if(strpos($id,"INV-") > -1) {
            $data = Funding::where('bill_no', $id)->firstOrFail();
        }else{
            $data = Funding::where('id', $id)
                ->firstOrFail();
        }

        if($data->project == null) {
            $data->project = new Project();
            $data->project->title = "Program Instant ".$data->fund_type;
        }else{
            $data->project = $data->project;
        }

        if($data->payment_type == "bank") {
            $data->bank = Bank::where('bank_name', $data->payment_method)->first();
        }
        
        return view('invoice.index', compact('data'));
    }
}
