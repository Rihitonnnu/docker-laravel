<?php

namespace App\Search;

use Search\Searchable;

class TagsSearch extends Searchable
{
    public function __construct()
    {
        $this->params = [
            'keyword' => [
                'type' => 'callback',
                'operator' => '=',
                'method' => function ($builder, $key, $keyword) {
                    $builder->whereHas('tags', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    });
                }
            ],
        ];
    }
}
