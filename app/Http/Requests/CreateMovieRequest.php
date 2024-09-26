<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMovieRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'unique:movies'],
            'image_url' => ['required', 'url'],
            'published_year' => ['required', 'gte:1900'],
            'description' => ['required'],
            'is_showing' => ['required', 'boolean'],
            'genre' => ['required'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => '映画タイトルは必須です。',
            'title.unique' => '入力された映画タイトルは既に存在します。',
            'image_url.required' => '画像URLは必須です。',
            'image_url.url' => '有効なURLを入力してください。',
            'published_year.required' => '公開年は必須です。',
            'published_year.gte' => '1900年以降で入力してください。',
            'description.required' => '概要は必須です。',
            'is_showing.required' => '公開中かどうかは必須です。',
            'is_showing.boolean' => '有効な値で入力してください',
            'genre.required' => 'ジャンルは必須です。',
        ];
    }
}
