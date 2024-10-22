<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
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
            'user_id' => ['required'],
            'schedule_id' => ['required'],
            'sheet_id' => ['required'],
            'date' => ['required', 'date_format:Y-m-d']
        ];
    }

    public function messages()
    {
        return [
            'user_id' => 'ユーザーIDは必須です。',
            'schedule_id.required' => 'スケジュールIDは必須です。',
            'sheet_id.required' => 'シートIDは必須です。',
            'date.required' => '日付は必須です。',
            'date.date_format' => '日付は YYYY-MM-DD 形式で入力してください。'
        ];
    }
}
