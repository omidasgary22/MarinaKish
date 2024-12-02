<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetpasswordRequest extends FormRequest
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
            'old_password' => 'required|string',
            'new_password' => 'required|string'
        ];
    }
    public function messages()
    {
        return [
        'old_password.required' => 'رمز قبلی اجباری است',
        'old_password.string' => 'رمز عبور قبلی اشتباه است',
        'new_password.required' => 'رمز عبور جدید اجباری است',
        'new_password.min' => 'رمز عبور جدیدباید بیشتر از ۸ کارکتر باشد',
        'new_password.max' => 'طول رمز عبور بیشتر از حد مجاز است'
        ];
    }
}
