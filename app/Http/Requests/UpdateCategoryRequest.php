<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'nameEditCategory' => 'required|string|max:150',
            // 'numberEditCategory' => 'required|numeric|min:1'
        ];
    }

    public function messages()
    {
        return [
            'nameEditCategory.required' => 'Tên danh mục là bắt buộc.',
            // 'numberEditCategory.required' => 'Số thứ tự là bắt buộc.',
            // 'numberEditCategory.min' => 'Số thứ tự phải lớn hơn 1.',
        ];
    }
}
