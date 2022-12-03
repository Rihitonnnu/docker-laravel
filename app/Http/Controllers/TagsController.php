<?php

namespace App\Http\Controllers;

use Search\QueryParser;
use App\Search\TagsSearch;

class TagsController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function search()
    {
        $query = QueryParser::parse(new TagsSearch());
        return to_route('visitor.article.index', $query);
    }
}
