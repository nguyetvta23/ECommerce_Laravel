<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyContactRequest extends FormRequest
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
            'reply' => 'required|string|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'reply.required' => 'Nội dung phản hồi là bắt buộc.',
            'reply.max' => 'Nội dung phản hồi không quá 1000 ký tự.',
        ];
    }

}
