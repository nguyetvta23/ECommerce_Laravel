<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'm_name' => ['required', 'string', 'between:5,30'],
            'm_email' => ['required', 'email:rfc,dns'],
            'm_phone' => ['required', 'regex:/(84|0[3|9|8|7|5|2])+([0-9]{8})\b/'],
            'province_nice-select' => ['required'],
            'district_nice-select' => ['required'],
            'ward_nice-select' => ['required'],
            'm_address' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [
            'm_name.required' => 'Họ và tên không để trống !',
            'm_name.string' => 'Họ và tên phải là chuỗi kí tự !',
            'm_name.between' => 'Họ và tên phải từ 5 đến 30 kí tự !',
            'm_email.required' => 'Email không để trống !',
            'm_email.email' => 'Email không đúng định dạng !',
            'm_phone.regex' => 'Số điện thoại không đúng định dạng !',
            'm_phone.required' => 'Số điện thoại không được để trống !',
            'province_nice-select.required' => 'Tỉnh thành phố không được bỏ trống !',
            'district_nice-select.required' => 'Quận huyện không được bỏ trống !',
            'ward_nice-select.required' => 'Phường xã không được bỏ trống !',
            'm_address.required' => 'Tên đường, số nhà không được để trống !',
            'm_address.string' => 'Địa chỉ không đúng định dạng !',
        ];
    }
}
