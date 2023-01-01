<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Qurban;
use App\Models\QurbanDetail;
use App\Models\QurbanPayment;
use App\Models\ProjectCategory;
use App\Models\Bank;
use Auth;
use Storage;

class QurbanController extends Controller

{
    public function index() {
        $qurbans = Qurban::latest()->paginate(5);

        return view('admin.qurban.index',compact('qurbans'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
  
    public function create() {
        return view('admin.qurban.form');
    }
  

    public function store(Request $request)
    {
        $rules = [
          'title' => 'required|string|min:4',
          'price' => 'required|integer|',
          'path_icon' => 'nullable|max:5000|mimes:png,jpg,jpeg',
        ];

        $file = $request->file('path_icon');

        $validation = $request->validate($rules);

		$filename = null;

		if($request->hasFile('path_icon')){
			$filename = $request->file('path_icon')->store('uploads/project/qurban');
        }
        
        $Qurban= Qurban::create([
            'title' => $request->title,
            'price' => str_replace('.', '', $request->price),
            'path_icon' => $filename,
        ]);

        return redirect('admin/qurban')
        ->with('success','Post created successfully.');
    }
  
    public function edit($id)
	{
		$data = Qurban::where('id', $id)
		->firstOrFail();

		return view('admin.qurban.form')->with([
            "data" => $data
		]);
	}

	public function update(Request $request, $id)
	{
		$data = Qurban::where('id', $id)
		->firstOrFail();

		$rules = [
			'title' => 'required|string|min:4',
			'price' => 'required|integer|min:20',
			'path_icon' => 'nullable|max:5000|mimes:png,jpg,jpeg',
		];
		
		$request->validate($rules);


		$filename = $data->path_icon;

		if($request->hasFile('path_icon')){
			if($data->path_icon != null){
				Storage::delete($data->path_icon);
			}
			$filename = $request->file('path_icon')->store('uploads/project/qurban');
		}
		
		$data->update([
			'title' => $request->title,
			'price' => $request->price,
			'path_icon' => $filename,
		]);

		return redirect('admin/qurban')->with([
			'success' => 'Berhasil Mengedit Program Zakat'
		]);
	}

    public function destroy($id)
    {
    	$data = Qurban::findOrFail($id);
    	if($data->featured != null){
    		Storage::delete($data->featured);
    	}

    	$data->delete();
    	return redirect('admin/qurban')->with([
    		'success' => 'Berhasil Menghapus Qurban'
    	]);
	}

	public function confirmation() {
		$datas = QurbanPayment::orderBy('created_at', 'ASC')
		->paginate(25);

		return view('admin.qurban.list_confirmation')->with([
			'datas' => $datas
		]);
	}

	public function proof($id) {
		$data = QurbanPayment::findOrFail($id);

		if($data->payment_type == 'bank'){
			$bankAccount = Bank::where('id', $data->payment_code)
			->first();

			$bank = [
				'name' => $bankAccount->bank_name,
				'icon' => asset('storage/'.$bankAccount->path_icon)
			];
		}else{
			$bank = [
				'name' => $data->payment_method,
				'icon' => asset($this->getIcon($data->payment_method))
			];
		}

		return view('admin.qurban.show')->with([
			'data' => $data,
			'bank' => $bank
		]);
	}
	public function verify($id, Request $request){
		$data = QurbanPayment::findOrFail($id);

		$data->update([
			'status' => 'paid',
		]);

		return redirect('admin/kurban_confirm')->with([
			'success' => 'Bukti Pembayaran Telah Diverifikasi'
		]);
	}

	public function reject($id, Request $request){
		$data = QurbanPayment::findOrFail($id);

		$data->update([
			'status' => 'rejected',
			'reject_reason' => $request->reject_reason
		]);

		return redirect('admin/kurban_confirm')->with([
			'error' => 'Bukti Pembayaran Telah Ditolak'
		]);
	}
}
