<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'category_id' => 'required|integer',
            'name' => 'required|max:255',
            'title' => 'nullable',
            'description' => 'nullable',
            'status' => 'nullable|integer|in:0,1',
            'price' => 'nullable|integer|max:99999999999',
            'quantity' => 'nullable|integer|max:99999999999',
            'image' => [
                Rule::requiredIf(!$this->route('product')),
                'image', 'mimes:jpg,jpeg,png'
            ],
        ];
    }
}
