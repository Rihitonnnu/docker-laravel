<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.article.index', ['articles' => Article::with('user')->orderBy('created_at', 'desc')->paginate(20)]);
    }
}
