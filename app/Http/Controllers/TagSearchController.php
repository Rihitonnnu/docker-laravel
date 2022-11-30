<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Article;

class TagSearchController extends Controller
{
    /**
     * @param SearchRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function search(SearchRequest $request)
    {
        $keyword = $request->keyword;

        $articles = Article::whereHas('tags', function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        })->with('tags')->paginate(10);

        return view('visitor.article.search', ['articles' => $articles, 'keyword' => $keyword]);
    }
}
