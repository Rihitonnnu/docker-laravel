<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use Faker\Factory;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Validator;

class SearchRequestTest extends TestCase
{
    /**
     * タグ検索のテストデータ
     * @return array
     */
    public function dataProviderSearch()
    {
        return [
            '正常データ' => [
                'data' => [
                    'keyword' => 'ほげほげ',
                ],
                true,
                'errors' => [],
            ],
            '空配列' => [
                'data' => [],
                false,
                'errors' => [
                    'keyword' => [
                        '検索ワードを入力して下さい'
                    ],
                ]
            ],
            '文字数超過' => [
                'data' => [
                    'keyword' => Factory::create()->realText(30),
                ],
                false,
                'errors' => [
                    'keyword' => [
                        '15文字以下で入力して下さい'
                    ],
                ],
            ]
        ];
    }

    protected function setup(): void
    {
        parent::setUp();
        $this->searchRequest = new SearchRequest();
    }

    /**
     * タグ検索
     * @test
     * @param array $data
     * @param boolean $expect
     * @param array $errors
     * @return void
     * @dataProvider dataProviderSearch
     */
    public function testSearchValidation(array $data, bool $expect, array $errors): void
    {
        $validator = Validator::make($data, $this->searchRequest->rules(), $this->searchRequest->messages());
        $this->assertEquals($expect, $validator->passes());
        $this->assertEquals($errors, $validator->errors()->getMessages());
    }
}
