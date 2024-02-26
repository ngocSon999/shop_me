<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bank_account' => 'required|max:150',
            'bank_name' => 'required|max:255',
            'bank_number' => 'required|max:20|unique:banks,bank_number,' . $this->id,
            'bank_address' => 'nullable|max:255',
            'status' => 'required|integer|max:1',
        ];
    }

    public function attributes(): array
    {
        return [
            'bank_account' => 'Tên chủ tài khoản',
            'bank_name' => 'Tên ngân hàng',
            'bank_number' => 'Số TK/Số thẻ',
            'bank_address' => 'Chi nhánh ngân hàng',
            'status' => 'Trạng thái hoạt động thẻ',
        ];
    }
}
