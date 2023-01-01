<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::all();
        $blogs = Blog::orderBy('id', 'DESC')
            ->get();
        $popular = Blog::orderBy('views', 'DESC')
            ->get();

        return view('front.blog.index')->with([
            'datas' => $blogs,
            'popular' => $popular,
            'categories' => $categories,
        ]);
    }

    public function category($id)
    {
        $categories = BlogCategory::all();
        $blogs = Blog::where('category', $id)
            ->orderBy('id', 'DESC')
            ->paginate(15);
        $popular = Blog::orderBy('views', 'DESC')
            ->limit(5)
            ->get();

        return view('front.blog.index')->with([
            'datas' => $blogs,
            'popular' => $popular,
            'categories' => $categories,
        ]);
    }

    public function show($id)
    {
        $blog = Blog::where('slug', $id)
            ->firstOrFail();

        return view('front.blog.show')->with([
            'blog' => $blog,
        ]);
    }

    public function detail($id)
    {
        $blog = Blog::where('slug', $id)
            ->firstOrFail();
        $blog->update([
            'views' => $blog->views + 1,
        ]);

        return view('front.blog.detail')->with([
            'blog' => $blog,
        ]);
    }
}
