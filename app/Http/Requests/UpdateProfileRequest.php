<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|max:55',
            'email' => 'required|email',
            'phone' => ['required','regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'm_address'=> 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Họ và tên không được bỏ trống!',
            'name.max'=> 'Họ và tên quá dài!',
            'email.email' => 'Email không đúng định dạng!',
            'email.required' => 'Email không được bỏ trống!',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'phone.required' => 'Số điện thoại không được bỏ trống!',
            'm_address.required' => 'Địa chỉ không được bỏ trống!'
        ];
    }
}
