<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Article\PostRequest;
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
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
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
}
