<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = ProjectCategory::paginate(25);
        return view('admin.category.index')->with([
            'datas' => $datas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.form');
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
            'category' => 'required|string|min:4',
            'icon' => 'required|max:500|mimes:png,jpg,jpeg',
            'image' => 'required|max:5000|mimes:png,jpg,jpeg',
        ]);

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
            'risalah_status' => $request->status == 'on' ? true : false,
        ]);

        return redirect('admin/category')->with([
            'success' => 'Berhasil Menambahkan Kategori',
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
        $data = ProjectCategory::findOrFail($id);
        return view('admin.category.form')->with([
            'data' => $data,
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
        $data = ProjectCategory::findOrFail($id);

        $request->validate([
            'category' => 'required|string|min:4',
            'icon' => 'required|max:500|mimes:png,jpg,jpeg',
            'image' => 'required|max:5000|mimes:png,jpg,jpeg',
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

        return redirect('admin/category')->with([
            'success' => 'Berhasil Mengedit Kategori',
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
        $data = ProjectCategory::findOrFail($id);
        if ($data->path_icon != null) {
            Storage::delete($data->path_icon);
        }

        $data->delete();
        return redirect('admin/category')->with([
            'success' => 'Berhasil Menghapus Kategori',
        ]);
    }

    public function order()
    {
        $datas = ProjectCategory::orderBy('order_number')
            ->get();

        return view('admin.category.order')->with([
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

        return redirect('/admin/category-ordering')->with([
            'success' => 'Berhasil Mengubah Urutan',
        ]);
    }
}
