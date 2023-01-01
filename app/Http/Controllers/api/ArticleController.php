<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;

class ArticleController extends Controller
{
    public function index() {
        $articles = Blog::all();
        return $this->success($articles);
    }

    public function detail($id) {
        $article = Blog::findOrFail($id);
        return $this->success($article);
    }
}
