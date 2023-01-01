<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Storage;

class ActivityController extends Controller
{
    public function index()
    {
        $datas = Activity::orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('admin.activity.index')->with([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        return view('admin.activity.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:6',
            'photo' => 'required|max:5000|mimes:png,jpg,jpeg',
            'link' => 'required',
            'content' => 'required',
            'direct_link' => 'nullable|url',
        ]);

        $filename = null;
        if ($request->hasFile('photo')) {
            $filename = $request->file('photo')->store('uploads/activity');
        }

        Activity::create([
            'title' => $request->title,
            'path' => $filename,
            'content' => $request->content,
            'link' => $request->link,
            'direct_link' => $request->direct_link,
        ]);

        return redirect('admin/activity')->with([
            'success' => 'Berhasil Menambahkan Kegiatan',
        ]);
    }

    public function edit($id)
    {
        $data = Activity::findOrFail($id);
        return view('admin.activity.form')->with([
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Activity::findOrFail($id);

        $request->validate([
            'title' => 'required|min:6',
            'photo' => 'nullable|max:5000|mimes:png,jpg,jpeg',
            'link' => 'required',
            'content' => 'required',
            'direct_link' => 'nullable|url|max:191',
        ]);

        $filename = $data->path;

        if ($request->hasFile('photo')) {
            if ($data->path != null) {
                Storage::delete($data->path);
            }
            $filename = $request->file('photo')->store('uploads/activity');
        }

        $data->update([
            'title' => $request->title,
            'path' => $filename,
            'content' => $request->content,
            'link' => $request->link,
            'direct_link' => $request->direct_link,
        ]);

        return redirect('admin/activity')->with([
            'success' => 'Berhasil Mengedit Kegiatan',
        ]);
    }

    public function destroy($id)
    {
        $data = Activity::findOrFail($id);
        if ($data->path != null) {
            Storage::delete($data->path);
        }

        $data->delete();
        return redirect('admin/activity')->with([
            'success' => 'Berhasil Menghapus Kegiatan',
        ]);
    }
}
