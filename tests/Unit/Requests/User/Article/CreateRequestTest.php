<?php

namespace Tests\Unit\Requests\User\Article;

use App\Http\Requests\User\Article\CreateRequest;
use Faker\Factory;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class CreateRequestTest extends TestCase
{
    /**
     * 投稿作成のテストデータ
     * @return array
     */
    public function dataProviderCreate()
    {
        return [
            '正常データ' => [
                'data' => [
                    'title' => 'ほげほげ',
                    'content' => 'ふがふが',
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
                ]
            ],
            '文字数上限' => [
                'data' => [
                    'title' => Factory::create()->realText(100),
                    'content' => Factory::create()->realText(1200),
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
        ];
    }

    protected function setup(): void
    {
        parent::setUp();
        $this->createRequest = new CreateRequest();
    }

    /**
     * 新規投稿の作成
     * @test
     * @param array $data
     * @param boolean $expect
     * @param array $errors
     * @dataProvider dataProviderCreate
     * @return void
     */
    public function testCreateValidation(array $data, bool $expect, array $errors): void
    {
        $validator = Validator::make($data, $this->createRequest->rules(), $this->createRequest->messages());
        $this->assertEquals($expect, $validator->passes()); //バリデーションのチェックが通ったかどうか
        $this->assertEquals($errors, $validator->errors()->getMessages()); //エラーメッセージテスト
    }
}
