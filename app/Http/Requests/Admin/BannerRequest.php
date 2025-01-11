<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BannerRequest extends FormRequest
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
        return match ($this->method()) {
            'POST' => [
                'name' => 'required|max:255',
                'description' => 'nullable|max:255',
                'image' => 'required|mimes:jpg,jpeg,png',
                'link' => 'nullable|max:255',
                'position' => 'nullable|integer|max:10'
            ],
            'PUT', 'PATCH' => [
                'name' => 'required|max:255',
                'description' => 'nullable|max:255',
                'image' => 'nullable|mimes:jpg,jpeg,png',
                'link' => 'nullable|max:255',
                'position' => 'nullable|integer|max:10'
            ],
            default => [],
        };
    }
}
