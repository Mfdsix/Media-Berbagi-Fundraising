<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Auth;
use Illuminate\Http\Request;
use Storage;

class BlogController extends Controller
{
    public function index()
    {
        $datas = Blog::orderBy('created_at', 'DESC')
            ->get();

        return view('admin.blog.index')->with([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blog.form')->with([
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:10|max:40',
            'content' => 'required|string|min:4',
            'featured' => 'nullable|max:500|mimes:png,jpg,jpeg',
            'slug' => 'nullable|string|unique:blogs',
            'category' => 'required',
        ]);

        $filename = null;

        if ($request->hasFile('featured')) {
            $filename = $request->file('featured')->store('uploads/blog');
        }

        Blog::create([
            'user_id' => Auth::user()->id,
            'author' => 'Admin Forfund',
            'title' => $request->title,
            'content' => $request->content,
            'featured' => $filename,
            'slug' => $request->slug ?? $this->slugify($request->title),
            'category' => $request->category,
        ]);

        return redirect('admin/blog')->with([
            'success' => 'Berhasil Menambahkan Blog',
        ]);
    }

    public function edit($id)
    {
        $data = Blog::findOrFail($id);
        $categories = BlogCategory::all();

        return view('admin.blog.form')->with([
            'data' => $data,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|min:25|max:40',
            'content' => 'required|string|min:4',
            'featured' => 'nullable|max:500|mimes:png,jpg,jpeg',
            'slug' => 'required|string',
            'category' => 'required',
        ]);

        $filename = $data->featured;

        if ($request->hasFile('featured')) {
            if ($data->featured != null) {
                Storage::delete($data->featured);
            }
            $filename = $request->file('featured')->store('uploads/blog');
        }

        $data->update([
            'title' => $request->title,
            'content' => $request->content,
            'featured' => $filename,
            'slug' => $request->slug,
            'category' => $request->category,
        ]);

        return redirect('admin/blog')->with([
            'success' => 'Berhasil Mengedit Blog',
        ]);
    }

    public function destroy($id)
    {
        $data = Blog::findOrFail($id);
        if ($data->featured != null) {
            Storage::delete($data->featured);
        }

        $data->delete();
        return redirect('admin/blog')->with([
            'success' => 'Berhasil Menghapus Blog',
        ]);
    }
}
