<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Search\TagsSearch;

class ArticleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $articles = Article::with(['user', 'tags'])
            ->search(new TagsSearch())
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('visitor.article.index', ['articles' => $articles]);
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
