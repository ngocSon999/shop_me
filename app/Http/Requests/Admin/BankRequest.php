<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'bank_name' => [
                'max:255',
                Rule::requiredIf(function () {
                    if ($this->type == 1) {
                        return true;
                    }
                    return false;
                }),
            ],
            'bank_number' => [
                'required', 'max:20',
                Rule::unique('banks')->ignore($this->id),
                Rule::when($this->type == 2, ['regex:/(0[3|5|7|8|9])+([0-9]{8})\b/']),
            ],
            'bank_address' => 'nullable|max:255',
            'status' => 'required|integer|max:1',
            'type' => 'required|integer|max:2',
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
            'type' => 'Loại thẻ',
        ];
    }

    public function messages(): array
    {
        return [
            'bank_number.regex' => 'Số tài khoản momo  không hợp lệ',
        ];
    }
}
