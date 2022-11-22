<?php

namespace Tests\Unit\Requests\Admin\Tag;

use Tests\TestCase;
use Faker\Factory;
use App\Http\Requests\Admin\Tag\StoreRequest;
use Illuminate\Support\Facades\Validator;

class StoreRequestTest extends TestCase
{
    /**
     * ユーザー情報更新のテストデータ
     * @return array
     */
    public function dataProviderStore()
    {
        return [
            '正常データ' => [
                'data' => [
                    'name' => 'ほげほげ',
                ],
                true,
                'errors' => [],
            ],
            '空配列' => [
                'data' => [],
                false,
                'errors' => [
                    'name' => [
                        'タグ名を入力して下さい'
                    ],
                ]
            ],
            '文字数超過' => [
                'data' => [
                    'name' => Factory::create()->realText(30),
                ],
                false,
                'errors' => [
                    'name' => [
                        'タグ名は15文字以内で入力してください'
                    ],
                ],
            ]
        ];
    }

    protected function setup(): void
    {
        parent::setUp();
        $this->storeRequest = new StoreRequest();
    }

    /**
     * タグ作成
     * @test
     * @param array $data
     * @param boolean $expect
     * @param array $errors
     * @return void
     * @dataProvider dataProviderStore
     */
    public function testStoreValidation(array $data, bool $expect, array $errors): void
    {
        $validator = Validator::make($data, $this->storeRequest->rules(), $this->storeRequest->messages());
        $this->assertEquals($expect, $validator->passes()); //バリデーションのチェックが通ったかどうか
        $this->assertEquals($errors, $validator->errors()->getMessages()); //エラーメッセージチェック
    }
}
