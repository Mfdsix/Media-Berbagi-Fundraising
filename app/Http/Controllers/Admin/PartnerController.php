<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $datas = Partner::all();

        return view('admin.partner.index')->with([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        return view('admin.partner.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|max:5000|mimes:png,jpg,jpeg',
        ]);

        $filename = null;

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('uploads/partner');
        }

        Partner::create([
            'image' => $filename,
        ]);

        return redirect('admin/partner')->with([
            'success' => 'Berhasil Menambahkan Partner',
        ]);
    }

    public function edit($id)
    {
        $data = Partner::findOrFail($id);
        return view('admin.partner.form')->with([
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Partner::findOrFail($id);

        $request->validate([
            'image' => 'nullable|max:5000|mimes:png,jpg,jpeg',
        ]);

        $filename = $data->path_slider;

        if ($request->hasFile('image')) {
            if ($data->image != null) {
                Storage::delete($data->image);
            }
            $filename = $request->file('image')->store('uploads/partner');
        }

        $data->update([
            'image' => $filename,
        ]);

        return redirect('admin/partner')->with([
            'success' => 'Berhasil Mengedit Gambar Partner',
        ]);
    }

    public function destroy($id)
    {
        $data = Partner::findOrFail($id);
        if ($data->image != null) {
            Storage::delete($data->image);
        }

        $data->delete();
        return redirect('admin/partner')->with([
            'success' => 'Berhasil Menghapus Gambar Partner',
        ]);
    }
}
