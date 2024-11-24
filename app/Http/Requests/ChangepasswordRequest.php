<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangepasswordRequest extends FormRequest
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
            'phone' => 'required|ir_mobile',
        ];
    }
    public function messages(): array
    {
        return [
            'phone.required' => 'شماره تلفن همراه الزامی است',
            'phone.ir_mobile' => 'تلفن همراه نا معتبر است'

        ];
    }
}
