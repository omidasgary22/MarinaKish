<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PassengerCreateRequest extends FormRequest
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
            'name' => 'required|max:50',
            'national_code' => 'required|ir_national_code',
            'phone' => 'required|ir_mobile',
            'birth_day' => 'required|date',
            'gender' => 'required|in:mail,female',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'نام گردشگر اجباری است',
            'name.max' => 'نام گردشگر مجاز نیست',
            'national_code.required' => 'کد ملی گردشگر اجباری است',
            'national_code.ir_national_code' => '',
            'phone.required' => 'تلفن گردشگر اجباری است',
            'phone.ir_mobile' => 'لفن گردشگر معتبر نمی باشد',
            'birth_day.required' => 'تاریخ تولد گردشگر اجباری است ',
            'birth_day.date' => 'تاریخ تولد نا معتبر است',
            'gender.required' => 'جنسیت گردشگر اجباری است',
            'gender.in' => 'لطفا جنسیت گردشگر را درست وارد کنید',
        ];
    }
}