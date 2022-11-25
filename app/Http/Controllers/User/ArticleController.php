<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Article\CreateRequest;
use App\Http\Requests\User\Article\UpdateRequest;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    private Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->authorizeResource(Article::class, 'article');
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
        return view('user.article.create', ['tags' => Tag::all()]);
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
        /** @var array $tags */
        $tags = $request->tags;

        $this->article->storeArticle($userId, $title, $content, $tags);

        return to_route('user.article.index');
    }

    /**
     * @param \App\Models\Article $article
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Article $article)
    {
        return view('user.article.show', ['article' => $article]);
    }

    /**
     * @param \App\Models\Article $article
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Article $article)
    {
        return view('user.article.edit', ['article' => $article]);
    }

    /**
     * @param UpdateRequest $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Article $article)
    {
        /** @var string $title */
        $title = $request->title;
        /** @var string $content */
        $content = $request->content;
        $this->article->updateArticle($title, $content, $article->id);
        return to_route('user.article.index');
    }

    /**
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        $this->article->destroyArticle($article);
        return to_route('user.article.index');
    }
}
