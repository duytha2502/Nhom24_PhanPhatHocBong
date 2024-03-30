<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeRequestSV extends FormRequest
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
            'TenSV' => 'required|min:1|max:100',
            'GioiTinh' => 'required|min:2|max:10',
            'NgaySinh' => 'required|min:2|max:10',
            'DiaChi' => 'required|min:1|max:200',
            'SDT' => 'required|numeric|digits:10',
            'Email' => 'required|min:11|max:100',
        ];
    }

    public function messages()
    {
        return [
            'TenSV.required' => 'Tên sinh viên bắt buộc',
            'GioiTinh.required' => 'Giới tính bắt buộc',
            'NgaySinh.required' => 'Ngày sinh bắt buộc',
            'DiaChi.required' => 'Địa chỉ bắt buộc',
            'SDT.required' => 'Số điện thoại bắt buộc',
            'Email.required' => 'Email bắt buộc',
        ];
    }
}
