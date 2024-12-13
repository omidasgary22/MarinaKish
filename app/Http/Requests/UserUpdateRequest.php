<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|string',
            'birth_day' => 'required|date',
            'gender' => 'required|in:mail,female',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'نام الزامی است.',
            'first_name.string' => 'نام باید یک رشته متنی باشد.',
            'first_name.max' => 'نام نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'last_name.required' => 'نام خانوادگی الزامی است.',
            'last_name.string' => 'نام خانوادگی باید یک رشته متنی باشد.',
            'last_name.max' => 'نام خانوادگی نباید بیشتر از ۲۵۵ کاراکتر باشد.',

            'phone_number.required' => 'شماره تلفن الزامی است.',
            'phone_number.string' => 'شماره تلفن باید یک رشته متنی باشد.',
            'phone_number.regex' => 'فرمت شماره تلفن معتبر نیست.',

            'date_of_birth.required' => 'تاریخ تولد الزامی است.',
            'date_of_birth.date' => 'تاریخ تولد باید یک تاریخ معتبر باشد.',
            'date_of_birth.before' => 'تاریخ تولد باید قبل از امروز باشد.',

            'national_code.required' => 'کد ملی الزامی است.',
            'national_code.string' => 'کد ملی باید یک رشته متنی باشد.',
            'national_code.size' => 'کد ملی باید ۱۰ کاراکتر باشد.',
            'national_code.regex' => 'کد ملی باید تنها شامل اعداد باشد.',

            'email.required' => 'ایمیل الزامی است.',
            'email.string' => 'ایمیل باید یک رشته متنی باشد.',
            'email.email' => 'ایمیل وارد شده معتبر نیست.',
            'email.max' => 'ایمیل نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'email.unique' => 'ایمیل وارد شده قبلاً ثبت شده است.',

            'password.nullable' => 'رمز عبور می‌تواند خالی باشد.',
            'password.string' => 'رمز عبور باید یک رشته متنی باشد.',
            'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
            'password.confirmed' => 'تأیید رمز عبور مطابقت ندارد.',
            'gender.required' => 'جنسیت اجباری است'
        ];
    }
}
