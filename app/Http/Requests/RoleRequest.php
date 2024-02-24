<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
        return match ($this->method()) {
            'POST' => [
                'name' => 'required|max:255|unique:roles,name',
                'permission' => 'required',
            ],
            'PUT' => [
                'name' => [
                    'required', 'max:255',
                    Rule::unique('roles')->ignore($this->id)
                ],
                'permission' => 'required',
            ],
            default => [],
        };
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Trường :attribute không được để trống',
            'name.unique' => 'Trường :attribute đã tồn tại trong hệ thống',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên vai trò',
        ];
    }
}
