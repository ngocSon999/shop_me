<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
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
            'name' => 'required|max:50',
            'email' => 'required|email|max:150|unique:customers,email,'.$this->id,
            'phone' => [
                'required', 'max:15',
                'regex:/(84)+([1-9]{9})\b|^(0[3|5|7|8|9])+([0-9]{8})\b/'
            ],
            'avatar' => 'nullable|image',
            'address' => 'nullable|max:255',
            'password' => 'required|min:6|max:32',
        ];
    }
}
