<?php

namespace App\Http\Requests\User\Article;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力して下さい',
            'title.max' => 'タイトルは50文字以内で入力してください',
            'content.required' => '本文を入力して下さい',
            'content.max' => '本文は1000文字以内で入力してください',
        ];
    }
}