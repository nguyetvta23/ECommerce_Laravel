<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'coupon_name'=> ['required', 'between:5,50'],
            'coupon_code'=> ['required', 'unique:t_coupon,coupon_code', 'between:2,10'],
            'coupon_time'=> ['required'],
            'coupon_method'=> ['required'],
            'coupon_expired'=> ['required'],
            'coupon_value'=> ['required'],
        ];
    }

    public function messages()
    {
        return [
            'coupon_name.required'=> 'Tên mã giảm giá không để trống!',
            'coupon_name.between'=> 'Tên mã giảm giá phải từ 5 đến 50 kí tự!',
            'coupon_code.required'=> 'Mã giảm giá không để trống!',
            'coupon_code.unique'=> 'Mã giảm giá đã tồn tại!',
            'coupon_code.between'=> 'Mã giảm giá phải từ 2 đến 10 kí tự!',
            'coupon_time.required'=> 'Số lượng mã giảm giá không để trống!',
            'coupon_method.required'=> 'Phương thức giảm không để trống!',
            'coupon_expired.required'=> 'Ngày hết hạn không bỏ trống!',
            'coupon_value.required'=> 'Giá trị mã không bỏ trống!',
        ];
    }
}
