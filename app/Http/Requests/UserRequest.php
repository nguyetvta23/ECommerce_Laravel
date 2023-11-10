<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'phone' => ['required','regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'email' => ['required','email'],
            'm_address' => 'required|string|max:500',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Email không được để trống!',
            'name.string' => 'Tên phải là chuỗi!',
            'name.max' => 'Tên quá dài!',
            'phone.regex'=> 'Số điện thoại phải 10 số',
            'phone.required' => 'Số điện thoại không được bỏ trống!',
            'email.email' => 'Email không đúng định dạng! Vui lòng kiểm tra lại',
            'email.required'=> 'Email không được bỏ trống!', 
            'm_address.required' => 'Địa chỉ không được bỏ trống!',
    ];
    }
}
