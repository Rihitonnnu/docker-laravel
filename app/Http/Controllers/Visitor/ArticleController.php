<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('visitor.index', ['articles' => Article::select('id', 'user_id', 'title', 'content', 'created_at')->orderBy('created_at', 'desc')->paginate(20)]);
    }
}
