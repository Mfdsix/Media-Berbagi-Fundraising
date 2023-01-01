<?php

namespace App\Http\Controllers\Program;

use App\Http\Controllers\Controller;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $datas = ProjectCategory::paginate(25);
        return view('program.category.index')->with([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        return view('program.category.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|min:4',
            'icon' => 'nullable|max:500|mimes:png,jpg,jpeg',
            'image' => 'nullable|max:5000|mimes:png,jpg,jpeg',
            'risalah' => 'nullable',
        ]);

        // dd($request->status); null - on

        $filename = null;

        if ($request->hasFile('icon')) {
            $filename = $request->file('icon')->store('uploads/category');
        }
        if ($request->hasFile('image')) {
            $filenameImage = $request->file('image')->store('uploads/category');
        }

        ProjectCategory::create([
            'category' => $request->category,
            'path_icon' => $filename,
            'image' => $filenameImage,
            'risalah' => $request->risalah,
            'risalah_status' => $request->status == 'on' ? true : false,
        ]);

        return redirect('dashboard-program/category')->with([
            'success' => 'Berhasil Menambahkan Kategori',
        ]);
    }

    public function edit($id)
    {
        $data = ProjectCategory::findOrFail($id);
        return view('program.category.form')->with([
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = ProjectCategory::findOrFail($id);

        $request->validate([
            'category' => 'required|string|min:4',
            'icon' => 'nullable|max:500|mimes:png,jpg,jpeg',
            'image' => 'nullable|max:5000|mimes:png,jpg,jpeg',
            'risalah' => 'nullable',
        ]);

        $filename = $data->path_icon;
        $image = $data->image;

        if ($request->hasFile('icon')) {
            if ($data->path_icon != null) {
                Storage::delete($data->path_icon);
            }
            $filename = $request->file('icon')->store('uploads/category');
        }
        if ($request->hasFile('image')) {
            if ($data->image != null) {
                Storage::delete($data->image);
            }
            $image = $request->file('image')->store('uploads/category');
        }

        $data->update([
            'category' => $request->category,
            'path_icon' => $filename,
            'image' => $image,
            'risalah' => $request->risalah,
            'risalah_status' => $request->status == 'on' ? true : false,
        ]);

        return redirect('dashboard-program/category')->with([
            'success' => 'Berhasil Mengedit Kategori',
        ]);
    }

    public function destroy($id)
    {
        $data = ProjectCategory::findOrFail($id);
        if ($data->path_icon != null) {
            Storage::delete($data->path_icon);
        }

        $data->delete();
        return redirect('dashboard-program/category')->with([
            'success' => 'Berhasil Menghapus Kategori',
        ]);
    }

    public function order()
    {
        $datas = ProjectCategory::orderBy('order_number')
            ->get();

        return view('program.category.order')->with([
            'datas' => $datas,
        ]);
    }

    public function saveOrder(Request $request)
    {
        $request->validate([
            'order' => 'required',
        ]);

        $order = 1;
        foreach ($request->order as $key => $value) {
            ProjectCategory::where('id', $value)
                ->update([
                    'order_number' => (int) $order,
                ]);

            $order++;
        }

        return redirect('/dashboard-program/category-ordering')->with([
            'success' => 'Berhasil Mengubah Urutan',
        ]);
    }
}
