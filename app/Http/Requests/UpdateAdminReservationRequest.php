<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminReservationRequest extends FormRequest
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
            'movie_id' => ['required'],
            'schedule_id' => ['required'],
            'sheet_id' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'email:strict,dns'],
        ];
    }

    public function messages()
    {
        return [
            'movie_id.required' => '映画IDは必須です。',
            'schedule_id.required' => 'スケジュールIDは必須です。',
            'sheet_id.required' => 'シートIDは必須です。',
            'name.required' => '予約者名は必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレス形式で入力してください。',
            'date.required' => '日付は必須です。',
            'date.date_format' => '日付は YYYY-MM-DD 形式で入力してください。'
        ];
    }
}
