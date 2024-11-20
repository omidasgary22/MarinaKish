<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class logoSettingRequest extends FormRequest
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
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'logo.required' => 'لگو سایت اجباری است',
            'logo.image' => 'لگو باید به صورت عکس باشد',
            'logo.mimes' => 'فرمت فایل باید jpeg, png, jpg, gif, svg.',
            'logo.max' => 'حجم فایل باید 2048*2048 باشد',
        ];
    }
}
