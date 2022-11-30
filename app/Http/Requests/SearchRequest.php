<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    protected $redirectRoute='visitor.article.index';
    
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
            'keyword' => 'required|max:15',
        ];
    }

    public function messages()
    {
        return [
            'keyword.required' => '検索ワードを入力して下さい',
            'keyword.max' => '15文字以下で入力して下さい',
        ];
    }
}
