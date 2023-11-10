<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPostRequest extends FormRequest
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

    public function rules()
    {
        return [
            'm_title' => ['required', 'between:10,100', 'string'],
            'm_slug' => ['required', 'string'],
            'm_desc' => ['required', 'between:10,200', 'string'],
            'm_content' => ['required', 'string'],
            'm_meta_keyword' => ['required', 'between:10,200', 'string'],
            'm_meta_desc' => ['required', 'between:10,200', 'string'],
            'm_image' => ['image']
        ];
    }

    public function messages()
    {
        return [
            'm_title.required' => 'Tiêu đề không được bỏ trống!',
            'm_title.between' => 'Tiêu đề phải dài từ 10 đến 100 kí tự!',
            'm_slug.required' => 'Slug không được bỏ trống!',
            'm_desc.required' => 'Mô tả ngắn không được bỏ trống!',
            'm_desc.between' => 'Mô tả ngắn phải từ 10 từ 200 kí tự!',
            'm_content.required' => 'Nội dung không được bỏ trống!',
            'm_meta_keyword.required' => 'Thẻ meta keyword không được bỏ trống!',
            'm_meta_keyword.between' => 'Thẻ meta keyword phải dài từ 10 đến 200 kí tự!',
            'm_meta_desc.between' => 'Thẻ meta desc phải dài từ 10 đến 200 kí tự!',
            'm_meta_desc.required' => 'Thẻ meta desc không để trống!',
            'm_title.string' => 'Tiêu đề phải là chuỗi kí tự!',
            'm_slug.string' => 'Slug phải là chuỗi kí tự!',
            'm_desc.string' => 'Mô tả ngắn phải là chuỗi kí tự!',
            'm_content.string' => 'Nội dung phải là chuỗi kí tự!',
            'm_meta_keyword.string' => 'Thẻ meta keyword phải là chuỗi kí tự!',
            'm_meta_desc.string' => 'Thẻ meta desc phải là chuỗi kí tự!',
            'm_image.image' => 'Hình ảnh phải đúng định dạng!'
        ];
    }
}
