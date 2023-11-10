<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'matkhaucu' => 'required',
            'matkhaumoi' => 'required|min:4',
            'xacnhanmatkhau' => ['required','same:matkhaumoi']
        ];
    }
    public function messages()
    {
        return [
            'matkhaucu.required' => 'Mật khẩu không được để trống!',
            'matkhaumoi.required' => 'Mật khẩu mới không được để trống!',
            'xacnhanmatkhau.required' => 'Xác nhận mật khẩu mới không được bỏ trống!',
            'xacnhanmatkhau.same' => 'Mật khẩu xác nhận không khớp!'
        ];
    }
}
