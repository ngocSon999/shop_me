<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
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
            'type' => 'required|integer|max:3',
            'card_price' => 'required|integer|max:1000000',
            'serial' => 'required|max:20',
            'number' => 'required|max:20',
            'status' => 'nullable|integer|max:1',
        ];
    }

    public function attributes(): array
    {
        return [
            'type' => 'loại thẻ',
            'card_price' => 'mệnh giá thẻ',
            'serial' => 'số seri',
            'number' => 'số thẻ',
        ];
    }
}
