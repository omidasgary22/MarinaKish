<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'national_code' => 'required|numeric|digits_between:1,10',
            'phone' => 'required|numeric',
            'password' => 'required|min:8|max:20',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام الزامی است.',
            'national_code.required' => 'کد ملی الزامی است.',
            'national_code.unique' => 'کد ملی باید منحصر به فرد باشد.',
            'phone_number.required' => 'شماره موبایل الزامی است.',
            'phone_number.unique' => 'شماره موبایل باید منحصر به فرد باشد.',
        ];
    }
}
