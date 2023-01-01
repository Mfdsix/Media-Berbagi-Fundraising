<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $datas = BlogCategory::all();
        return view('admin.blog_category.index')->with([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        return view('admin.blog_category.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4',
            'icon' => 'nullable|max:500|mimes:png,jpg,jpeg',
        ]);

        $filename = null;

        if ($request->hasFile('icon')) {
            $filename = $request->file('icon')->store('uploads/blog_category');
        }

        BlogCategory::create([
            'name' => $request->name,
            'icon' => $filename,
        ]);

        return redirect('admin/blog-category')->with([
            'success' => 'Berhasil Menambahkan Kategori',
        ]);
    }

    public function edit($id)
    {
        $data = BlogCategory::findOrFail($id);
        return view('admin.blog_category.form')->with([
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = BlogCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|min:4',
            'icon' => 'nullable|max:500|mimes:png,jpg,jpeg',
        ]);

        $filename = $data->path_icon;

        if ($request->hasFile('icon')) {
            if ($data->path_icon != null) {
                Storage::delete($data->path_icon);
            }
            $filename = $request->file('icon')->store('uploads/blog_category');
        }

        $data->update([
            'name' => $request->name,
            'icon' => $filename,
        ]);

        return redirect('admin/blog-category')->with([
            'success' => 'Berhasil Mengedit Kategori',
        ]);
    }

    public function destroy($id)
    {
        $data = BlogCategory::findOrFail($id);
        if ($data->path_icon != null) {
            Storage::delete($data->path_icon);
        }

        $data->delete();
        return redirect('admin/blog-category')->with([
            'success' => 'Berhasil Menghapus Kategori',
        ]);
    }
}
