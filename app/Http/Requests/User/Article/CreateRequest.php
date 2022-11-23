<?php

namespace App\Http\Requests\User\Article;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:50',
            'content' => 'required|max:1000',
            'tags' => 'required|max:5',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力して下さい',
            'title.max' => 'タイトルは50文字以内で入力してください',
            'content.required' => '本文を入力して下さい',
            'content.max' => '本文は1000文字以内で入力してください',
            'tags.required' => 'タグは1つ以上選択して下さい',
            'tags.max' => 'タグ数は5つ以下にして下さい',
        ];
    }
}
