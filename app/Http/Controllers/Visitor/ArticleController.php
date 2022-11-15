<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;

class ArticleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('visitor.article.index', ['articles' => Article::orderBy('created_at', 'desc')->paginate(20)]);
    }

    /**
     * @param integer $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        /** @var \App\Models\Article $article */
        $article = Article::find($id);

        /** @var \App\Models\User $user */
        $user = User::find($article->user_id);

        return view('visitor.article.show', ['article' => $article, 'userName' => $user->name]); //表示する投稿とその投稿の作成者の名前を取得
    }
}
