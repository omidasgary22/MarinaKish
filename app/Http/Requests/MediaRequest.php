<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:230*238',
        ];
    }
    public function messages(): array
    {
        return [
            'image.required' => 'تصویر جباری است',
            'image.mimes' => 'فرمت تصویر اشتباه است',
            'image.max' => 'ابعاد تصویر اشتباه است'
        ];
    }
}
