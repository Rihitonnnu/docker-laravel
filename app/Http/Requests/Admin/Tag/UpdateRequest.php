<?php

namespace App\Http\Requests\Admin\Tag;

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
            'name' => 'required|max:15',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'タグ名を入力して下さい',
            'name.max' => 'タグ名は15文字以内で入力してください',
        ];
    }
}
