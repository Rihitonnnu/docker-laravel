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
        return view('user.article.show', ['article' => Article::find($id),]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        return view('user.article.edit', ['article' => Article::find($id)]);
    }

    /**
     * @param UpdateRequest $request
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $id)
    {
        /** @var string $title */
        $title = $request->title;
        /** @var string $content */
        $content = $request->content;
        $this->article->updateArticle($title, $content, $id);
        return to_route('user.article.index');
    }
}
