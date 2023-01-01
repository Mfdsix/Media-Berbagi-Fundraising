<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Update;
use App\Models\Project;
use App\Models\Funding;
use App\Models\Inbox;
use Auth;

class UpdateController extends Controller
{
	public function index(){
		$datas = Update::where('update_type', 0)
		->paginate(10);

		return view('admin.update.index')->with([
			'datas' => $datas
		]);
	}

	public function create(){
		$projects = Project::where('status', 1)
		->get();

		return view('admin.update.form')->with([
			'projects' => $projects
		]);	
	}

	public function store(Request $request){
		$request->validate([
			'project_id' => 'required',
			'title' => 'required',
			'content' => 'required|string|min:20'
		]);

		$update = Update::create([
			'project_id' => $request->project_id,
			'content' => $request->content,
			'title' => $request->title,
			'update_type' => 0,
			'user_id' => Auth::user()->id,
		]);

		$users = Funding::where('project_id', $request->project_id)
		->where('status', 'paid')
		->where('user_id', '!=', null)
		->distinct()
		->get(['user_id'])
		->pluck('user_id');

		if(count($users) > 0){
			$notifInsert = [];
			foreach ($users as $key => $value) {
				$notifInsert[] = [
					'user_id' => $value,
					'title' => $request->title,
					'content' => $request->content,
					'project_id' => $request->project_id,
					'target_id' => $update->id,
					'status' => 0,
					'created_at' => Date('Y-m-d H:i:s')
				];
			}
			$createInbox = Inbox::insert($notifInsert);
		}

		return redirect('admin/update')->with([
			'success' => 'Update Berhasil Ditambahkan'
		]);
	}

	public function edit($id)
	{
		$update = Update::findOrFail($id);
		$projects = Project::where('status', 1)
		->get();

		return view('admin.update.form')->with([
			'data' => $update,
			'projects' => $projects,
		]);
	}

	public function update($id, Request $request)
	{
		$update = Update::findOrFail($id);
		$request->validate([
			'title' => 'required',
			'content' => 'required'
		]);

		$update->update([
			'title' => $request->title,
			'content' => $request->content
		]);

		return redirect('admin/update')->with([
			'success' => 'Update Berhasil Diedit'
		]);
	}

	public function destroy($id)
	{
		$update = Update::findOrFail($id);
		$update->delete();

		return redirect('admin/update')->with([
			'success' => 'Update Berhasil Dihapus'
		]);
	}
}
