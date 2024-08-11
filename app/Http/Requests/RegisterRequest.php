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
            'national_code' => 'required|ir_national_code',
            'phone' => 'required|ir_mobile',
            'password' => 'required|min:8|max:20',
        ];
    }

    public function messages()
    {
        return [
            'national_code.required' => 'کد ملی الزامی است.',
            'national_code.ir_national_code' => 'کد ملی نامعتبر است',
            'phone_number.required' => 'شماره موبایل الزامی است.',
            'phone_number.ir_mobile' => 'تلفن همراه نا معتبر است',
        ];
    }
}
