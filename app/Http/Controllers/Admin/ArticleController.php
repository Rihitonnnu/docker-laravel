<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    private Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * 投稿一覧を表示
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.article.index', ['articles' => Article::with(['user', 'tags'])->orderBy('created_at', 'desc')->paginate(20)]);
    }

    /**
     * 投稿詳細を表示
     * @param integer $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        /** @var \App\Models\Article $article */
        $article = Article::with(['user', 'tags'])->where('id', $id)->first();

        return view('admin.article.show', ['article' => $article]);
    }

    /**
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        /** @var \App\Models\Article */
        $article = Article::find($id);
        $this->article->destroyArticle($article);

        return to_route('admin.article.index');
    }
}
