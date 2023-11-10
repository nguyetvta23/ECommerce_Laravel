<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            'province'=> ['required'],
            'district'=> ['required'],
            'ward'=> ['required', 'unique:t_transport_fee,m_ward_id'],
            'm_fee_ship'=> ['required', 'between:5,7'],
        ];
    }

    public function messages()
    {
        return [
            'province.required' => 'Tỉnh thành không được để trống!',
            'district.required' => 'Quận huyện không được để trống!',
            'ward.required' => 'Phường xã không được để trống!',
            'ward.unique' => 'Địa chỉ đã tồn tại!',
            'm_fee_ship.required' => 'Phí vận chuyển không được để trống!',
            'm_fee_ship.between' => 'Phí vận chuyển phải từ 15,000 đến 200,000!',
        ];
        
    }
}
