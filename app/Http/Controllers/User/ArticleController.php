<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Article\CreateRequest;
use App\Http\Requests\User\Article\UpdateRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    private Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('user.article.index', ['articles' => Article::where('user_id', Auth::id())->get()]);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('user.article.create');
    }

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        /** @var int $userId */
        $userId = Auth::id();
        /** @var string $title */
        $title = $request->title;
        /** @var string $content */
        $content = $request->content;

        $this->article->storeArticle($userId, $title, $content);
        return to_route('user.article.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        $article = Article::find($id);

        $this->authorize('show', $article); //取得した投稿がユーザーが表示可能かどうか判定

        return view('user.article.show', ['article' => $article]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $article = Article::find($id);

        $this->authorize('edit', $article); //投稿が編集可能か判定

        return view('user.article.edit', ['article' => $article]);
    }

    /**
     * @param UpdateRequest $request
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $id)
    {
        $this->authorize('update', Article::find($id)); //投稿が上書き保存可能か判定

        /** @var string $title */
        $title = $request->title;
        /** @var string $content */
        $content = $request->content;
        $this->article->updateArticle($title, $content, $id);
        return to_route('user.article.index');
    }

    /**
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->authorize('delete', Article::find($id)); //投稿が削除可能か判定

        $this->article->destroyArticle($id);
        return to_route('user.article.index');
    }
}
