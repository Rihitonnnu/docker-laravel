<?php

namespace Tests\Unit\Requests\User\Article;

use App\Http\Requests\User\Article\UpdateRequest;
use Faker\Factory;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UpdateRequestTest extends TestCase
{
    /**
     * 投稿編集のテストデータ
     * @return array
     */
    public function dataProviderUpdate()
    {
        return [
            '正常データ' => [
                'data' => [
                    'title' => 'ほげほげ',
                    'content' => 'ふがふが',
                    'tags' => [1],
                ],
                true,
                'errors' => [],
            ],
            '空配列' => [
                'data' => [],
                false,
                'errors' => [
                    'title' => [
                        'タイトルを入力して下さい'
                    ],
                    'content' => [
                        '本文を入力して下さい'
                    ],
                    'tags' => [
                        'タグは1つ以上選択して下さい'
                    ]
                ]
            ],
            '文字数上限' => [
                'data' => [
                    'title' => Factory::create()->realText(100),
                    'content' => Factory::create()->realText(1200),
                    'tags' => [1],
                ],
                false,
                'errors' => [
                    'title' => [
                        'タイトルは50文字以内で入力してください'
                    ],
                    'content' => [
                        '本文は1000文字以内で入力してください'
                    ],
                ]
            ],
            'タグ数上限' => [
                'data' => [
                    'title' => 'ほげほげ',
                    'content' => 'ふがふが',
                    'tags' => [1, 2, 3, 4, 5, 6],
                ],
                false,
                'errors' => [
                    'tags' => [
                        'タグ数は5つ以下にして下さい'
                    ]
                ]
            ]
        ];
    }

    protected function setup(): void
    {
        parent::setUp();
        $this->updateRequest = new UpdateRequest();
    }

    /**
     * 投稿編集
     * @test
     * @param array $data
     * @param boolean $expect
     * @param array $errors
     * @dataProvider dataProviderUpdate
     * @return void
     */
    public function testUpdateValidation(array $data, bool $expect, array $errors): void
    {
        $validator = Validator::make($data, $this->updateRequest->rules(), $this->updateRequest->messages());
        $this->assertEquals($expect, $validator->passes());
        $this->assertEquals($errors, $validator->errors()->getMessages());
    }
}
