<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
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
            'nameCategory' => 'required|string|max:150',
            // 'numberCategory' => 'required|numeric|min:1'
        ];
    }

    public function messages()
    {
        return [
            'nameCategory.required' => 'Tên danh mục là bắt buộc.',
            // 'numberCategory.required' => 'Số thứ tự là bắt buộc.',
            // 'numberCategory.min' => 'Số thứ tự phải lớn hơn 1.',
        ];
    }
}
