<?php

namespace App\Http\Controllers;

use Search\QueryParser;
use App\Search\TagsSearch;

class TagsSearchController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function search()
    {
        $query = QueryParser::parse(new TagsSearch());
        return to_route('visitor.article.search', $query);
    }
}
