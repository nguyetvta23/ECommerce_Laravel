<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostMessageRequest extends FormRequest
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
            'name' => 'required|string|max:150',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
            'email' => 'email|required',
            'title' => 'required|string|max:500',
            'message' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ tên là bắt buộc.',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'name.max' => 'Họ tên không vượt quá 150 kí tự.',
            'email.required' => 'Email không được bỏ trống.',
            'email.email' => 'Email không đúng định dạng.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'title.required' => 'Tiêu đề là bắt buộc.',
            'message.required' => 'Nội dung là bắt buộc.',
        ];
    }
}
