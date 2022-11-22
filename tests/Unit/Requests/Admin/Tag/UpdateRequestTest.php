<?php

namespace Tests\Unit\Requests\Admin\Tag;

use Tests\TestCase;
use Faker\Factory;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use Illuminate\Support\Facades\Validator;

class UpdateRequestTest extends TestCase
{
    /**
     * ユーザー情報更新のテストデータ
     * @return array
     */
    public function dataProviderUpdate()
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
        $this->updateRequest = new UpdateRequest();
    }

    /**
     * タグ更新
     * @test
     * @param array $data
     * @param boolean $expect
     * @param array $errors
     * @return void
     * @dataProvider dataProviderUpdate
     */
    public function testUpdateValidation(array $data, bool $expect, array $errors): void
    {
        $validator = Validator::make($data, $this->updateRequest->rules(), $this->updateRequest->messages());
        $this->assertEquals($expect, $validator->passes());
        $this->assertEquals($errors, $validator->errors()->getMessages());
    }
}
