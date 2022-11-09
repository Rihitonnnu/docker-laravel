<?php

namespace Tests\Unit\Requests\Admin\User;

use App\Http\Requests\Admin\User\UpdateRequest;
use Tests\TestCase;
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
                    'name' => 'hoge',
                    'email' => 'hoge@test.com',
                ],
                true,
                'errors' => [],
            ],
            '空配列' => [
                'data' => [],
                false,
                'errors' => [
                    'name' => [
                        '名前を入力して下さい'
                    ],
                    'email' => [
                        'メールアドレスを入力して下さい'
                    ],
                ]
            ],
            'メールアドレス異常' => [
                'data' => [
                    'name' => 'hoge',
                    'email' => 'hoge',
                ],
                false,
                'errors' => [
                    'email' => [
                        '適切なメールアドレスを入力してください'
                    ],
                ],
            ],
            'マルチバイトメールアドレス' => [
                'data' => [
                    'name' => 'hoge',
                    'email' => 'hoge@test.comあいうえお',
                ],
                false,
                'errors' => [
                    'email' => [
                        '適切なメールアドレスを入力してください'
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
     * ユーザー更新
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
        $this->assertEquals($expect, $validator->passes()); //バリデーションのチェックが通ったかどうか
        $this->assertEquals($errors, $validator->errors()->getMessages()); //エラーメッセージチェック
    }
}
