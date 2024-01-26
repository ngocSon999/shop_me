<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch ($this->method()) {
            default:
                return [];
            case 'POST':
                return [
                    'first_name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:6|max:32',
                    'phone' => 'required|numeric|digits:10',
                    'role' => 'required',
                ];
            case 'PUT':
                return [
                    'first_name' => 'required',
                    'email' => [
                        'required', 'email',
                        Rule::unique('users')->ignore($this->id)
                    ],
                    'password' => [
                        'max:32',
                    ],
                    'phone' => 'required|numeric|digits:10',
                    'role' => 'required',
                ];
        }
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Trường :attribute không được để trống',
            'email.required' => 'Trường :attribute không được để trống',
            'email.email' => 'Trường :attribute phải là email',
            'email.unique' => 'Trường :attribute đã tồn tại trong hệ thống',
            'password.required' => 'Trường :attribute không được để trống',
            'password.min' => 'Trường :attribute không được ít hơn :min ký tự',
            'password.max' => 'Trường :attribute không được lớn hơn :mã ký tự',
            'phone.required' => 'Trường :attribute không được để trống',
            'phone.numeric' => 'Trường :attribute phải là số',
            'phone.digits' => 'Trường :attribute không được lớn hơn :digits ký tự',
            'role.required' => 'Trường :attribute không được để trống',
        ];
    }

    public function attributes(): array
    {
        return [
            'first_name' => 'Họ và tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'phone' => 'Số điện thoại',
            'role' => 'Quyền tài khoản',
        ];
    }
}
