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
                'method' => function ($builder, $key, $value) {
                    $keyword = mb_convert_kana($value, 'Hc');
                    $builder->whereHas('tags', function ($query) use ($keyword) {
                        $query->where('name', $keyword);
                    });
                }
            ],
        ];
    }
}
