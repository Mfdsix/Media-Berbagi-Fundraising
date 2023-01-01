<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Setting;
use Storage;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::get('is_payment_gateway');
    	$datas = Bank::all();
    	return view('admin.bank.index')->with([
    		'datas' => $datas,
            'setting' => $setting,
    	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('admin.bank.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$request->validate([
    		'bank_name' => 'required|string',
    		'bank_username' => 'required|string',
    		'bank_number' => 'required',
    		'bank_code' => 'required',
    		'icon' => 'required|max:500|mimes:png,jpg,jpeg'
    	]);

    	$filename = null;

    	if($request->hasFile('icon')){
    		$filename = $request->file('icon')->store('uploads/bank');
    	}

    	Bank::create([
    		'bank_name' => $request->bank_name,
    		'bank_username' => $request->bank_username,
    		'bank_number' => $request->bank_number,
    		'bank_code' => $request->bank_code,
    		'path_icon' => $filename
    	]);

    	return redirect('admin/bank')->with([
    		'success' => 'Berhasil Menambahkan Bank'
    	]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$data = Bank::findOrFail($id);
    	return view('admin.bank.form')->with([
    		'data' => $data
    	]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$data = Bank::findOrFail($id);

    	$request->validate([
    		'bank_name' => 'required|string',
    		'bank_username' => 'required|string',
    		'bank_number' => 'required',
    		'bank_code' => 'required',
    		'icon' => 'nullable|max:500|mimes:png,jpg,jpeg'
    	]);

    	$filename = $data->path_icon;

    	if($request->hasFile('icon')){
    		if($data->path_icon != null){
    			Storage::delete($data->path_icon);
    		}
    		$filename = $request->file('icon')->store('uploads/bank');
    	}

    	$data->update([
    		'bank_name' => $request->bank_name,
    		'bank_username' => $request->bank_username,
    		'bank_number' => $request->bank_number,
    		'bank_code' => $request->bank_code,
    		'path_icon' => $filename
    	]);

    	return redirect('admin/bank')->with([
    		'success' => 'Berhasil Mengedit Bank'
    	]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$data = Bank::findOrFail($id);
    	if($data->path_icon != null){
    		Storage::delete($data->path_icon);
    	}

    	$data->delete();
    	return redirect('admin/bank')->with([
    		'success' => 'Berhasil Menghapus Bank'
    	]);
    }

    public function activate()
    {
        $status = Setting::get('is_payment_gateway');

        if($status != null && $status == 1){
            Setting::set(['is_payment_gateway' => 0]);
        }else{
            Setting::set(['is_payment_gateway' => 1]);
        }

        return redirect('admin/bank');
    }
}
