<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'HoTen' => 'required|min:1|max:100',
            'GioiTinh' => 'required|min:2|max:10',
            'DiaChi' => 'required|min:1|max:200',
            'SDT' => 'required|numeric|digits:10',
            'Email' => 'required|min:11|max:100',
        ];
    }

    public function messages()
    {
        return [
            'HoTen.required' => 'Họ và tên bắt buộc',
            'GioiTinh.required' => 'Giới tính bắt buộc',
            'DiaChi.required' => 'Quê quán bắt buộc',
            'SDT.required' => 'Số điện thoại bắt buộc',
            'Email.required' => 'Email bắt buộc',
        ];
    }
}
