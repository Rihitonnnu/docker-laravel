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
        return view('visitor.article.index', ['articles' => Article::with(['user', 'tags'])->orderBy('created_at', 'desc')->paginate(20)]);
    }

    /**
     * @param integer $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        /** @var \App\Models\Article $article */
        $article = Article::with(['tags', 'user'])->where('id', $id)->first();

        return view('visitor.article.show', ['article' => $article]);
    }
}
